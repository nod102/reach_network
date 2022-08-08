<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use App\Models\Advertisement;
use Carbon\Carbon;

class RemainderAdvertiserToAdv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertiser:remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to advertise to before advertisement start date';

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
     * @return mixed
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow('Europe/London');
        $all_advertisements = Advertisement::with('advertisers')->where('start_date','=',$tomorrow)->get();
        foreach ($all_advertisements as $one_advertisement) {
            $advertiser = $one_advertisement->advertisers;
            $mail_to = $advertiser->email;
            $subject = "One day to publish Your advertisement";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <info@google.com>' . "\r\n";
            $message = "This is reminder to you, your advertisement will be published tomorrow";
            mail($mail_to,$subject,$message,$headers);
        }
        $this->info('Reminder email is sended');
    }
}
