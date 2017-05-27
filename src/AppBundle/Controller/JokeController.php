<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joke;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Joke controller.
 */
class JokeController extends Controller
{
    /**
     * Lists all joke entities.
     *
     * @Route("/jokes", name="joke_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Sort Entries by ID in descending order
        $jokes = $em->getRepository('AppBundle:Joke')->findBy(array(), array( 'id' => 'DESC' ));

        return $this->render('joke/index.html.twig', array(
            'jokes' => $jokes,
        ));
    }

    /**
     * Creates a new joke entity.
     *
     * @Route("/jokes/new", name="joke_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if
        (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        $joke = new Joke();
        $joke->setDate(new \DateTime('now'));
        $joke->setStatus(true);
        $joke->setAuthor($user);
        $form = $this->createForm('AppBundle\Form\JokeType', $joke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($joke);
            $em->flush();

            return $this->redirectToRoute('joke_index');
        }

        return $this->render('joke/new.html.twig', array(
            'joke' => $joke,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a joke entity.
     *
     * @Route("/jokes/show/{id}", name="joke_show")
     * @Method("GET")
     */
    public function showAction(Joke $joke)
    {
        $deleteForm = $this->createDeleteForm($joke);

        return $this->render('joke/show.html.twig', array(
            'joke' => $joke,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing joke entity.
     *
     * @Route("/jokes/{id}/edit", name="joke_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Joke $joke)
    {
        $deleteForm = $this->createDeleteForm($joke);
        $editForm = $this->createForm('AppBundle\Form\JokeType', $joke);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('joke_edit', array('id' => $joke->getId()));
        }

        return $this->render('joke/edit.html.twig', array(
            'joke' => $joke,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a joke entity.
     *
     * @Route("/{id}", name="joke_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Joke $joke)
    {
        $form = $this->createDeleteForm($joke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($joke);
            $em->flush();
        }

        return $this->redirectToRoute('joke_index');
    }

    /**
     * Creates a form to delete a joke entity.
     *
     * @param Joke $joke The joke entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Joke $joke)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('joke_delete', array('id' => $joke->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
