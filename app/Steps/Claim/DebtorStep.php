<?php

namespace App\Steps\Claim;

use Illuminate\Http\Request;
use Ycs77\LaravelWizard\Step;

class DebtorStep extends Step
{
    /**
     * The step slug.
     *
     * @var string
     */
    protected $slug = 'debtor';

    /**
     * The step show label text.
     *
     * @var string
     */
    protected $label = 'Dlžník';

    /**
     * The step form view path.
     *
     * @var string
     */
    protected $view = 'steps.claim.debtor';

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
        //todo
        return [];
    }
}
