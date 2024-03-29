<?php

namespace App\Controller;

use App\Entity\Show;
use App\Form\ShowType;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/show")
 */
class ShowController extends AbstractController
{
    /**
     * @Route("/", name="show_index", methods={"GET"})
     * @param ShowRepository $showRepository
     * @return Response
     */
    public function index ( ShowRepository $showRepository ): Response
    {
        return $this->render('show/index.html.twig', [
            'shows' => $showRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="show_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new ( Request $request ): Response
    {
        $show = new Show();
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($show);
            $entityManager->flush();
            $this->addFlash('success', 'Le spectacle a bien été ajouté');

            return $this->redirectToRoute('show_index');
        }

        return $this->render('show/new.html.twig', [
            'show' => $show,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show_show", methods={"GET"})
     * @param Show $show
     * @return Response
     */
    public function show ( Show $show ): Response
    {
        return $this->render('show/show.html.twig', [
            'show' => $show,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="show_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Show $show
     * @return Response
     */
    public function edit ( Request $request, Show $show ): Response
    {
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Les éléments ont bien été mofifiés');
            return $this->redirectToRoute('show_index');
        }

        return $this->render('show/edit.html.twig', [
            'show' => $show,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show_delete", methods={"DELETE"})
     * @param Request $request
     * @param Show $show
     * @return Response
     */
    public function delete ( Request $request, Show $show ): Response
    {
        if ($this->isCsrfTokenValid('delete' . $show->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($show);
            $entityManager->flush();
            $this->addFlash('danger', 'Le spectacle a bien été supprimé');
        }

        return $this->redirectToRoute('show_index');
    }
}
