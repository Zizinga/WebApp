<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JokeComment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jokecomment controller.
 *
 * @Route("jokecomment")
 */
class JokeCommentController extends Controller
{
    /**
     * Lists all jokeComment entities.
     *
     * @Route("/", name="jokecomment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jokeComments = $em->getRepository('AppBundle:JokeComment')->findAll();

        return $this->render('jokecomment/index.html.twig', array(
            'jokeComments' => $jokeComments,
        ));
    }

    /**
     * Creates a new jokeComment entity.
     *
     * @Route("/new", name="jokecomment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jokeComment = new Jokecomment();
        $form = $this->createForm('AppBundle\Form\JokeCommentType', $jokeComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jokeComment);
            $em->flush();

            return $this->redirectToRoute('jokecomment_show', array('id' => $jokeComment->getId()));
        }

        return $this->render('jokecomment/new.html.twig', array(
            'jokeComment' => $jokeComment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jokeComment entity.
     *
     * @Route("/{id}", name="jokecomment_show")
     * @Method("GET")
     */
    public function showAction(JokeComment $jokeComment)
    {
        $deleteForm = $this->createDeleteForm($jokeComment);

        return $this->render('jokecomment/show.html.twig', array(
            'jokeComment' => $jokeComment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jokeComment entity.
     *
     * @Route("/{id}/edit", name="jokecomment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JokeComment $jokeComment)
    {
        $deleteForm = $this->createDeleteForm($jokeComment);
        $editForm = $this->createForm('AppBundle\Form\JokeCommentType', $jokeComment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jokecomment_edit', array('id' => $jokeComment->getId()));
        }

        return $this->render('jokecomment/edit.html.twig', array(
            'jokeComment' => $jokeComment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jokeComment entity.
     *
     * @Route("/{id}", name="jokecomment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JokeComment $jokeComment)
    {
        $form = $this->createDeleteForm($jokeComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jokeComment);
            $em->flush();
        }

        return $this->redirectToRoute('jokecomment_index');
    }

    /**
     * Creates a form to delete a jokeComment entity.
     *
     * @param JokeComment $jokeComment The jokeComment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JokeComment $jokeComment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jokecomment_delete', array('id' => $jokeComment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
