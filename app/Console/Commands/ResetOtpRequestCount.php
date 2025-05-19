<?php

namespace App\Console\Commands;
use App\Models\Otp;
use Illuminate\Console\Command;

class ResetOtpRequestCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:reset-request-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset OTP request count for all users daily';


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
        Otp::query()->update(['request_count' => 0]);
        $this->info('OTP request counts have been reset.');
    }
    
}
