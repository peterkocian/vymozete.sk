<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ClaimTypeRepositoryInterface;
use Illuminate\Http\Request;

class ClaimTypeController extends Controller
{
    private $claimTypeRepository;

    public function __construct(ClaimTypeRepositoryInterface $claimTypeRepository)
    {
        $this->claimTypeRepository = $claimTypeRepository;
    }

    public function index()
    {
        return $this->claimTypeRepository->all();
    }

    public function find($id)
    {
        return $this->claimTypeRepository->get($id);
    }
}
