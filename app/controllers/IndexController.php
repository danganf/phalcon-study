<?php

use Phalcon\Mvc\Model\Resultset;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        return $this->helper->msgJson( ['messages' => 'OK'] );
    }

}
