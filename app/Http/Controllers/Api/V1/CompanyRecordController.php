<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CompanyRecordFindRequest;
use App\Http\Resources\CompanyRecordResource;
use App\Models\CompanyRecord;
use Illuminate\Http\Request;

class CompanyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyRecord  $companyRecord
     * @return void
     */
    public function show(CompanyRecord $companyRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyRecord  $companyRecord
     * @return void
     */
    public function update(Request $request, CompanyRecord $companyRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyRecord  $companyRecord
     * @return void
     */
    public function destroy(CompanyRecord $companyRecord)
    {
        //
    }

    /**
     * Find the specified resource from storage.
     *
     * @param  \App\Models\CompanyRecord  $companyRecord
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(CompanyRecordFindRequest $request, CompanyRecord $companyRecord)
    {
        $companyRecord = CompanyRecord::where('company_domain', $request->company_domain)->first();

        return response()->json([
            'company_record_request' => CompanyRecordResource::make($companyRecord),
        ], 200);
    }
}
