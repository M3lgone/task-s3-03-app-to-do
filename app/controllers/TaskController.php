<?php

class TaskController extends Controller
{
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
            }
        }
    }
}
