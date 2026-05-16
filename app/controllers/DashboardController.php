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
        $this->view->tasks = $this->taskModel->getTasks();
    }
}
