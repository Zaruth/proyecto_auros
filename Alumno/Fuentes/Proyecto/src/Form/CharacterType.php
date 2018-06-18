<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, array('label' => 'Nombre:', 'attr' => array('class' => 'form-control')))
            ->add('surName', TextType::class, array('label' => 'Primer Apellido:', 'attr' => array('class' => 'form-control')))
            ->add('surName2', TextType::class, array('label' => 'Segundo Apellido:', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('gender', ChoiceType::class, array('label' => 'Sexo:', 'attr' => array('class' => 'form-control'),
                                                    'choices'  => array(
                                                        'Hombre' => 'Hombre',
                                                        'Mujer' => 'Mujer')
                                                    ))
            ->add('race', ChoiceType::class, array('label' => 'Raza:', 'attr' => array('class' => 'form-control', 'onchange' => 'cambiatextoraza()'),
                                                    'choices'  => array(
                                                        'Humano' => 'Humano',
                                                        'Orco oscuro' => 'Orco oscuro',
                                                        'Ligneo' => 'Ligneo',
                                                        'Elfo solar' => 'Elfo solar',
                                                        'Efrit' => 'Efrit',
                                                        'Lapidum' => 'Lapidum')
                                                    ))
            ->add('age', IntegerType::class, array('label' => 'Edad:', 'attr' => array('min' => 16, 'max' => 60, 'value' => 16,'class' => 'form-control')))
            //->add('birthdate')
            ->add('class', ChoiceType::class, array('label' => 'Clase:', 'attr' => array('class' => 'form-control', 'onchange' => 'cambiatextoclase()'),
                                                    'choices'  => array(
                                                        'Adepto' => 'Adepto',
                                                        'Soldado' => 'Soldado',
                                                        'Bandido' => 'Bandido')
                                                    ))
            //->add('subclass')
            //->add('exp')
            //->add('energy')
            //->add('skillpoints')
            //->add('gold')
            //->add('silver')
            //->add('copper')
            //->add('worked')
            //->add('workStart')
            //->add('workFinish')
            //->add('fights')
            //->add('fightsWon')
            //->add('lastFight')
            //->add('lastForum')
            //->add('lastMsg')
            //->add('bot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
