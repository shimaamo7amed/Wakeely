<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $child;
    public $pdfContent;

    public function __construct($data, $child, $pdfContent)
    {
        $this->data = $data;
        $this->child = $child;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('Daily Report for ' . $this->child->fullName)
            ->view('emails.daily_report')
            ->attachData($this->pdfContent, 'daily_report.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
