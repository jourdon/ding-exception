<?php

namespace Jourdon\DingException;

class DingExceptionNotification
{
    protected  $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function notify($exception)
    {
        if ($this->config['enabled']) {
            DingExceptionJob::dispatch($exception, $this->config);
        }
    }
}