<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrin\Form\orderBy;
use App\Entity\Artikel;
use App\Entity\Bestelopdracht;
use App\Entity\Bestelregel;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\BestelopdrachtRepository;

//EntiteitType vervangen door b.v. KlantType
class BestelregelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		//gebruiken wat je nodig hebt, de id hoeft er niet bij als deze auto increment is
    $builder->add('artikelnummer', EntityType::class, array(
        'class' => 'AppBundle:Artikel',
        'choice_label' => 'omschrijving',
        'label' => 'Artikel',
    ));
    $builder->add('bestelordernummer', EntityType::class, array(
        'class' => 'AppBundle:Bestelopdracht',
        'query_builder' => function (BestelopdrachtRepository $er) {
       return $er->createQueryBuilder('b')
           ->orderBy('b.bestelordernummer', 'DESC');
           },
        'choice_label' => 'bestelordernummer'
      ));
    $builder->add('aantal', IntegerType::class);

    //naam is b.v. een attribuut of variabele van klant
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
