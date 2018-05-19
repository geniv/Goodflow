<?php
/*
 * crate.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * prepravka pro instance
 */

    /**
     * prepravka instanci
     *
     * @package unstable
     * @author geniv
     * @version 1.02
     */
    final class Crate extends classes\ObjectArray {

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param array pole vstupni pole
         */
        public function __construct($pole) {
            parent::__construct($pole);

            // kontrola zavislosti
            classes\Core::checkDependency(array(
                    'global_config.php',
                ));

            // nacitani hlavni konfigurace *******************************************
            $this->configure = classes\Configurator::decode('global_config.php');
            $this->crate = $this;

            // nacitani kofigurace z db konfigurace **********************************
            classes\ErrorLoger::setPrintStdOut(!$this->configure['system']['stable']);
            classes\ErrorLoger::setInstantlySend($this->configure['system']['stable']);

            echo '<pre>'.print_r(classes\UserAgentString::getData(), true).'</pre>';
        }
    }