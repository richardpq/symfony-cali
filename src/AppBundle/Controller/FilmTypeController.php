<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\FilmType;
use AppBundle\Form\FilmTypeType;

/**
 * FilmType controller.
 *
 * @Route("/film-type")
 */
class FilmTypeController extends Controller
{
    /**
     * Lists all FilmType entities.
     *
     * @Route("/", name="film-type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $filmTypes = $em->getRepository('AppBundle:FilmType')->findAll();

        return $this->render('filmtype/index.html.twig', array(
            'entities' => $filmTypes,
        ));
    }

    /**
     * Creates a new FilmType entity.
     *
     * @Route("/new", name="film-type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $filmType = new FilmType();
        $form = $this->createForm(FilmTypeType::class, $filmType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filmType);
            $em->flush();

            return $this->redirectToRoute('film-type_index');
        }

        return $this->render('filmtype/new.html.twig', array(
            'entity' => $filmType,
            'form' => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing FilmType entity.
     *
     * @Route("/{id}/edit", name="film-type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FilmType $filmType)
    {
        $editForm = $this->createForm(FilmTypeType::class, $filmType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filmType);
            $em->flush();

            return $this->redirectToRoute('film-type_edit', array('id' => $filmType->getId()));
        }

        return $this->render('filmtype/edit.html.twig', array(
            'entity' => $filmType,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a FilmType entity.
     *
     * @Route("/{id}", name="film-type_delete" , options={"expose"=true})
     * @Method("POST")
     *
     */
    public function deleteAction(Request $request, FilmType $filmType)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($filmType);
            $em->flush();

            return new JsonResponse('deleted', 200);
        }

        return new JsonResponse('Internal Sever Error', 500);
    }
}
