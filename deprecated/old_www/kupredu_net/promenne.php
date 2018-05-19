<?php
class Promenne
{
  public $kam;  //globalni kam
  public $main; //trida funkce
  public $meta; //meta presmerovani
  public $chyba;  //globalni hlaska chyby
  public $default = "uvod"; //defaultni stranka
  public $temp = "/kupredu_net";  //temp tro lokal, na serveru prazdne!!  /kupredu_net
  public $hlavicky = "Content-type: text/html; charset=UTF-8";
  public $email = "info@kupredu.net"; //konecny email
  public $namesqlite = ".kupredu_net.sqlite";
  public $sqlite; //objektovy ukazetel na sqlite
  public $web;  //promenna cesty webu
  public $pocnovinek = 10; //pocet novinek
}
?>
