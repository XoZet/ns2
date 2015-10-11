<?php
namespace AppBundle\Controller\User;


use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\User\UserBaseController as BaseController;
use AppBundle\Form\Type\RegistrationFormType as RegistrationFormType;

/**
* 
*/
class RegistrationController extends BaseController
{
	
	public function registerAction(Request $request)
	{
		$form = $this->createForm(new RegistrationFormType());

        $form->handleRequest($request);
        
        $user = $form->getData();

        if($form->isSubmitted() && $form->isValid()){
            $this->getUserManager()->registerNewUser($user);
            $confToken = $user->getConfirmationToken();
            $subject = $this->get('translator')->trans('registration.email.subject', array('%username%' => $user->getUsername()), 'User');
            $confURL = $this->generateUrl('user_registration_confirm', array(
                'username' => $user->getUsername(),
                 'token' => $user->getConfirmationToken() 
                ), true);
            $sender = $this->container->getParameter('mailer_sender');
            $mail = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom([$sender])
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'AppBundle:emails:registration.html.twig',
                        array(
                            'username' => $user->getUsername(),
                            'confirmationUrl' => $confURL)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($mail);
            return $this->redirect('user_registration_checkmail');
        }

        return $this->render('AppBundle:registration:registration.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function checkMailAction()
	{
        return $this->render('AppBundle:registration:checkmail.html.twig');
	}

	public function checkTokenAction($username, $token)
	{
        $um = $this->getUserManager();
        $translator = $this->get('translator');

        $success = true;

        try{
            $user = $um->loadUserByUsername($username);
            if(!($token === $user->getConfirmationToken()))
            {
                $success = false;
            } else {
                $user->setEnabled(true);
                $um->updateUser($user);
                $success = true;
            }

        } catch (Exception $e) {
            $success = false;
        }

        return $this->render('AppBundle:registration:confirm.html.twig', 
                [
                    'success' => $success
                ]
            );      

	}

	public function enabledAction()
	{

	}

}