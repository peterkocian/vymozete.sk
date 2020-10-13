<?php

namespace App\Http\Controllers\Front\Steps\Claim;

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
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ycs77\LaravelWizard\Step;
use Ycs77\LaravelWizard\Wizard;

class DebtStep extends Step
{
    protected $fileService;

    public function __construct(Wizard $wizard, int $index)
    {
        parent::__construct($wizard, $index);

        //todo hack
        $file = new File();
        $claim = new Claim();
//        $fileRepository = new FileRepository($file);
//        $this->uploadService = new UploadService($fileRepository);
        $fileRepository = new FileRepository($file);
        $claimRepository = new ClaimRepository($claim);
        $this->fileService = new FileService($fileRepository, $claimRepository);
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
//        dd($this->wizard());
//        dd('here');
        $wizardData = [];
        $wizardData = $this->getRepo()->original()->map(function ($step) {
            return [$step->slug() => $step->data()];
        });
//        dd($wizardData);

        $flattenWizardData = $this->flattenArray($wizardData);

//        dd($flattenWizardData['debt']);


        DB::beginTransaction();

        try {
            if (isset($flattenWizardData['creditor'])) {
                $creditor = $flattenWizardData['creditor'];
                $creditorModel = $creditor['person_type'] == 1 ? new Organization($creditor) : new Person($creditor);
            } else {
                throw new Exception('Vyskytol sa problem pri ziskavani udajov veritela.');
            }

            if (isset($flattenWizardData['debtor'])){
                $debtor = $flattenWizardData['debtor'];
                $debtorModel = $debtor['person_type'] == 1 ? new Organization($debtor) : new Person($debtor);
            } else {
                throw new Exception('Vyskytol sa problem pri ziskavani udajov dlznika.');
            }

            $debtorModel->save();
            $creditorModel->save();

            $participantCreditor = new Participant();
            $participantCreditor->user()->associate(Auth::id());

            $participantDebtor = new Participant();
            $participantDebtor->user()->associate(Auth::id());

            $debtorModel->participants()->save($participantDebtor);
            $creditorModel->participants()->save($participantCreditor);

            $model->currency()->associate($flattenWizardData['debt']['currency_id']);
            $model->claimStatus()->associate(Claim::DEFAULT_STATE_ID);
            $model->claimType()->associate($flattenWizardData['type']['claim_type_id']);
            $model->user()->associate(Auth::id());
            $model->creditor()->associate($participantCreditor);
            $model->debtor()->associate($participantDebtor);

            $files = $flattenWizardData['debt']['uploads'];

            unset($flattenWizardData['debt']['uploads']);

            $model->fill($flattenWizardData['debt'])->save();

            //save file from form wizard
            if ($files) {
                foreach($files as $file) {
                    if ($file && $file->isValid()) {
                        $saved = $this->fileService->saveFile($model, $file, $data);
                    } else {
                        throw new \Exception('Subor nie je validny');
                    }
                }
            } else {
                throw new \Exception('Requestom neprisiel ziadny subor na ulozenie');
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

//            return back()
//                ->withFails($e->getMessage());
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
        return [
            'amount'         => 'required|numeric',
            'currency_id'    => 'required',
            'payment_due_date'=> 'required',
            'uploads'        => 'required|array|min:1',
            'uploads.*'      => 'required|mimes:txt,pdf,doc,docx,jpg,jpeg',
        ];
    }

    public function flattenArray($stepData) {
        $flatten = [];
        foreach ($stepData as $value) {
            foreach ($value as $i => $v) {
                $flatten[$i] = $v;
            }
        }
        return $flatten;
    }

    public function getCurrencies() {
        $currency = new Currency();
        $currencyRepository = new CurrencyRepository($currency);
        return $currencyRepository->all();
    }
}
