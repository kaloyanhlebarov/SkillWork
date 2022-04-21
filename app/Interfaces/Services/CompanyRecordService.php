<?php

namespace App\Interfaces\Services;

use App\Models\CompanyRecordRequest;

interface CompanyRecordService {
    public function getCompanyRecord(CompanyRecordRequest $companyRecordRequest);
}
