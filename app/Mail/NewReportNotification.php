<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Report $report)
    {
    }

    public function build()
    {
        return $this->subject('Nuevo reporte: ' . $this->report->title)
            ->view('emails.reports.create');
    }
}