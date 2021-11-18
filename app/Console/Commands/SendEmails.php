<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use App\Models\SentMail;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails for to subscribed users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get all pending email/posts
        $pendingItems = SentMail::where(['email_sent'=>false])->get();
        foreach ($pendingItems as $item){
           dispatch(new SendEmailJob($item->user, $item->post));
           $this->comment('Sending an email to '. $item->user->name);
           $item->update(['email_sent'=>true]);
        }
        return Command::SUCCESS;
    }
}
