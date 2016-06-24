<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Tests\Repository;

use Plugin\BlankPlugin\Tests\BlankTestCase;

class BlankRepositoryTest extends BlankTestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testBlank()
    {
        $this->expected = 1;
        $this->actual = 1;
        $this->verify();
    }
}