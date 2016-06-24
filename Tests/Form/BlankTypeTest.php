<?php
/*
 * Copyright(c) 2000-2016 Daisy CO., LTD. All Rights Reserved.
 *
 * http://daisy.link/
 */

namespace Plugin\BlankPlugin\Tests\Form;

use Plugin\BlankPlugin\Tests\BlankTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class BlankTypeTest extends BlankTestCase
{
    /** @var Form */
    protected $form;

    protected $formData = array(
        'name' => '',
    );

    public function setUp()
    {
        parent::setUp();
        $this->form = $this->app['form.factory']
            ->createBuilder('blank', null, array('csrf_protection' => false))
            ->getForm();
    }

    public function testValidData()
    {
        $this->app['request'] = new Request();
        $this->form->submit($this->formData);
        $this->assertTrue($this->form->isValid());
    }
}