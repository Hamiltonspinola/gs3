<?php

namespace Cerimonial\Http\Controller;

class ErrorController
{
    /**
     * @param array $data
     */
    public function error(array $data): void
    {
        echo "<h3>Whoops!</h3>", "<pre>", print_r($data, true), "</pre>";
    }
}
