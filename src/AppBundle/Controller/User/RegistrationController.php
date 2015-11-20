<?php
namespace AppBundle\Controller\User;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

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
                        'AppBundle:Emails:registration.html.twig',
                        array(
                            'username' => $user->getUsername(),
                            'confirmationUrl' => $confURL)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($mail);

            $session = $request->getSession();
            $session->set('redirect', 'register');
            return $this->redirectToRoute('user_registration_checkmail');
        }

        return $this->render('AppBundle:Registration:registration.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function checkMailAction(Request $request)
	{
        $session =  $request->getSession();
        $redirect = $session->get('redirect');
        if(!('register' === $redirect))
        {
            return $this->redirectToRoute('_welcome');
        }
        $session->remove('redirect');
        return $this->render('AppBundle:Registration:checkmail.html.twig');
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

        return $this->render('AppBundle:Registration:confirm.html.twig', 
                [
                    'success' => $success
                ]
            );      

	}

}