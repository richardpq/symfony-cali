<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\FilmPrice;

/**
 * FilmPrice controller.
 *
 * @Route("/film-price")
  */
class FilmPriceController extends Controller
{
    /**
     * Lists all FilmPrice entities.
     *
     * @Route("/", name="film-price_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $filmPrices = $manager->getRepository('AppBundle:FilmPrice')->findAll();

        return $this->render('filmprice/index.html.twig', array(
            'entities' => $filmPrices,
        ));
    }

    /**
     * Creates a new FilmPrice entity.
     *
     * @Route("/new", name="film-price_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $filmPrice = new FilmPrice();
        $form = $this->createForm('AppBundle\Form\FilmPriceType', $filmPrice);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            /** @var FilmPrice $existingFilmPrice */
            $existingFilmPrice = $manager->getRepository('AppBundle:FilmPrice')
                ->findExistingNoDeprecated($filmPrice->getFilm())
            ;

            if ($existingFilmPrice) {
                $existingFilmPrice->setEndDate(new \DateTime('now'));
            }

            $manager->persist($filmPrice);
            $manager->flush();

            return $this->redirectToRoute('film-price_index');
        }

        return $this->render('filmprice/new.html.twig', array(
            'filmPrice' => $filmPrice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FilmPrice entity.
     *
     * @Route("/{id}/edit", name="film-price_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FilmPrice $filmPrice)
    {
        $editForm = $this->createForm('AppBundle\Form\FilmPriceType', $filmPrice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filmPrice);
            $em->flush();

            return $this->redirectToRoute('film-price_edit', array('id' => $filmPrice->getId()));
        }

        return $this->render('filmprice/edit.html.twig', array(
            'filmPrice' => $filmPrice,
            'edit_form' => $editForm->createView(),
        ));
    }
}
