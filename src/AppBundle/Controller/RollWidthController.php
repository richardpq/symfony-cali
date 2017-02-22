<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\RollWidth;
use AppBundle\Form\RollWidthType;

/**
 * RollWidth controller.
 *
 * @Route("/roll-width")
 */
class RollWidthController extends Controller
{
    /**
     * Lists all RollWidth entities.
     *
     * @Route("/", name="roll-width_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rollWidths = $em->getRepository('AppBundle:RollWidth')->findAll();

        return $this->render('rollwidth/index.html.twig', array(
            'entities' => $rollWidths,
        ));
    }

    /**
     * Creates a new RollWidth entity.
     *
     * @Route("/new", name="roll-width_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rollWidth = new RollWidth();
        $form = $this->createForm('AppBundle\Form\RollWidthType', $rollWidth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rollWidth);
            $em->flush();

            $this->addFlash('success', 'New Roll Width created');

            return $this->redirectToRoute('roll-width_index');
        }

        return $this->render('rollwidth/new.html.twig', array(
            'rollWidth' => $rollWidth,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RollWidth entity.
     *
     * @Route("/{id}/edit", name="roll-width_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RollWidth $rollWidth)
    {
        $editForm = $this->createForm('AppBundle\Form\RollWidthType', $rollWidth);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rollWidth);
                $em->flush();

                $this->addFlash('success', 'Roll Width updated');

                return $this->redirectToRoute('roll-width_edit', array('id' => $rollWidth->getId()));
            } else {
                $this->addFlash('warning', "Rol Width couldn't be updated");
            }
        }

        return $this->render('rollwidth/edit.html.twig', array(
            'rollWidth' => $rollWidth,
            'edit_form' => $editForm->createView(),
        ));
    }
}
