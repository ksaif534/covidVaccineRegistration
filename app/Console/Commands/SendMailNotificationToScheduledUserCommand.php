<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMailNotificationToScheduledUserJob;

class SendMailNotificationToScheduledUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail-notification-to-scheduled-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Mail Notification to the Scheduled User before the Scheduled Date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendMailNotificationToScheduledUserJob::dispatchSync();
    }
}
