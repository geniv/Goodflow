<?php
/*
 * sitemap.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * generator google sitemaps
     * - dodrzeni: http://www.sitemaps.org/protocol.html
     * - rozsireno o: https://support.google.com/webmasters/answer/183668 (image)
     *
     * @package stable
     * @author geniv
     * @version 1.18
     */
    class Sitemap {
        const XMLNS_SITEMAP = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        const XMLNS_IMAGE = 'http://www.google.com/schemas/sitemap-image/1.1';

        private $xml = null;
        private $image = false; // detekce obrazku
        private $last = null;   // ulozeni posledniho elementu

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param void
         */
        public function __construct() {
            $this->xml = new \SimpleXMLElement('<urlset xmlns="'.self::XMLNS_SITEMAP.'"></urlset>');
        }

        /**
         * pridani odkazu
         * - uklada posledni element, po volani mozno pouzit: addImage()
         *
         * @since 1.02
         * @param string loc Specifies the URL. For images and video, specifies the landing page (aka play page, referrer page). Must be a unique URL.
         * @param int|string lastmod The date the URL was last modifed, in YYYY-MM-DDThh:mmTZD format (time value is optional).
         * @param string changefreq Provides a hint about how frequently the page is likely to change. [always, hourly, daily, weekly, monthly, yearly, never]
         * @param double priority Describes the priority of a URL relative to all the other URLs on the site. This priority can range from 1.0 (extremely important) to 0.1 (not important at all).
         * @return this
         */
        public function addLink($loc, $lastmod = null, $changefreq = null, $priority = null) {
            $url = $this->xml->addChild('url'); // vklada se do url
            $url->addChild('loc', $loc);  // url->loc
            if ($lastmod) {     // pokud je lastmod
                $url->addChild('lastmod', date(\DateTime::W3C, is_int($lastmod) ? $lastmod : strtotime($lastmod)));
            }
            if ($changefreq) {  // pokud je changefreq
                $url->addChild('changefreq', $changefreq);
            }
            if ($priority) {    // pokud je priority
                $url->addChild('priority', $priority);
            }
            $this->last = $url; // ulozeni posledniho elementu
            return $this;
        }

        /**
         * pridani obrazku do posledniho odkazu
         * - max 1000 na odkaz
         * - nemodifikuje last element
         *
         * @since 1.04
         * @param string loc The URL of the image.
         * @param null|string title The title of the image.
         * @param null|string caption The caption of the image.
         * @param null|string geo_location The geographic location of the image. For example, <image:geo_location>Limerick, Ireland</image:geo_location>.
         * @param null|string license A URL to the license of the image.
         * @retrun this
         */
        public function addImage($loc, $title = null, $caption = null, $geo_location = null, $license = null) {
            if ($this->last) {
                $this->image = true;  // nastaveni xmlns
                // pridani image:image do posledniho elementu
                $img = $this->last->addChild('c:image:image');
                $img->addChild('c:image:loc', $loc);  // pridani loc
                if ($title) {         // pokud je title
                    $img->addChild('c:image:title', htmlspecialchars($title));
                }
                if ($caption) {       // pokud je caption
                    $img->addChild('c:image:caption', htmlspecialchars($caption));
                }
                if ($geo_location) {  // pokud je geo_location
                    $img->addChild('c:image:geo_location', htmlspecialchars($geo_location));
                }
                if ($license) {       // pokud je license
                    $img->addChild('c:image:license', htmlspecialchars($license));
                }
            }
            return $this;
        }

        /**
         * renderovani obsahu
         *
         * @since 1.06
         * @param null|string filename cesta na ulozeni pdf
         * @return string vygenerovane xml
         */
        public function render($filename = null) {
            if ($this->image) { // pripojovani atributu pro obrazek
                $this->xml->addAttribute('c:xmlns:image', self::XMLNS_IMAGE);
            }
            return $filename ? $this->xml->asXML($filename) : $this->xml->asXML();
        }
    }