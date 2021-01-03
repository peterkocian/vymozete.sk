<?php

namespace App\Http\Controllers\Front\Steps\Claim;

use App\Http\Requests\UploadFileRequestGeneral;
use App\Models\Claim;
use App\Models\Currency;
use App\Models\File;
use App\Models\Organization;
use App\Models\Participant;
use App\Models\Person;
use App\Repositories\Eloquent\ClaimRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Services\FileService;
use App\Services\SimpleTableService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ycs77\LaravelWizard\Step;
use Ycs77\LaravelWizard\Wizard;

class DebtStep extends Step
{
    protected $fileService;
    protected $currencyRepository;

    public function __construct(Wizard $wizard, int $index)
    {
        parent::__construct($wizard, $index);

        //todo hack
        $currency = App::make(Currency::class);
        $this->currencyRepository = new CurrencyRepository($currency);

//        $file = new File();
        $file = App::make(File::class);
//        $claim = new Claim();
        $claim = App::make(Claim::class);
//        $simpleTableService = new SimpleTableService();
        $simpleTableService = App::make(SimpleTableService::class);

        $claimRepository   = new ClaimRepository($claim);
        $fileRepository    = new FileRepository($file, $claimRepository);
        $this->fileService = new FileService($fileRepository, $claimRepository, $simpleTableService);
    }

    /**
     * The step slug.
     *
     * @var string
     */
    protected $slug = 'debt';

    /**
     * The step show label text.
     *
     * @var string
     */
    protected $label = 'Dlh (istina)';

    /**
     * The step form view path.
     *
     * @var string
     */
    protected $view = 'front.wizards.claim.steps.debt';

    /**
     * Set the step model instance or the relationships instance.
     *
     * @param Request $request
     * @return Model|Relation|null
     */
    public function model(Request $request)
    {
        return new Claim();
    }

    /**
     * Save this step form data.
     *
     * @param Request $request
     * @param array|null $data
     * @param Model|Relation|null $model
     * @return void
     * @throws Exception
     */
    public function saveData(Request $request, $data = null, $model = null)
    {
        //todo refactornut celu tuto funkciu
        $wizardData = $this->getRepo()->original()->map(function ($step) {
            return [$step->slug() => $step->data()];
        });

        $flattenWizardData = $this->flattenArray($wizardData);

        DB::beginTransaction();

        try {
            if (isset($flattenWizardData['creditor'])) {
                $creditor = $flattenWizardData['creditor'];
                $creditorModel = $creditor['person_type'] == 1 ? new Organization($creditor) : new Person($creditor);
            } else {
                throw new Exception('Vyskytol sa problém pri spracovaní údajov veritela.');
            }

            if (isset($flattenWizardData['debtor'])){
                $debtor = $flattenWizardData['debtor'];
                $debtorModel = $debtor['person_type'] == 1 ? new Organization($debtor) : new Person($debtor);
            } else {
                throw new Exception('Vyskytol sa problém pri spracovaní údajov dlžníka.');
            }

            $debtorModel->save();
            $creditorModel->save();

            $participantCreditor = new Participant();
            $participantCreditor->user()->associate(Auth::id());

            $participantDebtor = new Participant();
            $participantDebtor->user()->associate(Auth::id());

            $debtorModel->participants()->save($participantDebtor);
            $creditorModel->participants()->save($participantCreditor);

            $model->currency()->associate($flattenWizardData[$this->slug]['currency_id']);
            $model->claimStatus()->associate(Claim::DEFAULT_STATE_ID);
            $model->claimType()->associate($flattenWizardData['type']['claim_type_id']);
            $model->user()->associate(Auth::id());
            $model->creditor()->associate($participantCreditor);
            $model->debtor()->associate($participantDebtor);

            $files = [];
            if (isset($flattenWizardData[$this->slug]['uploads'])) {
                $files = $flattenWizardData[$this->slug]['uploads'];
                unset($flattenWizardData[$this->slug]['uploads']);
            }

            $model->fill($flattenWizardData[$this->slug])->save();

            // upload and save file to DB from form wizard
            if (!empty($files)) {
                $this->fileService->save($files, $model->id);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(__('general.Create failed') .' '. $e->getMessage());
        }
    }

    /**
     * Validation rules.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'amount'         => 'required|numeric',
            'currency_id'    => 'required',
            'payment_due_date'=> 'required|date',
        ];

        $rules = array_merge($rules,UploadFileRequestGeneral::rules());
        return $rules;
    }

    public function flattenArray($stepData) {
        $flatten = [];
        foreach ($stepData as $value) {
            foreach ($value as $k => $v) {
                $flatten[$k] = $v;
            }
        }
        return $flatten;
    }

    /**
     * return array of [id, value] currency list
     *
     * @return array
     */
    public function getCurrencies() {
        return $this->currencyRepository->getDataForSelectbox();
    }
}
