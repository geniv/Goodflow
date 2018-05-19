<?php

/**
 * Common code for NMail test cases.
 */



// Setup environment
NMail::$defaultMailer = 'TestMailer';


class TestMailer implements IMailer
{
	public static $output;

	function send(NMail $mail)
	{
		self::$output = $mail->generateMessage();
	}

}
