<?php

namespace App\Form;

use App\Entity\Thread;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ThreadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Título:', 'attr' => array('class' => 'form-control')))
            ->add('category', ChoiceType::class, array('label' => 'Categoría:', 'attr' => array('class' => 'form-control'),
                                                        'choices'  => array(
                                                            'General' => 'General',
                                                            'Reclutamiento' => 'Reclutamiento',
                                                            'Comercio' => 'Comercio',
                                                            'Guerras' => 'Guerras',
                                                            'Dudas' => 'Dudas',
                                                            'Rincón del borracho' => 'Rincón del borracho',
                                                            )
                                                        ))
            //->add('date')
            //->add('cthread')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Thread::class,
        ]);
    }
}
