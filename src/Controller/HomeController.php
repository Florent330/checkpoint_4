<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Show;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index ()
    {

        $showsRepo = $this->getDoctrine()->getManager()->getRepository(Show::class);
        $shows = $showsRepo->findBy([], ['id' => 'DESC'], 5, 0);


        return $this->render('home/index.html.twig', [
            'show' => $shows,

        ]);
    }


    /**
     * @Route("/home/show", name="home_show")
     */
    public function show ()
    {
        $showsRepo = $this->getDoctrine()->getManager()->getRepository(Show::class);
        $shows = $showsRepo->findAll();


        return $this->render('home/show.html.twig', [
            'show' => $shows,
        ]);
    }

    /**
     * @Route("/sample/{id}", name="home_show_one")
     * @param $id
     * @return Response
     */
    public function showOne ( $id )
    {
        $repo = $this->getDoctrine()->getRepository(Show::class);
        $show = $repo->find($id);

        return $this->render('home/showOneEvent.html.twig', [
            'show' => $show,
        ]);
    }


}
