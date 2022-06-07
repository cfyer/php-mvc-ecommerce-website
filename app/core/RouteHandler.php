<?php

namespace App\Core;

use AltoRouter;

class RouteHandler
{
    protected $match;
    protected $controller;
    protected $method;

    public function __construct(AltoRouter $altoRouter)
    {
        $this->match = $altoRouter->match();

        if (!$this->match) {
            return View::blade('errors.404');
        }

        $this->getTarget();

        $this->callTarget();
    }

    protected function getTarget()
    {
        list($controller, $this->method) = explode('@', $this->match['target']);
        $this->controller = "\App\Controllers\\" . $controller;

        if (!class_exists($this->controller))
            throw new \Exception("Controller {$this->controller} is not exists.");

        if (!is_callable([new $this->controller, $this->method]))
            throw new \Exception("Method {$this->method} is not defined in {$this->controller}.");
    }

    protected function callTarget()
    {
        call_user_func_array([new $this->controller, $this->method], [$this->match['params']]);
    }
}
