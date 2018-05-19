<?php

/**
 *
 * Blok Flash headeru
 *
 * public funkce:\n
 * construct: FlashHeader - hlavni konstruktor tridy\n
 * Flash() - hlavni vypis flashu\n
 *
 */

class FlashHeader
{
  private $var;
  private $flash = "header.swf";

/**
 *
 * Konstruktor flashu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
  }

/**
 *
 * Staticky flash header
 *
 * @return flash header
 */
  public function Flash()
  {
    $web = $_SERVER["SERVER_NAME"];

    $result =
    "<div id=\"header_flash\">
            <object type=\"application/x-shockwave-flash\" data=\"http://{$web}/{$this->flash}\" width=\"767\" height=\"153\">
            <!-- <![endif]-->
            <!--[if IE]>
            <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"767\" height=\"153\">
              <param name=\"movie\" value=\"http://{$web}/{$this->flash}\" />
            <!--><!---->
              <param name=\"loop\" value=\"true\" />
              <param name=\"menu\" value=\"false\" />
              <param name=\"bgcolor\" value=\"#2e2e2e\" />
              <param name=\"quality\" value=\"medium\" />
              <param name=\"scale\" value=\"exactfit\" />
              <param name=\"wmode\" value=\"transparent\" />
              <!-- <p>nahrada za flash</p> -->
            </object>
          </div>";
        
      return $result;
    }
}
?>
