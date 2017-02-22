<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\FilmRoll;

/**
 * FilmRoll controller.
 *
 * @Route("/film-roll")
 */
class FilmRollController extends Controller
{
    /**
     * Lists all FilmRoll entities.
     *
     * @Route("/", name="film-roll_index")
     * @Route("/inventory", name="film-roll-inventory_index")
     * @Route("/manage", name="film-roll_manage_index")
     * @Route("/account", name="film-roll_account")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $inventory = false;
        $manage = false;
        $account = false;

        if (strpos($request->getUri(), 'inventory') !== false) {
            $inventory = true;
        } elseif (strpos($request->getUri(), 'manage') !== false) {
            $manage = true;
        } elseif (strpos($request->getUri(), 'account') !== false) {
            $account = true;
        }

        $filmRolls = $em->getRepository('AppBundle:FilmRoll')->findAll();
        $offices = $em->getRepository('AppBundle:Office')->findAll();
        $estimates = $em->getRepository('AppBundle:Estimate')->findAll();

        return $this->render('filmroll/index.html.twig', array(
            'entities' => $filmRolls,
            'offices' => $offices,
            'inventory' => $inventory,
            'manage' => $manage,
            'account' => $account,
            'estimates' => $estimates
        ));
    }

    /**
     * Creates a new FilmRoll entity.
     *
     * @param Request $request
     *
     * @Route("/new", name="film-roll_new")
     * @Route("/inventory/new", name="film-roll-inventory_new")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $filmRoll = new FilmRoll();
        $form = $this->createForm('AppBundle\Form\FilmRollType', $filmRoll);
        $form->remove('currentWeight');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($filmRoll);
            $em->flush();

            $this->addFlash('success', 'New Film Roll created');

            return $this->redirectToRoute('film-roll-inventory_show', array('id' => $filmRoll->getId()));
        }

        return $this->render('filmroll/new.html.twig', array(
            'filmRoll' => $filmRoll,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FilmRoll entity.
     *
     * @Route("/{id}", name="film-roll_show")
     * @Route("/inventory/{id}", name="film-roll-inventory_show")
     * @Route("/manage/{id}", name="film-roll_manage_show")
     * @Method("GET")
     */
    public function showAction(Request $request, FilmRoll $filmRoll)
    {
        $inventory = false;

        if (strpos($request->getUri(), 'inventory') !== false) {
            $inventory = true;
        }

        return $this->render('filmroll/show.html.twig', array(
            'filmRoll' => $filmRoll,
            'inventory' => $inventory
        ));
    }

    /**
     * @param Request  $request
     * @param FilmRoll $filmRoll
     *
     * @return JsonResponse
     *
     * @Route("/{id}/set-cost", name="film-roll_set_cost")
     * @Method("POST")
     */
    public function setCostAction(Request $request, FilmRoll $filmRoll)
    {
        if ($request->isXmlHttpRequest()) {
            $cost = $request->request->get('cost');
            $filmRoll->setCost($cost);

            $this->getDoctrine()->getManager()->flush();

            $data = [
                'originalCost' => number_format($filmRoll->getCost(),2),
                'costPerSqFt' => $filmRoll->getCostPerSqFt(),
                'inventory' => $filmRoll->getCostPerSqFt() * $filmRoll->getActualSqFt()
            ];

            return new JsonResponse($data, JsonResponse::HTTP_OK);
        }

        throw $this->createNotFoundException();
    }

    /**
     * @Route("/{id}/print-label", defaults={"id"=1}, name="film-roll_print_label", options={"expose" = true})
     * @Method("GET")
     */
    public function printLabelAction(Request $request, FilmRoll $filmRoll)
    {
        return $this->render('filmroll/label.html.twig', ['filmRoll' => $filmRoll]);
    }

    /**
     * Displays a form to edit an existing FilmRoll entity.
     *
     * @Route("/{id}/edit", name="film-roll_edit")
     * @Route("/inventory/{id}/edit", name="film-roll-inventory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FilmRoll $filmRoll)
    {
        $editForm = $this->createForm('AppBundle\Form\FilmRollType', $filmRoll);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($filmRoll);
                $em->flush();

                $this->addFlash('success', 'Film Roll updated');

                return $this->redirectToRoute('film-roll-inventory_edit', array('id' => $filmRoll->getId()));
            } else {
                $this->addFlash('warning', "Film Roll couldn't be updated");
            }
        }

        return $this->render('filmroll/edit.html.twig', array(
            'filmRoll' => $filmRoll,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a FilmRoll entity.
     *
     * @Route("/{id}", name="film-roll_delete")
     * @Route("/inventory/{id}", name="film-roll-inventory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FilmRoll $filmRoll)
    {
        $form = $this->createDeleteForm($filmRoll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($filmRoll);
            $em->flush();
        }

        return $this->redirectToRoute('film-roll_index');
    }

    /**
     * Creates a form to delete a FilmRoll entity.
     *
     * @param FilmRoll $filmRoll The FilmRoll entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FilmRoll $filmRoll)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('film-roll_delete', array('id' => $filmRoll->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
