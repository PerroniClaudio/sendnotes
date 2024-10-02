<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $noteurl = config('app.url') . '/notes/' . $this->note->id;
        $emailContent = "Hello, you've got a new note! View it here: {$noteurl}";

        Mail::raw($emailContent, function ($message) {
            $message->from('noteshare@zimfy.co', 'Sandnotes')->to($this->note->recipient)->subject('You have a new note from '. $this->note->user->name);
        });


    }
}
