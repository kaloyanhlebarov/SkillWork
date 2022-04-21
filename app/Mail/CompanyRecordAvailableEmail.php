<?php

namespace App\Mail;

use App\Models\CompanyRecordRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRecordAvailableEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $companyRecordRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, CompanyRecordRequest $companyRecordRequest)
    {
        $this->user = $user;
        $this->companyRecordRequest = $companyRecordRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $companyRecordRequest = $this->companyRecordRequest;

        return $this->markdown('mails.company-record-available', compact('user', 'companyRecordRequest'));
    }
}
