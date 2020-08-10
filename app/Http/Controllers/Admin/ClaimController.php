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

    public function overview(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $claim->debtor = $claim->debtor->entity;
        $claim->creditor = $claim->creditor->entity;
//        dd($claim);
        return view('admin.claims.main', [
            'claim' => $claim,
            'tab' => 'overview'
        ]);
    }

    public function creditor(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $creditor = $claim->creditor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $creditor,
            'tab' => 'creditor'
        ]);
    }

    public function debtor(int $id)
    {
        $claim = $this->claimRepository->get($id);
        $debtor = $claim->debtor;
        return view('admin.claims.main', [
            'claim' => $claim,
            'data' => $debtor,
            'tab' => 'debtor'
        ]);
    }

    public function documents(int $id)
    {
        $claim = $this->claimRepository->get($id);
//        $debtor = $claim->debtor;
        return view('admin.claims.main', [
            'claim' => $claim,
//            'data' => $debtor,
            'tab' => 'documents'
        ]);
    }
}
