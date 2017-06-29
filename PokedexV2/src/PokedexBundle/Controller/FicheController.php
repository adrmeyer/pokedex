<?php

namespace PokedexBundle\Controller;

use PokedexBundle\Entity\Fiche;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fiche controller.
 *
 * @Route("fiche")
 */
class FicheController extends Controller
{
    /**
     * Lists all fiche entities.
     *
     * @Route("/", name="fiche_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fiches = $em->getRepository('PokedexBundle:Fiche')->getFiches();

        return $this->render('fiche/index.html.twig', array(
            'fiches' => $fiches,
        ));
    }

    /**
     * Creates a new fiche entity.
     *
     * @Route("/new", name="fiche_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MODERATEUR')")
     */
    public function newAction(Request $request)
    {
        $fiche = new Fiche();
        $form = $this->createForm('PokedexBundle\Form\FicheType', $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiche);
            $em->flush();

            return $this->redirectToRoute('fiche_show', array('id' => $fiche->getId()));
        }

        return $this->render('fiche/new.html.twig', array(
            'fiche' => $fiche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fiche entity.
     *
     * @Route("/{id}", name="fiche_show", requirements={})
     * @Method("GET")
     * @Template("fiche/show.html.twig")
     */
    public function showAction(Fiche $fiche)
    {
        $deleteForm = $this->createDeleteForm($fiche);

        return array(
            'fiche' => $fiche,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing fiche entity.
     *
     * @Route("/{id}/edit", name="fiche_edit", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MODERATEUR')")
     */
    public function editAction(Request $request, Fiche $fiche)
    {
        $deleteForm = $this->createDeleteForm($fiche);
        $editForm = $this->createForm('PokedexBundle\Form\FicheType', $fiche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_edit', array('id' => $fiche->getId()));
        }

        return $this->render('fiche/edit.html.twig', array(
            'fiche' => $fiche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fiche entity.
     *
     * @Route("/{id}", name="fiche_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_MODERATEUR')")
     */
    public function deleteAction(Request $request, Fiche $fiche)
    {
        $form = $this->createDeleteForm($fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fiche);
            $em->flush();
        }

        return $this->redirectToRoute('fiche_index');
    }

    /**
     * Creates a form to delete a fiche entity.
     *
     * @param Fiche $fiche The fiche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fiche $fiche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fiche_delete', array('id' => $fiche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
