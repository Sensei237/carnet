<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        
        return $this->render('home/index.html.twig', [
            "contacts" => $this->getDoctrine()->getRepository(Adresse::class)->findBy([], ["contactName"=>"ASC"]),
            
        ]);
    }

    /**
     * @Route("/add", name="new")
     * @Route("/edit/{id}", name="edit")
     */
    public function addAdress(Adresse $adresse=null, Request $request) {
        if (!$adresse) {
            $adresse = new Adresse();
        }
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            if ($adresse->image) {
                $filename = md5(uniqid()).'_'.time();
                try {
                    $adresse->image->move($this->getParameter('image_directory'), $filename);
                    $adresse->setPhoto($filename);
                } catch (FileException $e) {
                    die($e->getMessage());
                }
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($adresse);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/add.html.twig', [
            'form' => $form->createView(),
            'c' => $adresse,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAdresse(Adresse $adresse, Request $request) {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($adresse);
        $manager->flush();
        if ($request->isXmlHttpRequest()) {
            return new Response(json_encode(['error'=>false, 'msg'=>"Adresse supprimée !"]));
        }
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function showAdressDetails(Adresse $adresse) {

        return $this->render('home/details.html.twig', [
            'c' => $adresse,

        ]);
    }
}
