<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin;

use Eccube\Application;

class Event
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}
