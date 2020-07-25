<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\Steps\Claim\TypeStep;
use App\Http\Controllers\Front\Steps\Claim\CreditorStep;
use App\Http\Controllers\Front\Steps\Claim\DebtorStep;
use App\Http\Controllers\Front\Steps\Claim\DebtStep;
use Ycs77\LaravelWizard\Wizardable;
use App\Http\Controllers\Controller;

class ClaimWizardController extends Controller
{
    use Wizardable;

    /**
     * The wizard name.
     *
     * @var string
     */
    protected $wizardName = 'claim';

    /**
     * The wizard title.
     *
     * @var string
     */
    protected $wizardTitle = 'Claim';

    /**
     * The wizard options.
     *
     * @var array
     */
    protected $wizardOptions = [];

    /**
     * The wizard steps instance.
     *
     * @var array
     */
    protected $steps = [
        TypeStep::class,
        DebtorStep::class,
        CreditorStep::class,
        DebtStep::class,
    ];
}
