<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JokeLike;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jokelike controller.
 *
 * @Route("jokelike")
 */
class JokeLikeController extends Controller
{
    /**
     * Lists all jokeLike entities.
     *
     * @Route("/", name="jokelike_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jokeLikes = $em->getRepository('AppBundle:JokeLike')->findAll();

        return $this->render('jokelike/index.html.twig', array(
            'jokeLikes' => $jokeLikes,
        ));
    }

    /**
     * Creates a new jokeLike entity.
     *
     * @Route("/new", name="jokelike_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jokeLike = new Jokelike();
        $form = $this->createForm('AppBundle\Form\JokeLikeType', $jokeLike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jokeLike);
            $em->flush();

            return $this->redirectToRoute('jokelike_show', array('id' => $jokeLike->getId()));
        }

        return $this->render('jokelike/new.html.twig', array(
            'jokeLike' => $jokeLike,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jokeLike entity.
     *
     * @Route("/{id}", name="jokelike_show")
     * @Method("GET")
     */
    public function showAction(JokeLike $jokeLike)
    {
        $deleteForm = $this->createDeleteForm($jokeLike);

        return $this->render('jokelike/show.html.twig', array(
            'jokeLike' => $jokeLike,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jokeLike entity.
     *
     * @Route("/{id}/edit", name="jokelike_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JokeLike $jokeLike)
    {
        $deleteForm = $this->createDeleteForm($jokeLike);
        $editForm = $this->createForm('AppBundle\Form\JokeLikeType', $jokeLike);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jokelike_edit', array('id' => $jokeLike->getId()));
        }

        return $this->render('jokelike/edit.html.twig', array(
            'jokeLike' => $jokeLike,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jokeLike entity.
     *
     * @Route("/{id}", name="jokelike_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JokeLike $jokeLike)
    {
        $form = $this->createDeleteForm($jokeLike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jokeLike);
            $em->flush();
        }

        return $this->redirectToRoute('jokelike_index');
    }

    /**
     * Creates a form to delete a jokeLike entity.
     *
     * @param JokeLike $jokeLike The jokeLike entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JokeLike $jokeLike)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jokelike_delete', array('id' => $jokeLike->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
