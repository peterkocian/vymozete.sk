<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ClaimRepositoryInterface;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    private $claimRepository;

    public function __construct(ClaimRepositoryInterface $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }

    public function index()
    {
        return $this->claimRepository->all();
    }

    public function find($id)
    {
        return $this->claimRepository->get($id);
    }
}
