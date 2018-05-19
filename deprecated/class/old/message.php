<?php
/*
 * message.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use //classes\Core,
      //DateTime,
      stdClass,
      Exception;

  /**
   * sprava emailu
   *
   * @package unstable
   * @author geniv
   * @version 1.00
   */
  class Message {
    const VERSION = 1.00;
//TODO hmm omg toto neni na 5 minut!!!
    public function __construct() {}
    public function setFrom($email, $name = NULL) {}
    public function getFrom() {}
    public function addReplyTo($email, $name = NULL) {}
    public function setSubject($subject) {}
    public function getSubject() {}
    public function addTo($email, $name = NULL) {}
    public function addCc($email, $name = NULL) {}
    public function addBcc($email, $name = NULL) {}
    private function formatEmail($email, $name) {}
    public function setReturnPath($email) {}
    public function getReturnPath() {}
    public function setPriority($priority) {}
    public function getPriority() {}
    public function setHtmlBody($html, $basePath = NULL) {}
    public function getHtmlBody() {}
    public function addEmbeddedFile($file, $content = NULL, $contentType = NULL) {}
    public function addAttachment($file, $content = NULL, $contentType = NULL) {}
    private function createAttachment($file, $content, $contentType, $disposition) {}
    //OMG!
    public function send() {}
    public function setMailer(IMailer $mailer) {}
    public function getMailer() {}
    public function generateMessage() {}
    protected function build() {}
    protected function buildHtml() {}
    protected function buildText() {}
    private function getRandomId() {}
  }

  class ExceptionMessage extends Exception {}

?>
