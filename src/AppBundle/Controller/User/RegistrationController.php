<?php
namespace AppBundle\Controller\User;

use AppBundle\Controller\User\UserBaseController as BaseController;
use AppBundle\Form\Type\RegistrationFormType as RegistrationFormType;

/**
* 
*/
class RegistrationController extends BaseController
{
	
	public function registerAction()
	{
		$form = $this->createForm(new RegistrationFormType());
        $formHandler = $this->container->get('fos_user.registration.form.handler');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
	}

	public function checkMailAction()
	{

	}

	public function checkTokenAction($token)
	{

	}

	public function enabledAction()
	{

	}

}