<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Tests\Service;

use Plugin\BlankPlugin\Tests\BlankTestCase;

class BlankServiceTest extends BlankTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testBlank()
    {
        $this->assertEquals(1, 1);
    }
}