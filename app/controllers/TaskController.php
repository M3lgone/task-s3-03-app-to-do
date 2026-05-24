<?php

declare(strict_types=1);

class TaskController extends Controller
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['name', 'description', 'start_date', 'user'];

            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $errors[] = $field . ' is required';
                }
            }
            if (!empty($errors)) {
                $this->view->errors = $errors;
            } else {
                $model = new TaskModel();
                $model->addTask(
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['start_date'],
                    $_POST['finish_date'],
                    $_POST['user']
                );
                header('Location: ' . WEB_ROOT . '/dashboard');
                exit();
            }
        }
    }
    public function editAction()
    {
        $id = (int) $this->_getParam('id');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['name', 'description', 'start_date', 'user'];

            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $errors[] = $field . ' is required';
                }
            }
            if (!empty($errors)) {
                $this->view->errors = $errors;
            } else {
                $this->taskModel->updateTask(
                    $id,
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['start_date'],
                    $_POST['finish_date'],
                    $_POST['user']
                );
                header('Location: ' . WEB_ROOT . '/dashboard');
                exit();
            }
        }
        $this->view->task = $this->taskModel->getTaskById($id);
    }

    public function deleteAction()
    {
        $id = (int) $this->_getParam('id');

        $this->taskModel->deleteTask($id);

        header('Location: ' . WEB_ROOT . '/dashboard');
        exit();
    }

    public function checkAction()
    {
        $id = (int) $_POST['id'];
        $this->taskModel->nextStatus($id);
        header('Location: ' . WEB_ROOT . '/dashboard');
        exit();
    }
}
