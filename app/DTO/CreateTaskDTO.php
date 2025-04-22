<?php

namespace App\DTO;

class CreateTaskDTO
{
    public function __construct(
        private string $title,
        private string $columnId,
        private string $description,
    ){}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getColumnId(): string
    {
        return $this->columnId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'columnId' => $this->getColumnId(),
            'description' => $this->getDescription()
        ];
    }

}
