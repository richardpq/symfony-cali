<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\FilmCategory;

/**
 * FilmCategory controller.
 *
 * @Route("/film-category")
 */
class FilmCategoryController extends Controller
{
    /**
     * Lists all FilmCategory entities.
     *
     * @Route("/", name="film-category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $filmCategories = $em->getRepository('AppBundle:FilmCategory')->findAll();

        return $this->render('filmcategory/index.html.twig', array(
            'entities' => $filmCategories,
        ));
    }

    /**
     * Creates a new FilmCategory entity.
     *
     * @Route("/new", name="film-category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $filmCategory = new FilmCategory();
        $form = $this->createForm('AppBundle\Form\FilmCategoryType', $filmCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filmCategory);
            $em->flush();

            $this->addFlash('success', 'New Film Category created');

            return $this->redirectToRoute('film-category_index');
        }

        return $this->render('filmcategory/new.html.twig', array(
            'filmCategory' => $filmCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FilmCategory entity.
     *
     * @Route("/{id}/edit", name="film-category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FilmCategory $filmCategory)
    {
        $editForm = $this->createForm('AppBundle\Form\FilmCategoryType', $filmCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($filmCategory);
                $em->flush();

                $this->addFlash('success', 'Film Category updated');

                return $this->redirectToRoute('film-category_edit', array('id' => $filmCategory->getId()));
            } else {
                $this->addFlash('warning', "Film Category couldn't be updated");
            }
        }

        return $this->render('filmcategory/edit.html.twig', array(
            'filmCategory' => $filmCategory,
            'edit_form' => $editForm->createView(),
        ));
    }
}
