<?php

namespace App\Http\Controllers\Front\Steps\Claim;

use App\Models\Claim;
use App\Models\Front\Currency;
use App\Models\Front\Organization;
use App\Models\Front\Participant;
use App\Models\Front\Person;
use App\Repositories\Eloquent\CurrencyRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ycs77\LaravelWizard\Step;

class DebtStep extends Step
{
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
     * @param  array|null  $data
     * @param  Model|Relation|null  $model
     * @return void
     */
    public function saveData(Request $request, $data = null, $model = null)
    {
        $wizardData = [];
        $wizardData = $this->getRepo()->original()->map(function ($step) use($wizardData) {
            $wizardData[$step->slug()] = $step->data();
            return $wizardData;
        });

        $flattenWizardData = $this->flattenArray($wizardData);

        $creditor = $flattenWizardData['creditor'];
        $debtor = $flattenWizardData['debtor'];

        $creditorModel = $creditor['person_type'] == 1 ? new Organization($creditor) : new Person($creditor);
        $debtorModel = $debtor['person_type'] == 1 ? new Organization($debtor) : new Person($debtor);

        DB::beginTransaction();
        try {
            $debtorModel->save();
            $creditorModel->save();

            $participantCreditor = new Participant();
            $participantCreditor->user()->associate(Auth::id());

            $participantDebtor = new Participant();
            $participantDebtor->user()->associate(Auth::id());

            $debtorModel->participants()->save($participantDebtor);
            $creditorModel->participants()->save($participantCreditor);

            $model->currency()->associate($flattenWizardData['debt']['currency']);
            $model->claimStatus()->associate(Claim::DEFAULT_STATE_ID);
            $model->claimType()->associate($flattenWizardData['type']['claim_type']);
            $model->user()->associate(Auth::id());
            $model->creditor()->associate($participantCreditor);
            $model->debtor()->associate($participantDebtor);

            $model->fill($flattenWizardData['debt'])->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Nepodarilo sa ulozit udaje'. $e->getMessage());
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
            'amount' => 'required',
            'paymentDueDate' => 'required',
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
