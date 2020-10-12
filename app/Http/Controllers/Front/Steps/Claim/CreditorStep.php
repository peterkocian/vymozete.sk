<?php

namespace App\Http\Controllers\Front\Steps\Claim;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null
     */
    public function model(Request $request)
    {
        //
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
        //
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
            'person_type' => 'required',
            'name' => 'required',
            'surname' => 'required_if:person_type,0',
            'birthday' => 'required_if:person_type,0|date',
            'ico' => 'required_if:person_type,1',
            'iban' => 'required',
            'street' => 'required',
            'house_number' => 'required',
            'town' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'email' => ['email',new EmailMustHaveTLD,'nullable']
        ];
    }
}
