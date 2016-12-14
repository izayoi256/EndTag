<?php

namespace Plugin\EndTag\Form\Extension\Front;

use Eccube\Application;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class EntryTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hoge', 'choice', array(
                'required' => true,
                'choices' => array(
                    '0' => 'fuga',
                    '1' => 'piyo',
                ),
                'data' => '0',
                'expanded' => true,
                'multiple' => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
                'mapped' => false,
            ))
        ;
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return 'entry';
    }
}