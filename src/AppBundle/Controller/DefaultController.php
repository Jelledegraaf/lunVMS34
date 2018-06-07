<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
   * @Route("/", name="homepage")
   */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT a FROM AppBundle:Artikel a WHERE a.voorraad < a.minimumVoorraad');
        $artikelen = $query->getResult();

        // Als er artikelen zijn die een te lage voorraad hebben..
        if(sizeof($artikelen) > 0) { // Meerdere artikelen gevonden
          if(sizeof($artikelen) == 1) { // Een artikel gevonden
            $melding = "Er is een artikel onder de minimum voorraad!";
          } else {
            $melding = "Er zijn artikelen die onder de minimum voorraad zijn!";
          }
        } else { // Geen artikelen gevonden
          $melding = "";
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'melding' => $melding,
        ]);
      }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
