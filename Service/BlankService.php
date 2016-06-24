<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Service;

use Eccube\Application;

class BlankService
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
