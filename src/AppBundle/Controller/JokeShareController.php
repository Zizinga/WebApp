<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JokeShare;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jokeshare controller.
 *
 * @Route("jokeshare")
 */
class JokeShareController extends Controller
{
    /**
     * Lists all jokeShare entities.
     *
     * @Route("/", name="jokeshare_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jokeShares = $em->getRepository('AppBundle:JokeShare')->findAll();

        return $this->render('jokeshare/index.html.twig', array(
            'jokeShares' => $jokeShares,
        ));
    }

    /**
     * Creates a new jokeShare entity.
     *
     * @Route("/new", name="jokeshare_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jokeShare = new Jokeshare();
        $form = $this->createForm('AppBundle\Form\JokeShareType', $jokeShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jokeShare);
            $em->flush();

            return $this->redirectToRoute('jokeshare_show', array('id' => $jokeShare->getId()));
        }

        return $this->render('jokeshare/new.html.twig', array(
            'jokeShare' => $jokeShare,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jokeShare entity.
     *
     * @Route("/{id}", name="jokeshare_show")
     * @Method("GET")
     */
    public function showAction(JokeShare $jokeShare)
    {
        $deleteForm = $this->createDeleteForm($jokeShare);

        return $this->render('jokeshare/show.html.twig', array(
            'jokeShare' => $jokeShare,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jokeShare entity.
     *
     * @Route("/{id}/edit", name="jokeshare_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JokeShare $jokeShare)
    {
        $deleteForm = $this->createDeleteForm($jokeShare);
        $editForm = $this->createForm('AppBundle\Form\JokeShareType', $jokeShare);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jokeshare_edit', array('id' => $jokeShare->getId()));
        }

        return $this->render('jokeshare/edit.html.twig', array(
            'jokeShare' => $jokeShare,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jokeShare entity.
     *
     * @Route("/{id}", name="jokeshare_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JokeShare $jokeShare)
    {
        $form = $this->createDeleteForm($jokeShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jokeShare);
            $em->flush();
        }

        return $this->redirectToRoute('jokeshare_index');
    }

    /**
     * Creates a form to delete a jokeShare entity.
     *
     * @param JokeShare $jokeShare The jokeShare entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JokeShare $jokeShare)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jokeshare_delete', array('id' => $jokeShare->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
