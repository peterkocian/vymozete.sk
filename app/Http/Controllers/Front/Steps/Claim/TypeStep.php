<?php

namespace App\Http\Controllers\Front\Steps\Claim;

use App\Models\Front\ClaimType;
use App\Repositories\Eloquent\ClaimTypeRepository;
use Illuminate\Http\Request;
use Ycs77\LaravelWizard\Step;

class TypeStep extends Step
{
    /**
     * The step slug.
     *
     * @var string
     */
    protected $slug = 'type';

    /**
     * The step show label text.
     *
     * @var string
     */
    protected $label = 'Typ pohľadávky';

    /**
     * The step form view path.
     *
     * @var string
     */
    protected $view = 'front.wizards.claim.steps.type';

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
            'claim_type' => 'required',
        ];
    }

    public function getClaimTypes()
    {
        $claimType = new ClaimType();
        $claimTypeRepository = new ClaimTypeRepository($claimType);
        return $claimTypeRepository->all();
//        return ClaimType::all(['id','name'])->toArray();
    }
}
