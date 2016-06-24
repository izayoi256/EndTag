<?php

namespace Plugin\BlankPlugin\Form\Extension;

use Eccube\Application;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BlankTypeExtension extends AbstractTypeExtension
{

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return 'blank';
    }
}