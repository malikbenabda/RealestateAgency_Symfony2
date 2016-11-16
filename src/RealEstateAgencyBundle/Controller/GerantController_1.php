<?php

namespace Esprit\RealEstateAgencyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Esprit\RealEstateAgencyBundle\Entity\Gerant;
use Esprit\RealEstateAgencyBundle\Form\GerantType;

/**
 * Gerant controller.
 *
 * @Route("/gerant")
 */
class GerantController extends Controller
{

    /**
     * Lists all Gerant entities.
     *
     * @Route("/", name="gerant")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EspritRealEstateAgencyBundle:Gerant')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Gerant entity.
     *
     * @Route("/", name="gerant_create")
     * @Method("POST")
     * @Template("EspritRealEstateAgencyBundle:Gerant:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Gerant();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gerant_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Gerant entity.
    *
    * @param Gerant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Gerant $entity)
    {
        $form = $this->createForm(new GerantType(), $entity, array(
            'action' => $this->generateUrl('gerant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gerant entity.
     *
     * @Route("/new", name="gerant_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Gerant();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Gerant entity.
     *
     * @Route("/{id}", name="gerant_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EspritRealEstateAgencyBundle:Gerant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gerant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Gerant entity.
     *
     * @Route("/{id}/edit", name="gerant_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EspritRealEstateAgencyBundle:Gerant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gerant entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Gerant entity.
    *
    * @param Gerant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gerant $entity)
    {
        $form = $this->createForm(new GerantType(), $entity, array(
            'action' => $this->generateUrl('gerant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Gerant entity.
     *
     * @Route("/{id}", name="gerant_update")
     * @Method("PUT")
     * @Template("EspritRealEstateAgencyBundle:Gerant:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EspritRealEstateAgencyBundle:Gerant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gerant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('gerant_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Gerant entity.
     *
     * @Route("/{id}", name="gerant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EspritRealEstateAgencyBundle:Gerant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gerant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gerant'));
    }

    /**
     * Creates a form to delete a Gerant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gerant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
