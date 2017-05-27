<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReportedJoke;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reportedjoke controller.
 *
 * @Route("reportedjoke")
 */
class ReportedJokeController extends Controller
{
    /**
     * Lists all reportedJoke entities.
     *
     * @Route("/", name="reportedjoke_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reportedJokes = $em->getRepository('AppBundle:ReportedJoke')->findAll();

        return $this->render('reportedjoke/index.html.twig', array(
            'reportedJokes' => $reportedJokes,
        ));
    }

    /**
     * Creates a new reportedJoke entity.
     *
     * @Route("/new", name="reportedjoke_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reportedJoke = new Reportedjoke();
        $form = $this->createForm('AppBundle\Form\ReportedJokeType', $reportedJoke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reportedJoke);
            $em->flush();

            return $this->redirectToRoute('reportedjoke_show', array('id' => $reportedJoke->getId()));
        }

        return $this->render('reportedjoke/new.html.twig', array(
            'reportedJoke' => $reportedJoke,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reportedJoke entity.
     *
     * @Route("/{id}", name="reportedjoke_show")
     * @Method("GET")
     */
    public function showAction(ReportedJoke $reportedJoke)
    {
        $deleteForm = $this->createDeleteForm($reportedJoke);

        return $this->render('reportedjoke/show.html.twig', array(
            'reportedJoke' => $reportedJoke,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reportedJoke entity.
     *
     * @Route("/{id}/edit", name="reportedjoke_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReportedJoke $reportedJoke)
    {
        $deleteForm = $this->createDeleteForm($reportedJoke);
        $editForm = $this->createForm('AppBundle\Form\ReportedJokeType', $reportedJoke);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reportedjoke_edit', array('id' => $reportedJoke->getId()));
        }

        return $this->render('reportedjoke/edit.html.twig', array(
            'reportedJoke' => $reportedJoke,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reportedJoke entity.
     *
     * @Route("/{id}", name="reportedjoke_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReportedJoke $reportedJoke)
    {
        $form = $this->createDeleteForm($reportedJoke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reportedJoke);
            $em->flush();
        }

        return $this->redirectToRoute('reportedjoke_index');
    }

    /**
     * Creates a form to delete a reportedJoke entity.
     *
     * @param ReportedJoke $reportedJoke The reportedJoke entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReportedJoke $reportedJoke)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reportedjoke_delete', array('id' => $reportedJoke->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
