<?php

namespace App\Services\Clients;

use App\DTO\CreateTaskDTO;
use Illuminate\Support\Facades\Http;

class YougileClient
{
    private string $baseUrl;
    private string $apiKey;
    public function __construct()
    {
        $this->baseUrl = config('services.yougile.base_url');
        $this->apiKey = config('services.yougile.api_key');
    }


    public function createTask(CreateTaskDTO $createTaskDTO): ?string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . 'tasks', $createTaskDTO->toArray());

        if (!$response->successful()) {
            throw new \Exception('Failed to create task');
        }

        $data = $response->json();

        return $data['id'];

    }
    public function deleteTask(string $taskId)
    {
        $response = retry(3, function () use ($taskId) {
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->delete($this->baseUrl . '/tasks/' . $taskId);
        });

    }

}
