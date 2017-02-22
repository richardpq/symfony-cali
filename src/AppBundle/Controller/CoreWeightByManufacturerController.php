<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\CoreWeightByManufacturer;
use AppBundle\Form\CoreWeightByManufacturerType;

/**
 * CoreWeightByManufacturer controller.
 *
 * @Route("/core-weight-manufacturer")
 */
class CoreWeightByManufacturerController extends Controller
{
    /**
     * Lists all CoreWeightByManufacturer entities.
     *
     * @Route("/", name="core-weight-manufacturer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coreWeightByManufacturers = $em->getRepository('AppBundle:CoreWeightByManufacturer')->findBy(
            [],
            ['manufacturer' => 'ASC', 'rollWidth' => 'ASC']
        );

        return $this->render('coreweightbymanufacturer/index.html.twig', array(
            'entities' => $coreWeightByManufacturers,
        ));
    }

    /**
     * Creates a new CoreWeightByManufacturer entity.
     *
     * @Route("/new", name="core-weight-manufacturer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $coreWeightByManufacturer = new CoreWeightByManufacturer();
        $form = $this->createForm('AppBundle\Form\CoreWeightByManufacturerType', $coreWeightByManufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coreWeightByManufacturer);
            $em->flush();

            $this->addFlash('success', 'New Core Weight created');

            return $this->redirectToRoute('core-weight-manufacturer_index');
        }

        return $this->render('coreweightbymanufacturer/new.html.twig', array(
            'coreWeightByManufacturer' => $coreWeightByManufacturer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CoreWeightByManufacturer entity.
     *
     * @Route("/{id}/edit", name="core-weight-manufacturer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CoreWeightByManufacturer $coreWeightByManufacturer)
    {
        $editForm = $this->createForm('AppBundle\Form\CoreWeightByManufacturerType', $coreWeightByManufacturer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($coreWeightByManufacturer);
                $em->flush();

                $this->addFlash('success', "Core Weight updated");

                return $this->redirectToRoute(
                    'core-weight-manufacturer_edit',
                    ['id' => $coreWeightByManufacturer->getId()]
                );
            } else {
                $this->addFlash('warning', "Core Weight couldn't be updated");
            }
        }

        return $this->render('coreweightbymanufacturer/edit.html.twig', array(
            'coreWeightByManufacturer' => $coreWeightByManufacturer,
            'edit_form' => $editForm->createView(),
        ));
    }
}
