<?php

namespace App\Services\CompanyRecordServices;

use App\Interfaces\Services\CompanyRecordService;
use App\Models\CompanyRecord;
use App\Models\CompanyRecordRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Clearbit implements CompanyRecordService {
    private $service_endpoints = [
        'find' => 'https://discovery.clearbit.com/v2/companies/find'
    ];
    private $success_codes = [200, 201, 202];

    /**
     * @throws \Exception
     */
    public function getCompanyRecord(CompanyRecordRequest $companyRecordRequest) {
        // Possible request - https://discovery.clearbit.com/v1/companies/search?query=or:(domain:twitter.com name:Twitter)

        $findResponse = Http::withoutVerifying()->withToken(env('CLEARBIT_API_KEY'))->get($this->service_endpoints['find'], [
            'domain' => $companyRecordRequest->company_domain,
            'name' => $companyRecordRequest->company_name,
        ]);

        if (!$this->validResponse($findResponse)) {
            throw new ResourceNotFoundException();
        }

        $this->updateCompanyRecordRequest($companyRecordRequest);
        $this->saveCompanyRecord($companyRecordRequest, $findResponse);
    }

    private function validResponse($findResponse) {
        return $findResponse->successful();
    }

    private function updateCompanyRecordRequest(CompanyRecordRequest $companyRecordRequest) {
        $companyRecordRequest->status = 'processed';
        $companyRecordRequest->save();
    }

    private function saveCompanyRecord(CompanyRecordRequest $companyRecordRequest, $findResponse) {
        CompanyRecord::updateOrCreate([
            'company_name' => $companyRecordRequest->company_name ?? null,
            'company_domain' => $companyRecordRequest->company_domain ?? null,
        ], [
            'company_name' => $companyRecordRequest->company_name ?? null,
            'company_domain' => $companyRecordRequest->company_domain ?? null,
            'scraped_info' => $findResponse,
        ]);
    }
}
