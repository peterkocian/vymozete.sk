<?php

namespace App\Http\Controllers\Front\Steps\Claim;

use App\Http\Requests\ParticipantRequest;
use App\Rules\EmailMustHaveTLD;
use Illuminate\Http\Request;
use Ycs77\LaravelWizard\Step;

class CreditorStep extends Step
{
    /**
     * The step slug.
     *
     * @var string
     */
    protected $slug = 'creditor';

    /**
     * The step show label text.
     *
     * @var string
     */
    protected $label = 'Veriteľ';

    /**
     * The step form view path.
     *
     * @var string
     */
    protected $view = 'front.wizards.claim.steps.creditor';

    /**
     * Set the step model instance or the relationships instance.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null
     */
    public function model(Request $request)
    {
        //
    }

    /**
     * Save this step form data.
     *
     * @param Request $request
     * @param  array|null  $data
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null  $model
     * @return void
     */
    public function saveData(Request $request, $data = null, $model = null)
    {
        //
    }

    /**
     * Validation rules.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return ParticipantRequest::rules();
    }
}
