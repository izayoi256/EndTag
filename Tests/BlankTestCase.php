<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Tests;

use Eccube\Tests\EccubeTestCase;

abstract class BlankTestCase extends EccubeTestCase
{
    public function setUp()
    {
        parent::setUp();
        $tables = array(
            'plg_blank',
        );
        $this->deleteAllRows($tables);
    }
}