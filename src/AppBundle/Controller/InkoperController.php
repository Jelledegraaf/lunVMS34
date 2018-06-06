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
use AppBundle\Form\Type\ArtikelWijzigMinType;
use AppBundle\Form\Type\ArtikelZoeken;
use AppBundle\Form\Type\OntvangstType;
use AppBundle\Form\Type\NieuwOntvangstType;
use AppBundle\Form\Type\AfkeuringsType;

class InkoperController extends Controller
{
    /**
    * @Route("/inkoper/artikel/nieuw", name="nieuwArtikel")
    */
    public function nieuwArtikel(Request $request) {
      $nieuwArtikel = new Artikel();
      $form = $this->createForm(ArtikelType::class, $nieuwArtikel);

      $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nieuwArtikel);
            $em->flush();
            return $this->redirect($this->generateurl("nieuwArtikel"));
          }

      return new Response($this->render('formNieuwArtikel.html.twig', array('form' => $form->createView())));
    }

    /**
    * @Route ("/inkoper/artikel/wijzig/{artikelnummer} ", name="wijzigArtikel")
    */
    public function wijzigArtikel(Request $request, $artikelnummer){
       $bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
       $form = $this->createForm(ArtikelType::class, $bestaandProduct);

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($bestaandProduct);
           $em->flush();
           return $this->redirect($this->generateurl("wijzigartikel", array("artikelnummer" => $bestaandProduct->getArtikelnummer())));
         }

       return new Response($this->renderView('formWijzigArtikel.html.twig', array('form' => $form->createView())));
     }


    /**
    * @Route ("/inkoper/artikel/wijzigMinVoorraad/{artikelnummer} ", name="wijzigMinVoorraad")
    */
      public function wijzigArtikelMV(Request $request, $artikelnummer){
        $bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
        $form = $this->createForm(ArtikelWijzigMinType::class, $bestaandProduct);

        $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bestaandProduct);
            $em->flush();
        return $this->redirect($this->generateurl("wijzigMinVoorraad", array("artikelnummer" => $bestaandProduct->getArtikelnummer())));
      }

    return new Response($this->renderView('formWijzigMinVoorraad.html.twig', array('form' => $form->createView())));
    }


    /**
    * @Route ("/inkoper/artikelen/alle", name="alleArtikelen")
    */
    public function alleArtikelen(Request $request){
        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();

        return new Response($this->render('AlleArtikelen.html.twig', array('Artikelen' => $artikelen)));
      }


    /**
    * @Route("/inkoper/artikel/zoeken", name="zoekenArtikel")
    */
    public function zoekArtikel(Request $request) {

    //  $nieuwArtikel = new Artikel();
      $form = $this->createForm(ArtikelZoeken::class);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $artikel = $form->getData();

          $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findBy(
          array('omschrijving'=> $artikel->getOmschrijving())
          );
          return new Response($this->render('zoekresultaat.html.twig', array('Artikelen' => $artikelen)));
        }


        return new Response($this->render('zoekformulier.html.twig', array('form' => $form->createView())));
      }

      /**
      * @Route("/inkoper/bestelopdracht/nieuw", name="bestelopdrachtNieuw")
      */
      public function nieuweBestelOpdracht(Request $request) {
          $nieuweBestelOpdracht = new bestelOpdracht();
          $form = $this->createForm(BestelOpdrachtType::class, $nieuweBestelOpdracht);

          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($nieuweBestelOpdracht);
              $em->flush();

          $bestelordernummer = $nieuweBestelOpdracht->getBestelordernummer();
            return $this->redirect($this->generateurl("bestelregelNieuw"));
          }

          return new Response($this->render('formNieuweBestelling.html.twig', array('form' => $form->createView())));
      }

      /**
      * @Route("/inkoper/bestelopdracht/alle", name="alleBestellingen")
      */
      public function alleBestellingen(Request $request) {
        $Bestelopdrachten = $this->getDoctrine()->getRepository("AppBundle:Bestelopdracht")->findAll();

        return new Response($this->render('AlleBestellingen.html.twig', array ('Bestelopdrachten' => $Bestelopdrachten)));
      }

      /**
      * @Route("/inkoper/bestelregel/nieuw", name="bestelregelNieuw")
      */
      public function nieuweBestelRegel(Request $request) {
        $nieuweBestelRegel = new Bestelregel();
        $form = $this->createForm(BestelregelType::class, $nieuweBestelRegel);
        $nieuweBestelRegel->setOntvangen(0);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nieuweBestelRegel);
            $em->flush();
            return $this->redirect($this->generateurl("bestelregelNieuw"));
        }

        return new Response($this->renderView('formNieuweBestelregel.html.twig', array('form' => $form->createView())));
        }

      /**
      * @Route("/inkoper/bestelregel/{bestelordernummer}", name="alleBestelregels")
      */
      public function bestelregelsOpBoNr(Request $request, $bestelordernummer) {
        $bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findByBestelordernummer("$bestelordernummer");
        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();

        return new Response($this->render('AlleBestelregels.html.twig', array ('Bestelregels' => $bestelregels, 'Artikelen' => $artikelen)));
        }

      /**
      * @Route("/inkoper/ontvangenbestelregels/afgekeurd", name="afgekeurdeBestellingen")
      */
      public function afgekeurdeBestelregels(Request $request) {
        $bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findBy(array('ontvangen' => 1, 'afgekeurd' => 1));
        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();
        $bestelopdrachten = $this->getDoctrine()->getRepository("AppBundle:Bestelopdracht")->findAll();


        return new Response($this->render('AfgekeurdeBestellingen.html.twig', array ('Bestelregels' => $bestelregels, 'Artikelen' => $artikelen, 'Bestelopdrachten' => $bestelopdrachten)));
        }

      /**
      * @Route("/inkoper/ontvangenbestelregels/goedgekeurd", name="goedgekeurdeBestellingen")
      */
      public function goedgekeurdeBestelregels(Request $request) {
        $bestelregels = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->findBy(array('ontvangen' => 1, 'afgekeurd' => 0));
        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findAll();
        $bestelopdrachten = $this->getDoctrine()->getRepository("AppBundle:Bestelopdracht")->findAll();


        return new Response($this->render('OntvangenBestellingen.html.twig', array ('Bestelregels' => $bestelregels, 'Artikelen' => $artikelen, 'Bestelopdrachten' => $bestelopdrachten)));
        }

      /**
      * @Route("/inkoper/bestelregel/wijzig/afkeuringscode/{id}", name="afkeuringscodeToewijzen")
      */
      public function afkeuringscodeToewijzen(Request $request, $id) {
        $huidigBestelregel = $this->getDoctrine()->getRepository("AppBundle:Bestelregel")->find($id);
        $form = $this->createForm(AfkeuringsType::class, $huidigBestelregel);

        $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($huidigBestelregel);
            $em->flush();
        return $this->redirect($this->generateurl("afgekeurdeBestellingen"));
      }

        return new Response($this->render('formWijzigBestelregel.html.twig', array('form' => $form->createView())));
      }
}
