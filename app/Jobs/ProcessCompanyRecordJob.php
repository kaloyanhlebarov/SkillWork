<?php

namespace App\Jobs;

use App\Interfaces\Services\CompanyRecordService;
use App\Mail\CompanyRecordAvailableEmail;
use App\Models\CompanyRecordRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessCompanyRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $companyRecordService;
    private $companyRecordRequest;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\CompanyRecordRequest $companyRecordRequest
     */
    public function __construct(CompanyRecordRequest $companyRecordRequest)
    {
        $this->companyRecordRequest = $companyRecordRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CompanyRecordService $companyRecordService)
    {
        $companyRecordService->getCompanyRecord($this->companyRecordRequest);

        // Prefferably mails can be also done in queues
        Mail::to($this->companyRecordRequest->user->email)->send(
            new CompanyRecordAvailableEmail($this->companyRecordRequest->user, $this->companyRecordRequest)
        );
    }
}
