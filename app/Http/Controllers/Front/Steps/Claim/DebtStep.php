<?php

namespace App\Http\Controllers\Front\Steps\Claim;

use App\Models\Front\Claim;
use App\Models\Front\Organization;
use App\Models\Front\Participant;
use App\Models\Front\Person;
use App\Repositories\Eloquent\ClaimRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ycs77\LaravelWizard\Step;

class DebtStep extends Step
{
    private $claimRepository;

//    public function __construct(ClaimRepository $claimRepository)
//    {
//        $this->claimRepository = $claimRepository;
//    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null
     */
    public function model(Request $request)
    {
        return new Claim();
    }

    /**
     * Save this step form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array|null  $data
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null  $model
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

        $debtorModel->save();
        $creditorModel->save();

        $participantCreditor = new Participant();
        $participantCreditor->user()->associate(Auth::id());

        $participantDebtor = new Participant();
        $participantDebtor->user()->associate(Auth::id());

        $debtorModel->participants()->save($participantDebtor);
        $creditorModel->participants()->save($participantCreditor);

//        dd($participantDebtor, $participantDebtor);

        $model->claimStatus()->associate(Claim::DEFAULT_STATE_ID);
        $model->claimType()->associate($flattenWizardData['type']['claim_type']);
        $model->user()->associate(Auth::id());
        $model->creditor()->associate($participantCreditor);
//        $model->creditor($creditorModel);
        $model->debtor()->associate($participantDebtor);
//        $model->debtor($debtorModel);

//        $model->fill($flattenWizardData['debt']);

//        dd($model);

        $model->fill($flattenWizardData['debt'])->save();
    }

    /**
     * Validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
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
}
