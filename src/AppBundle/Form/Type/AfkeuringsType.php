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

class AfkeuringsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                  ->add('Afkeuringscode', ChoiceType::class, array(
          'choices'  => array(
              '00 - Kwaliteit van product is goed' => '00 Kwaliteit van product is goed',
              '01 - Verpakking is stuk' => '01 - Verpakking is stuk',
              '02- Product is beschadigd' => '02- Product is beschadigd',
              '03- Verkeerd geleverd artikel (niet besteld)' => '03- Verkeerd geleverd artikel (niet besteld)',
              '04- Verpakking is opengemaakt' => '04- Verpakking is open gemaakt',
              '05- Voldoet niet aan de kwaliteit' => '05- Voldoet niet aan de kwaliteit',
              '99- Overige' => '99- Overige'
            ),
          ));
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bestelregel', //Entiteit vervangen door b.v. Klant
        ));
    }
}

?>
