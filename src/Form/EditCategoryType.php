<?php

namespace App\Form;

use App\Command\AddCategoryCommand;
use App\Command\EditCategoryCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddCategoryType
 * @package App\Form
 */
class EditCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class, array (
                'required' => true,
            ))
            ->add('name', TextType::class, array (
                'required' => true,
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditCategoryCommand::class,
            'csrf_protection' => false,
        ));
    }
}