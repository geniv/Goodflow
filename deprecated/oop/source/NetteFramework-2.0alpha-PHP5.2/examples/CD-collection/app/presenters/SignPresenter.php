<?php



class SignPresenter extends BasePresenter
{
	/** @persistent */
	public $backlink = '';



	public function startup()
	{
		parent::startup();
		$this->session->start(); // required by $form->addProtection()
	}



	/********************* component factories *********************/



	/**
	 * Sign in form component factory.
	 * @return NAppForm
	 */
	protected function createComponentSignInForm()
	{
		$form = new NAppForm;
		$form->addText('username', 'Username:')
			->setRequired('Please provide a username.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please provide a password.');

		$form->addSubmit('send', 'Sign in');

		$form->onSubmit[] = callback($this, 'signInFormSubmitted');
		return $form;
	}



	public function signInFormSubmitted($form)
	{
		try {
			$values = $form->getValues();
			$this->user->login($values->username, $values->password);
			$this->application->restoreRequest($this->backlink);
			$this->redirect('Dashboard:');

		} catch (NAuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}



	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
