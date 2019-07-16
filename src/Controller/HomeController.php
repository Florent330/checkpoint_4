<?php

namespace App\Controller;

use App\Entity\Show;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()    {

        $showsRepo = $this->getDoctrine()->getManager()->getRepository(Show::class);
        $shows = $showsRepo->findBy([],['id'=> 'DESC'], 5, 0);


        return $this->render('home/index.html.twig', [
            'show' => $shows,

        ]);
    }


}
