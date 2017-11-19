<?php

namespace AdminBundle\Controller;

use CoreBundle\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Property controller.
 *
 * @Route("property")
 */
class PropertyController extends Controller
{
    /**
     * Lists all property entities.
     *
     * @Route("/", name="property_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $properties = $em->getRepository('CoreBundle:Property')->findAll();

        return $this->render('@Admin/property/index.html.twig', array(
            'properties' => $properties,
        ));
    }

    /**
     * Creates a new property entity.
     *
     * @Route("/new", name="property_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $property = new Property();
        $form = $this->createForm('CoreBundle\Form\PropertyType', $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush($property);

            return $this->redirectToRoute('property_show', array('id' => $property->getId()));
        }

        return $this->render('@Admin/property/new.html.twig', array(
            'property' => $property,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a property entity.
     *
     * @Route("/{id}", name="property_show")
     * @Method("GET")
     */
    public function showAction(Property $property)
    {
        $deleteForm = $this->createDeleteForm($property);

        return $this->render('@Admin/property/show.html.twig', array(
            'property' => $property,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing property entity.
     *
     * @Route("/{id}/edit", name="property_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Property $property)
    {
        $deleteForm = $this->createDeleteForm($property);
        $editForm = $this->createForm('CoreBundle\Form\PropertyType', $property);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('property_edit', array('id' => $property->getId()));
        }

        return $this->render('@Admin/property/edit.html.twig', array(
            'property' => $property,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a property entity.
     *
     * @Route("/{id}", name="property_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Property $property)
    {
        $form = $this->createDeleteForm($property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($property);
            $em->flush($property);
        }

        return $this->redirectToRoute('property_index');
    }

    /**
     * Creates a form to delete a property entity.
     *
     * @param Property $property The property entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Property $property)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('property_delete', array('id' => $property->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
