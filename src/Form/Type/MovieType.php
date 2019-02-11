<?php

namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MovieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'documentation' => [
                'description' => 'Movie name',
            ],
            'constraints' => new NotBlank(),
        ]);
        $builder->add('release_date', DateType::class, [
            'documentation' => [
                'description' => 'Release date',
            ],
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
            'documentation' => [
                '_token' => [
                    'description' => 'aa',
                ],
            ],
        ]);
    }
}
