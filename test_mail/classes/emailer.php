<?php
/*
 * emailer.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida pro jednoduche a elegantni posilani emailu
   *
   * @package stable
   * @author geniv
   * @version 4.12
   */
  class Emailer {
    /** typ html stranka */
    const HTML = 'text/html';
    /** typ obycejny text */
    const PLAIN = 'text/plain';

    private $from = null;  // od
    private $reply = array(); // odpovedet komu
    private $cc = array();  // kopie
    private $bcc = array(); // skryta kopie
    private $to = array();  // komu

    //~ private $priority = 3;  // (1 = High, 3 = Normal, 5 = low)
    //~ private $encoding = '8bit'; // "8bit", "7bit", "binary", "base64", and "quoted-printable".

    private $subject = null;
    private $message = null;

    private $content = self::PLAIN;  // defaultni typ
    private $charset = 'UTF-8'; // kodovani

    /**
     * konstruktor tridy
     *
     * @since 3.00
     * @param string content typu obsahu
     * @param string charset typ kodovani
     */
    public function __construct($content = self::PLAIN, $charset = 'UTF-8') {
      $this->content = $content;
      $this->charset = $charset;
    }

    //~ /**
     //~ * nastaveni priority
     //~ *
     //~ * @since 1.58
     //~ * @param priority cislo priority zpravy
     //~ * @return this
     //~ */
    //~ public function setPriority($priority) {
      //~ $this->priority = $priority;
      //~ return $this;
    //~ }

    //~ /**
     //~ * nastaveni enkodovani
     //~ *
     //~ * @since 1.60
     //~ * @param encoding typ enkodovani
     //~ * @return this
     //~ */
    //~ public function setEncoding($encoding) {
      //~ $this->encoding = $encoding;
      //~ return $this;
    //~ }

    /**
     * formatuje koncovou emailovou adresu se jmenem
     * finalni format: "foo bar" <foo.bar@email.com>
     *
     * @since 3.78
     * @param string email konkterni email, predpokladem je samosebou validni email
     * @param string name jmeno pro ktere email nalezi, nepovinny
     * @return string preformatovany tvar emailu
     */
    private function getFromatedEmail($email, $name = null) {
      return '"' . ($name ?: $email) . '" <' . $email . '>';
    }

    /**
     * nacteni odesilatele
     *
     * @since 3.96
     * @return string email odesilatele
     */
    public function getFrom() {
      return $this->from;
    }

    /**
     * nastaveni od koho, odesilatel, pouze jeden email!!
     *
     * @since 3.40
     * @param string email odesilatel
     * @param string name jmeno odesilatele, nepovinne
     * @return this
     */
    public function setFrom($email, $name = null) {
      if (Core::isEmail($email)) {
        $this->from = $this->getFromatedEmail($email, $name);
      }
      return $this;
    }

    /**
     * pridani komu odpovedet, mozno nekolik emailu
     *
     * @since 3.40
     * @param string email adresa pro odpoved na email
     * @param string name jmeno odesilatele, nepovinne
     * @return this
     */
    public function addReplyTo($email, $name = null) {
      if (Core::isEmail($email)) {
        $this->reply[] = $this->getFromatedEmail($email, $name);
      }
      return $this;
    }

    /**
     * nacteni pole emailu na odpoved
     *
     * @since 3.98
     * @return array pole emailu pro odpoved
     */
    public function getReplyTo() {
      return $this->reply;
    }

    /**
     * pridani kopie, mozno nekolik emailu
     *
     * @since 3.48
     * @param string email adresa pro kopie emailu
     * @param string name jmeno odesilatele, nepovinne
     * @return this
     */
    public function addCc($email, $name = null) {
      if (Core::isEmail($email)) {
        $this->cc[] = $this->getFromatedEmail($email, $name);
      }
      return $this;
    }

    /**
     * nacteni pole emailu kopii
     *
     * @since 4.00
     * @return array pole emailu kopii
     */
    public function getCc() {
      return $this->cc;
    }

    /**
     * pridani skryta kopie, mozno nekolik emailu
     *
     * @since 3.48
     * @param string email adresa pro skrytou kopii
     * @param string name jmeno odesilatele, nepovinne
     * @return this
     */
    public function addBcc($email, $name = null) {
      if (Core::isEmail($email)) {
        $this->bcc[] = $this->getFromatedEmail($email, $name);
      }
      return $this;
    }

    /**
     * nacteni pole emailu skrytych kopii
     *
     * @since 4.02
     * @return array pole emailu kopii
     */
    public function getBcc() {
      return $this->bcc;
    }

    /**
     * pridani komu, prijemce, mozno nekolik emailu
     *
     * @since 3.48
     * @param string email adresa pro prijemce
     * @param string name jmeno odesilatele, nepovinne
     * @return this
     */
    public function addTo($email, $name = null) {
      if (Core::isEmail($email)) {
        $this->to[] = $this->getFromatedEmail($email, $name);
      }
      return $this;
    }

    /**
     * nacteni pole emailu prijemce
     *
     * @since 4.04
     * @return array pole emailu prijemce
     */
    public function getTo() {
      return $this->to;
    }

    /**
     * nacteni predmetu emailu
     *
     * @since 4.06
     * @return string text predmetu
     */
    public function getSubject() {
      return $this->subject;
    }

    /**
     * nastaveni predmet emailu, pouze jeden
     *
     * @since 3.50
     * @param string subject text predmetu
     * @return this
     */
    public function setSubject($subject) {
      $this->subject = $subject;
      return $this;
    }

    /**
     * nacteni textu zpravy
     *
     * @since 4.08
     * @return text zpravy emailu
     */
    public function getMessage() {
      return $this->message;
    }

    /**
     * nastaveni zprava emailu
     * pouze jedeno volani
     *
     * @since 3.58
     * @param string message text zpravy
     * @param bool raw pouzit surove data, defaultne vypnuto
     * @return this
     */
    public function setMessage($message, $raw = false) {
      $this->message = ($raw ? $message : htmlspecialchars($message, ENT_NOQUOTES));
      return $this;
    }

    /**
     * nastaveni zpravy emailu
     * - pouze jedno volani!
     *
     * @since 4.10
     * @param string
     * @return this
     */
    public function setMessageArgs($message) {
      $array = func_get_args();
      $this->message = vsprintf($message, array_slice($array, 1));
      return $this;
    }

    /**
     * overeni odesilani emailu
     *
     * @since 3.24
     * @return bool bylo uspesne odeslano?
     */
    public function send() {
      $headers = array(
          'MIME-Version: 1.0',
          'X-Mailer: PHP-' . phpversion(),
          'Date: ' . date('r'),
          'Content-type: ' . $this->content . '; charset=' . $this->charset,
          //~ 'Content-Transfer-Encoding: ' . $this->encoding,
          //~ 'X-Priority: '. $this->priority,
      );

      // pridavani from (od koho)
      if (!empty($this->from)) {
        $headers[] = 'From: ' . $this->from;
      }

      // pridavani odpovedek komu
      if (!empty($this->reply)) {
        $headers[] = 'Reply-To: ' . implode(', ', $this->reply);
      }

      // pridavani kopie
      if (!empty($this->cc)) {
        $headers[] = 'Cc: ' . implode(', ', $this->cc);
      }

      // pridavani skryte kopie
      if (!empty($this->bcc)) {
        $headers[] = 'Bcc: ' . implode(', ', $this->bcc);
      }

      //slozeni finalni hlavicky
      $headers = implode("\r\n", $headers);

      return mail(implode(', ', $this->to), $this->subject, $this->message, $headers);
    }
  }