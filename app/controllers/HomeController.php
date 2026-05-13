<?php

class HomeController extends Controller
{
    public function indexAction()
    {
        $this->view->render('home/home.phtml');
    }
}
