<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $now = Carbon::now();

        $notes = Note::where('is_published', 1)
            ->where('send_date', '<=' ,$now->toDateTimeString())
            ->get();

        $noteCount = $notes->count();

        $this->info("Current time: {$now->toDateString()}.");
        $this->info("Found {$noteCount} notes to send.");

        foreach($notes as $note) {
            $this->info("Sending note {$note->id} to {$note->recipient}.");

            SendEmail::dispatch($note);
        }
    }
}
