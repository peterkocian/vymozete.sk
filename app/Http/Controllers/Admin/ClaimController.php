<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ClaimRepositoryInterface;

class ClaimController extends Controller
{
    private $claimRepository;

    public function __construct(ClaimRepositoryInterface $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }

    public function index()
    {
//        $claim = Claim::find(1);
//        dd($claim->debtor->entity->name);
        $claims = $this->claimRepository->all();
        return view('admin.claims.index', ['data' => $claims]);
    }
}
