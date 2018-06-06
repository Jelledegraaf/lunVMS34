<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NieuwOntvangstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('ontvangstdatum', DateType::class, array(
                'format' => 'dd-MM-yyyy'))
              ;
        $builder
            ->add('kwaliteit', ChoiceType::class, array(
                'choices'  => array(
                    'Goed' => True,
                    'Niet Goed' => False
                )))
              ;
        $builder
            ->add('afgekeurd', ChoiceType::class, array(
                'choices'  => array(
                    'Ja' => true,
                    'Nee' => false
                )));
        $builder
            ->add('ontvangen', ChoiceType::class, array(
            'choices'  => array(
                'Ja' => 1,
                'Nee' => 0
            )))
            ;


        //zie
        //http://symfony.com/doc/current/forms.html#built-in-field-types
        //voor meer typen invoer
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bestelregel', //Entiteit vervangen door b.v. Klant
        ));
    }
}

?>
