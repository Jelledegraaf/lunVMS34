<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Bestelopdracht;
use AppBundle\Entity\Bestelregel;
use AppBundle\Entity\Artikel;
use AppBundle\Form\Type\BestelOpdrachtType;
use AppBundle\Form\Type\BestelregelType;
use AppBundle\Form\Type\ArtikelType;
use AppBundle\Form\Type\NieuwOntvangstType;


class MagazijnmeesterController extends Controller
{
    /**
    * @Route("/magazijnmeester/ontvangenbestelregels/0", name="teOntvangenBestelregels")
    */
    public function teOnvangenBestelregels(Request $request) {
      $Bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findByontvangen('0');
      $Artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();
      $Bestelopdrachten = $this->getDoctrine()->getRepository("AppBundle:Bestelopdracht")->findAll();


      return new Response($this->render('NogTeOntvangen.html.twig', array ('Bestelregels' => $Bestelregels, 'Artikelen' => $Artikelen, 'Bestelopdrachten' => $Bestelopdrachten)));
      }

    /**
    * @Route("/magazijnmeester/bestelregel/wijzig/{id}", name="ontvangstRegistreren")
    */
    public function wijzigBestelregel(Request $request, $id) {
      $huidigBestelregel = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->find($id);
      $form = $this->createForm(NieuwOntvangstType::class, $huidigBestelregel);

      $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($huidigBestelregel);
          $em->flush();
      return $this->redirect($this->generateurl("teOntvangenBestelregels"));
    }

      return new Response($this->render('formWijzigBestelregel.html.twig', array('form' => $form->createView())));
    }
}
