<?php

namespace Selleck\Todo\Action\App;


use Selleck\Todo\Action;

class Start extends Action
{

    public function run()
    {
        return $this->render('tasks');
    }

}