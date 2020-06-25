<?php

namespace App\Http\Controllers\Front;

use App\Steps\Claim\TypeStep;
use App\Steps\Claim\CreditorStep;
use App\Steps\Claim\DebtorStep;
use App\Steps\Claim\DebtStep;
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
