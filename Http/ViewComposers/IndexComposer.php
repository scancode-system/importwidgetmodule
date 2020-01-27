<?php

namespace Modules\ImportWidget\Http\ViewComposers;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ImportWidget\Services\SessionService;

class IndexComposer extends ServiceComposer 
{

    private $module;
    private $method;

    private $title;
    private $new;
    private $updated;
    private $failures;
    private $completed;

    public function assign($view)
    {
        $this->init($view);

        $this->title();
        $this->new();
        $this->updated();
        $this->failures();
        $this->completed();
    }


    private function init($view)
    {
        $this->module = $view->module;
        $this->method = $view->method;

        if(isset($view->clear))
        {
            SessionService::clear($this->module, $this->method);
        }
    }

    private function title()
    {
        $this->title = SessionService::title($this->module, $this->method); //$this->module;
        if(is_null($this->title))
        {
            $this->title = $this->module;
        }
    }

    private function new()
    {
        $this->new = SessionService::new($this->module, $this->method);
    }

    private function updated()
    {
        $this->updated = SessionService::updated($this->module, $this->method);
    }

    private function failures()
    {
        $this->failures = SessionService::failures($this->module, $this->method);
    }

    private function completed()
    {
        $this->completed = SessionService::completed($this->module, $this->method);
    }

    public function view($view)
    {
        $view->with('module', $this->module);
        $view->with('method', $this->method);
        $view->with('title', $this->title);
        $view->with('new', $this->new);
        $view->with('updated', $this->updated);
        $view->with('failures', $this->failures);
        $view->with('completed', $this->completed);
    }

}