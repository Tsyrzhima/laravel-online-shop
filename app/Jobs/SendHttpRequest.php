<?php

namespace App\Jobs;

use App\DTO\CreateTaskDTO;
use App\Models\Order;
use App\Services\Clients\YougileClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendHttpRequest implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected Order $order;
    protected YougileClient $yougileClient;
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->yougileClient = new YougileClient();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $description = "Имя: {$this->order->contact_name} <br>"
            . "Адрес: {$this->order->address} <br>"
            . "Телефон: {$this->order->contact_phone} <br>"
            . "Список товаров: <br>";
        $orderProducts = $this->order->orderProducts()->get();
        foreach ($orderProducts as $orderProduct) {
            $description .= "product_id: " . $orderProduct->product_id . "  "
                . $orderProduct->product->name . " - ". $orderProduct->amount . " шт.<br>";
        }

        $orderId = $this->order->id;
        $dto = new CreateTaskDTO(
            "Заказ # {$orderId}",
            "e94823f0-3ff1-449c-a8a8-0a492efcfed5",
            "{$description}"
        );

        $taskId = $this->yougileClient->createTask($dto);

        if ($taskId) {
            $this->order->yougile_task_id = $taskId;
            $this->order->save();
        }

    }
}
