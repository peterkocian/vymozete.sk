<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClaimBaseDataFrontRequest;
use App\Http\Requests\ParticipantRequest;
use App\Http\Requests\UploadFileRequestGeneral;
use App\Services\ClaimService;
use App\Services\ClaimTypeService;
use App\Services\FileService;
use Illuminate\Http\Response;

class ClaimController extends Controller
{
    private $claimService;
    private $fileService;
    private $claimTypeService;

    public function __construct(
        ClaimService $claimService,
        FileService $fileService,
        ClaimTypeService $claimTypeService
    )
    {
        $this->claimService = $claimService;
        $this->fileService = $fileService;
        $this->claimTypeService = $claimTypeService;
    }

    public function find($id)
    {
        return $this->claimService->get($id);
    }

    public function overview(int $claim_id)
    {
        $claim = $this->claimService->get($claim_id)->toArray();
        $currencies = $this->claimService->getCurrencyList();
        $claimTypes = $this->claimTypeService->getDataForSelectbox();

        return view('front.claims.main', [
            'claim_id'  => $claim_id,
            'claim'     => $claim,
            'currencies'=> $currencies,
            'claimTypes'=> $claimTypes,
            'tab'       => 'overview'
        ]);
    }

    public function updateBaseData(ClaimBaseDataFrontRequest $request, int $claim_id)
    {
        try {
            $result = $this->claimService->updateBaseData($request->all(), $claim_id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Create failed') . ' ' . $e->getMessage())
                ->withInput();
        }

        return back()
                ->withSuccess(__('general.Updated successfully'));
    }

    public function creditor(int $claim_id)
    {
        $creditor = $this->claimService->getCreditor($claim_id);

        return view('front.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $creditor,
            'tab'       => 'creditor'
        ]);
    }

    public function updateCreditor(ParticipantRequest $request, int $claim_id)
    {
        $data = $request->validated();
        $creditor = $this->claimService->getCreditor($claim_id);
        $data['creditor_id'] = $creditor->id;

        try {
            $result = $this->claimService->updateBaseData($data, $claim_id);
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Update failed') . ' ' . $e->getMessage())
                ->withInput();
        }

        return back()
            ->withSuccess(__('general.Updated successfully'));
    }

    public function debtor(int $claim_id)
    {
        $debtor = $this->claimService->getDebtor($claim_id);

        return view('front.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $debtor,
            'tab'       => 'debtor'
        ]);
    }

    public function updateDebtor(ParticipantRequest $request, int $claim_id)
    {
        $data = $request->validated();
        $debtor = $this->claimService->getDebtor($claim_id);
        $data['debtor_id'] = $debtor->id;

        try {
            $result = $this->claimService->updateBaseData($data, $claim_id);
            return back()
                ->withSuccess(__('general.Updated successfully'));
        } catch (\Exception $e) {
            report($e);

            return back()
                ->withFail(__('general.Update failed') . ' ' . $e->getMessage())
                ->withInput();
        }
    }

    public function documents(int $claim_id)
    {
        $result = $this->fileService->filesByClaimId($claim_id);

        return view('front.claims.main', [
            'claim_id'  => $claim_id,
            'data'      => $result,
            'tab'       => 'documents'
        ]);
    }

    public function uploadDocuments(UploadFileRequestGeneral $request, int $claim_id)
    {
        $files = $request->file('uploads');

        try {
            $this->fileService->save($files, $claim_id);
            return back()
                ->withSuccess(__('general.Updated successfully'));
        } catch (\Exception $e) {
            return back()
                ->withFail(__('general.Update failed') . ' ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyFile(int $id)
    {
        if (request()->ajax()) {
            try {
                $this->fileService->delete($id);

                return response()->json([
                    'success' => true,
                    'id' => $id,
                    'message' => __('file.File successfully deleted'),
                ], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => __('file.File delete failed') .' '. $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return back()
            ->withFail('povoleny iba ajax request');
    }
}
