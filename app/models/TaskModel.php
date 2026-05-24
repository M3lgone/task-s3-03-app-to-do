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
            "id" => $this->generateId($tasks),
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

    private function generateId(array $tasks): int
    {
        if (empty($tasks)) {
            return 1;
        }
        return max(array_column($tasks, 'id')) + 1;
    }

    public function getTaskById(int $id): ?array
    {
        foreach ($this->getTasks() as $task) {
            if ($task['id'] === $id) {
                return $task;
            }
        }
        return null;
    }

    public function updateTask(int $id, string $name, string $description, string $startDate, string $finishDate, string $user): void
    {
        $tasks = $this->getTasks();

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $id) {
                $tasks[$key]['name'] = $name;
                $tasks[$key]['description'] = $description;
                $tasks[$key]['startDate'] = $startDate;
                $tasks[$key]['finishDate'] = $finishDate;
                $tasks[$key]['user'] = $user;
            }
        }
        $this->saveTasks($tasks);
    }

    public function deleteTask(int $id): void
    {
        $tasks = $this->getTasks();

        $tasks = array_filter($tasks, fn ($task) => $task['id'] !== $id);

        $this->saveTasks(array_values($tasks));
    }

    public function nextStatus(int $id): void
    {
        $tasks = $this->getTasks();

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $id) {
                $current = $task['status'];

                if ($current === TaskStatus::PENDING->value) {
                    $tasks[$key]['status'] = TaskStatus::IN_PROGRESS->value;
                } elseif ($current === TaskStatus::IN_PROGRESS->value) {
                    $tasks[$key]['status'] = TaskStatus::DONE->value;
                } else {
                    $tasks[$key]['status'] = TaskStatus::PENDING->value;
                }
            }
        }
        $this->saveTasks($tasks);
    }

}
