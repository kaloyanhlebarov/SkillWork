<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CompanyRecordRequestFindRequest;
use App\Http\Requests\Api\V1\CompanyRecordRequestStoreRequest;
use App\Http\Resources\CompanyRecordRequestResource;
use App\Jobs\ProcessCompanyRecordJob;
use App\Models\CompanyRecordRequest;
use Illuminate\Http\Request;

class CompanyRecordRequestController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\CompanyRecordRequestStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyRecordRequestStoreRequest $request) {
        $companyRecordRequest = CompanyRecordRequest::create([
            'user_id' => $request->user()->id,
            'company_name' => $request->company_name ?? null,
            'company_domain' => $request->company_domain ?? null,
        ]);

        dispatch(new ProcessCompanyRecordJob($companyRecordRequest))->delay(now()->addSeconds(10));

        return response()->json([
            'company_record_request' => CompanyRecordRequestResource::make($companyRecordRequest),
            'success' => 'You request was created successfully. You will receive an email when we process it.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CompanyRecordRequest $companyRecordRequest
     * @return void
     */
    public function show(CompanyRecordRequest $companyRecordRequest) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompanyRecordRequest $companyRecordRequest
     * @return void
     */
    public function update(Request $request, CompanyRecordRequest $companyRecordRequest) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CompanyRecordRequest $companyRecordRequest
     * @return void
     */
    public function destroy(CompanyRecordRequest $companyRecordRequest) {
        //
    }

    /**
     * Find the specified resource from storage.
     *
     * @param \App\Http\Requests\Api\V1\CompanyRecordRequestFindRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(CompanyRecordRequestFindRequest $request)
    {
        $companyRecordRequest = CompanyRecordRequest::where('company_domain', $request->company_domain)->first();

        return response()->json([
            'company_record_request' => CompanyRecordRequestResource::make($companyRecordRequest),
        ], 200);
    }
}
