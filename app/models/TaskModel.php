<?php

declare(strict_types=1);

class TaskModel
{
    private $file;

    public function __construct()
    {
        $this->file = ROOT_PATH . '/tasks.json';
    }

    public function addTask(string $name, string $description, string $startDate, string $finishDate, string $user)
    {
        $tasks = $this->getTasks();

        $task = [
            "name" => $name,
            "description" => $description,
            "status" => TaskStatus::PENDING->value,
            "startDate" => $startDate,
            "finishDate" => $finishDate,
            "user" => $user
        ];

        $tasks[] = $task;

        file_put_contents($this->file, json_encode($tasks, JSON_PRETTY_PRINT));

    }

    public function getTasks(): array
    {
        if (!file_exists($this->file)) {
            return[];
        }

        $content = file_get_contents($this->file);
        $tasks = json_decode($content, true);

        if ($tasks === null) {
            return [];
        }

        return $tasks;
    }

}
