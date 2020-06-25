<?php

namespace App\Steps\Claim;

use App\Models\Front\Claim;
use Illuminate\Http\Request;
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
    protected $view = 'steps.claim.debt';

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
        //todo
        return [];
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
