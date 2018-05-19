<?php

  header('Content-type: text/html; charset=UTF-8'); //nastaveni hlavicky

  echo "konvertor XML kontakt listu z exportovanyho z resco manager pro evolution mail do formatu VCard<br />\n";
//kurva prace!! na XML seru!!!
class Convert
{
  public function __construct()
  {
    $xml = new SimpleXMLElement("Contacts.xml", NULL, true);
    //var_dump($xml);
    $saveas = "";
    $tel = "";
    $poc = 0;

    foreach ($xml->Contact as $kontakt)
    {
//$type[$poc] = $kontakt["type"];  //pim - telefon, sim - simka
//$type[$poc] = $kontakt["type"];
//$type = explode("|-x-|", implode("|-x-|", $type));
//var_dump($type);
      foreach ($kontakt->prop as $polozka)
      {
        //var_dump($polozka["id"]);
        if ($polozka["id"] == "FILEAS")
        {
          //$poc++;
        }

        switch ($polozka["id"])
        {
          case "DISPLAY_NAME":
            $name[$poc] = $polozka;
            $poc++;
          break;

          case "FILEAS":
            $saveas[$poc] = $polozka;
            //$poc++;
          break;

          case "EMAIL1_ADDRESS":
            $email[$poc] = $polozka;
          break;

          case "WEB_PAGE":
            $web[$poc] = $polozka;
          break;

          case "MOBILE_TELEPHONE_NUMBER":
            $tel_mobile[$poc] = $polozka;
          break;

          case "SMS":
            $tel_sms[$poc] = $polozka;
          break;

          case "HOME_TELEPHONE_NUMBER":
            $tel_home[$poc] = $polozka;
          break;

          case "BUSINESS_TELEPHONE_NUMBER":
            $tel_busi[$poc] = $polozka;
          break;

          case "BIRTHDAY":  //narozeniny
            $naroz[$poc] = $polozka;
          break;

          case "ANNIVERSARY": //svatek
            $svatek[$poc] = $polozka;
          break;
        }
      }
    }

    //rekonvert pole
    $name = explode("|-x-|", implode("|-x-|", $name));
    $saveas = explode("|-x-|", implode("|-x-|", $saveas));
    $email = explode("|-x-|", implode("|-x-|", $email));
    $web = explode("|-x-|", implode("|-x-|", $web));
    $tel_mobile = explode("|-x-|", implode("|-x-|", $tel_mobile));
    $tel_sms = explode("|-x-|", implode("|-x-|", $tel_sms));
    $tel_busi = explode("|-x-|", implode("|-x-|", $tel_busi));
    $naroz = explode("|-x-|", implode("|-x-|", $naroz));
    $svatek = explode("|-x-|", implode("|-x-|", $svatek));

    foreach ($name as $indexjmeno => $jmeno)
    {
      $pole["name"][] = $jmeno;
      $pole["saveas"][] = $saveas[$indexjmeno];
      $pole["email"][] = $email[$indexjmeno];
      $pole["web"][] = $web[$indexjmeno];
      $pole["mobile"][] = $tel_mobile[$indexjmeno];
      $pole["sms"][] = $tel_sms[$indexjmeno];
      $pole["busi"][] = $tel_busi[$indexjmeno];
      $pole["naroz"][] = $naroz[$indexjmeno];
      $pole["svatek"][] = $svatek[$indexjmeno];
    }

var_dump($pole);
    //var_dump(implode("\n", $tel_home));
    //var_dump(implode("\n", $saveas));

  }
}
new Convert();


?>
