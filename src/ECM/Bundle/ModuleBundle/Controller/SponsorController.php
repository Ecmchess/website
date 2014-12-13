<?php

namespace ECM\Bundle\ModuleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use ECM\Bundle\ModuleBundle\Entity\Sponsor;
use ECM\Bundle\ModuleBundle\Form\SponsorType;

/**
 * Sponsor controller.
 *
 */
class SponsorController extends Controller
{




    /**
     * Lists all Sponsor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ECMModuleBundle:Sponsor')->findAll();

        return $this->render('ECMModuleBundle:Sponsor:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Sponsor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Sponsor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
//            $entity->upload();
//            $id = $entity->getId();
//            $titre = $entity->getTitre();
//            $urlImage = $entity->getUrlImage();
//            $lien = $entity->getLien();
//            $ordre = $entity->getOrdre();
            $em = $this->getDoctrine()->getManager();
//            $em->getConnection()->executeUpdate('CALL ordre_proc (\''.$titre.'\',\''.$urlImage.'\',\''.$lien.'\',\''.$ordre.'\')');
//            $er = $em->getRepository('ECMModuleBundle:Sponsor');
//            $er->ajouterSponsor($entity);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sponsor'));
        }

        return $this->render('ECMModuleBundle:Sponsor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Sponsor entity.
     *
     * @param Sponsor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sponsor $entity)
    {
        $form = $this->createForm(new SponsorType(), $entity, array(
            'action' => $this->generateUrl('admin_sponsor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sponsor entity.
     *
     */
    public function newAction()
    {
        $entity = new Sponsor();
        $form   = $this->createCreateForm($entity);

        return $this->render('ECMModuleBundle:Sponsor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sponsor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECMModuleBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ECMModuleBundle:Sponsor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    public function showFrontAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sponsors = $em->getRepository('ECMModuleBundle:Sponsor')->findBy(array(), array('ordre' => 'asc'));

        return $this->render('ECMModuleBundle:Sponsor:sponsorsFront.html.twig', array(
            'sponsors'      => $sponsors
        ));
    }

    /**
     * Displays a form to edit an existing Sponsor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECMModuleBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ECMModuleBundle:Sponsor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sponsor entity.
    *
    * @param Sponsor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sponsor $entity)
    {
        $form = $this->createForm(new SponsorType(), $entity, array(
            'action' => $this->generateUrl('admin_sponsor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sponsor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECMModuleBundle:Sponsor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sponsor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
//            $entity->upload();
            $idE = $entity->getId();
            $titre = $entity->getTitre();
            $urlImage = $entity->getUrlImage();
            $lien = $entity->getLien();
            $ordre = $entity->getOrdre();
            $em->getConnection()->executeUpdate('CALL ordre_proc_update (\''.$idE.'\',\''.$titre.'\',\''.$urlImage.'\',\''.$lien.'\',\''.$ordre.'\')');
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('admin_sponsor_edit', array('id' => $id)));
        }

        return $this->render('ECMModuleBundle:Sponsor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Sponsor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ECMModuleBundle:Sponsor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sponsor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_sponsor'));
    }

    /**
     * Creates a form to delete a Sponsor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sponsor_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
