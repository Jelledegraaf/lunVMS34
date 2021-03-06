<?php
/**
 * Created by PhpStorm.
 * User: Marice
 * Date: 26-05-18
 * Time: 13:59
 */

// src/AppBundle/Form/Type/UserType.php
namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Gebruikersnaam'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Wachtwoord'),
                'second_options' => array('label' => 'Herhaal Wachtwoord')))
            ->add('roles', ChoiceType::class,[
                'multiple' => true,
                'expanded' => true, // render check-boxes
                'choices' => [
                     'Admin' => 'ROLE_ADMIN',
                     'Beheerder' => 'ROLE_BEHEERDER',
                     'Inkoper' => 'ROLE_INKOPER',
                     'Magazijnmeester' => 'ROLE_MAGAZIJNMEESTER',
                     'Gebruiker' => 'ROLE_USER',
                    ],
                'label' => 'Rollen',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
