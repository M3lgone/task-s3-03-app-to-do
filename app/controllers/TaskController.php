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
        }
    }
}
