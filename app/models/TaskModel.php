<?php

declare(strict_types=1);

class TaskModel
{
    private string $file;

    public function __construct()
    {
        $this->file = ROOT_PATH . '/tasks.json';
    }

    public function addTask(string $name, string $description, string $startDate, string $finishDate, string $user): void
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

        $this->saveTasks($tasks);

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

    private function saveTasks(array $tasks): void
    {
        file_put_contents($this->file, json_encode($tasks, JSON_PRETTY_PRINT));
    }

}
