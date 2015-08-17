<?php

namespace parrainnage\parrainnageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use parrainnage\parrainnageBundle\Entity\Cadeau;
use parrainnage\parrainnageBundle\Form\CadeauType;

/**
 * Cadeau controller.
 *
 */
class CadeauController extends Controller
{

    /**
     * Lists all Cadeau entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('parrainnageBundle:Cadeau')->findAll();

        return $this->render('parrainnageBundle:Cadeau:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cadeau entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cadeau();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cadeau_show', array('id' => $entity->getId())));
        }

        return $this->render('parrainnageBundle:Cadeau:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Cadeau entity.
    *
    * @param Cadeau $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Cadeau $entity)
    {
        $form = $this->createForm(new CadeauType(), $entity, array(
            'action' => $this->generateUrl('cadeau_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cadeau entity.
     *
     */
    public function newAction()
    {
        $entity = new Cadeau();
        $form   = $this->createCreateForm($entity);

        return $this->render('parrainnageBundle:Cadeau:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cadeau entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('parrainnageBundle:Cadeau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cadeau entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('parrainnageBundle:Cadeau:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Cadeau entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('parrainnageBundle:Cadeau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cadeau entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('parrainnageBundle:Cadeau:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cadeau entity.
    *
    * @param Cadeau $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cadeau $entity)
    {
        $form = $this->createForm(new CadeauType(), $entity, array(
            'action' => $this->generateUrl('cadeau_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cadeau entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('parrainnageBundle:Cadeau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cadeau entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cadeau_edit', array('id' => $id)));
        }

        return $this->render('parrainnageBundle:Cadeau:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cadeau entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('parrainnageBundle:Cadeau')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cadeau entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cadeau'));
    }

    /**
     * Creates a form to delete a Cadeau entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cadeau_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
