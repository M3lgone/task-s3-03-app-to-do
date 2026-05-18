<?php

declare(strict_types=1);

class DashboardController extends Controller
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }
    public function indexAction()
    {
        $tasks = $this->taskModel->getTasks();

        $status = $this->_getParam('status');

        if ($status) {
            $tasks = array_filter($tasks, fn ($task) => $task['status'] === $status);
        }
        $this->view->tasks = $tasks;
    }
}
