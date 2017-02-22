<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Film;

/**
 * Film controller.
 *
 * @Route("/film")
 */
class FilmController extends Controller
{
    /**
     * Lists all Film entities.
     *
     * @Route("/", name="film_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $films = $em->getRepository('AppBundle:Film')->findAll();

        return $this->render('film/index.html.twig', array(
            'entities' => $films,
        ));
    }

    /**
     * Creates a new Film entity.
     *
     * @Route("/new", name="film_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $film = new Film();
        $form = $this->createForm('AppBundle\Form\FilmType', $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            $this->addFlash('success', 'New Film added');

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/show", name="film_show")
     * @Method("GET")
     */
    public function showAction(Film $film)
    {
        return $this->render('film/show.html.twig', [
            'film' => $film
        ]);
    }

    /**
     * Displays a form to edit an existing Film entity.
     *
     * @Route("/{id}/edit", name="film_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Film $film)
    {
        $editForm = $this->createForm('AppBundle\Form\FilmType', $film);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            $this->addFlash('success', 'Film updated');

            return $this->redirectToRoute('film_edit', array('id' => $film->getId()));
        }

        return $this->render('film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Film entity.
     *
     * @Route("/{id}", name="film_delete", options={"expose"=true})
     * @Method("POST")
     */
    public function deleteAction(Request $request, Film $film)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();

            return new JsonResponse('deleted', 200);
        }

        return new JsonResponse('Internal Sever Error', 500);
    }
}
