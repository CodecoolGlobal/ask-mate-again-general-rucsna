<?php

namespace app\Controllers;

use \eftec\bladeone\BladeOne;

class BaseController
{
    protected BladeOne $blade;

    public function __construct(BladeOne $blade)
    {
        $this->blade = $blade;
    }
}
