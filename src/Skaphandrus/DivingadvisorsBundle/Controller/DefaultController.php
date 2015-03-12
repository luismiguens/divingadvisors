<?php

namespace Skaphandrus\DivingadvisorsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\DivingadvisorsBundle\Entity\Contact;
use Skaphandrus\DivingadvisorsBundle\Form\ContactType;

class DefaultController extends Controller {

    public function playAction() {
        return $this->render('SkaphandrusDivingadvisorsBundle:Default:play.html.twig');
    }

    /**
     * Creates a new Contact entity.
     *
     */
    public function indexAction(Request $request) {
        $entity = new Contact();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);




        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


            $message = \Swift_Message::newInstance()
                    ->setSubject('contact')
                    ->setFrom('contact@divingadvisors.com')
                    ->setTo('contact@divingadvisors.com')
                    ->setBody($entity->getName() . ' from email: ' . $entity->getEmail() . ' said: ' . $entity->getMessage());

            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add('success', 'true');


            // $url = $this->generateUrl("homepage");
//            return $this->render('SkaphandrusDivingadvisorsBundle:Default:index.html.twig', array(
//                        'entity' => $entity,
//                        'form' => $form->createView(),
//                    ));
//            return $this->redirect($this->generateUrl('homepage', array(
//                        'entity' => $entity,
//                        'form' => $form->createView())));


            return $this->redirect($this->generateUrl('homepage') . '#contact');
        }


        return $this->render('SkaphandrusDivingadvisorsBundle:Default:index.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));

//        return $this->render('SkaphandrusDivingadvisorsBundle:Default:index.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                ));
//        return $this->render('SkaphandrusDivingadvisorsBundle:Contact:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//                ));
    }

    /**
     * Creates a form to create a Contact entity.
     *
     * @param Contact $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contact $entity) {
        $form = $this->createForm(new ContactType(), $entity, array(
            'action' => $this->generateUrl('homepage'),
            'method' => 'POST',
                ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

//        public function helloAction($name)
//    {
//        return $this->render('SkaphandrusDivingadvisorsBundle:Default:hello.html.twig', array('name' => $name));
//    }
}
