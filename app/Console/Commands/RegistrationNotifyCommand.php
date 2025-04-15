<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Models\User;
use App\Services\RabbitmqService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RegistrationNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registration-notify-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    private RabbitmqService $rabbitmqService;

    public function __construct(RabbitmqService $rabbitmqService)
    {
        parent::__construct();
        $this->rabbitmqService = $rabbitmqService;
    }
    public function handle()
    {
        $callback = function ($msg) {
            $data = $msg->body;
            $data = json_decode($data, true);
            $user = User::query()->find($data['user_id']);
            Mail::to($user->email)->send(new TestMail());
        };

        $this->rabbitmqService->consume('sign-up-email', $callback);
    }
}
