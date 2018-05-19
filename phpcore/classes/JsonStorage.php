<?php
/*
 * JsonStorage.php
 *
 * Copyright 2014 geniv <geniv.radek@gmail.com>
 *
 */

	namespace classes;

    /**
     * rozhranni pro impelmentaci potrebych metod
     *
     * @package stable
     * @author geniv
     * @version 1.04
     */
    interface IJsonStorage {

        /**
         * staticke nacitani dat, explicitni prekryti
         *
         * @since 1.02
         * @param string $name path json souboru
         * @param bool $raw true pro vraceni surovych hodnot
         * @return mixed nactene data
         */
        public static function loadData($name, $raw);
    }

	/**
	 * trida na praci s json ulozistem
	 *
	 * @package stable
	 * @author geniv
	 * @version 1.12
	 */
	abstract class JsonStorage implements IJsonStorage {

		// konstanta s jmenem pripony
        const EXTENSION = '.json';

        // cela cesta k jsonu
        protected $jsonPath = null;

        /**
         * defaultni konstruktor
         *
         * @version 1.02
         * @param string $jsonPath path a nazev databaze bez koncovky
         */
        public function __construct($jsonPath) {
            $this->jsonPath = $jsonPath . self::EXTENSION;
        }

        /**
         * vytvareni souboru
         *
         * @version 1.04
         * @param  array $data vstupni pole
         * @return int kolik bylo zapsano
         */
        public function create($data) {
            if (!file_exists($this->jsonPath)) {
                return $this->save($data);
            }
            return 0;
        }

        /**
         * pridavani zaznamu, pro prekryti
         *
         * @since 1.08
         * @param array $values pole hodnot pro pridani do souboru na konec
         * @return int kolik bylo zapsano
         */
        public function append($values) {}

        /**
         * odstranovani zaznamu, pro prepkryti
         *
         * @since 1.08
         * @param int $id unikatni cislo radku
         * @return int kolik bylo zapsano
         */
        public function remove($id) {}

        /**
         * ukladani do souboru, neustale prepisovani
         *
         * @version 1.04
         * @param  array $data vstupni pole
         * @return int kolik bylo zapsano
         */
        public function save($data) {
            return file_put_contents($this->jsonPath, json_encode($data), LOCK_EX);
        }

        /**
         * nacitani obsahu json souboru, nazev je explicitni
         *
         * @since 1.08
         * @param string $name cesta json souboru
         * @param bool $raw true pro surove data primo ze souboru
         * @param callback $callback callback funkce pro vraceni raw=false, $callback($json)
         * @param mixed $return hodnota ktera se ma vracet pri neexistenci souboru, implicitne je null
         * @return mixed pri uspechu vraci pole nebo hodnotu $return pri neuspechu
         */
        protected static function loadFile($name, $raw, $callback, $return = null) {
        	$p = pathinfo($name, PATHINFO_EXTENSION);
            $name = ($p ? $name : $name . self::EXTENSION); // pokud neni json prida koncovku
            if (file_exists($name)) {
                $json = json_decode(file_get_contents($name), true);
                return ($raw ? $json : $callback($json));
            }
            return $return;
        }

        /**
         * nacitani dat instancne, nazev implicitne
         *
         * @version 1.06
         * @param void
         * @return array nactene data
         */
        public function load($raw = true) {
            return static::loadData($this->jsonPath, $raw);	// volani loadu z potomka
        }
	}