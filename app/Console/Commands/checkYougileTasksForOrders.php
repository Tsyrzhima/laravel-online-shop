<?php

namespace App\Console\Commands;

use App\Jobs\SendHttpRequest;
use App\Models\Order;
use Illuminate\Console\Command;

class checkYougileTasksForOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-yougile-tasks-for-orders';

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
        $orders = Order::whereNull('yougile_task_id')->get();
        foreach ($orders as $order) {
            SendHttpRequest::dispatch($order);
        }
    }
}
