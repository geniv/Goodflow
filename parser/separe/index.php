<?php

    try {
        // header("Content-Type: text/html; charset=UTF-8");

        require('pdohelper.php');

        $db = 'vystup.sqlite3';

        class Databaze extends classes\PDOHelper {};
        $handle = new Databaze($db);
        $db = $handle->SQLite3()->getDatabase();

        $result = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
        <body>

<form method="POST">
        <select name="zarazeni">'.PHP_EOL;

        $st = $db->query('kontakty', 'Zarazeni', null, null, 'Zarazeni', null, 'Zarazeni ASC');
        foreach ($st as $v) {
            $result .= '<option value="'.$v->Zarazeni.'"'.(isset($_POST['zarazeni']) && $_POST['zarazeni'] == $v->Zarazeni ? ' selected' : null).'>'.$v->Zarazeni.'</option>'.PHP_EOL;
        }
        $result .= '</select>
        <input type="submit" value="vyber zarazeni" name="sendZarazeni">
        <input type="submit" value="vyber pro exel" name="sendForExel">
</form>
        ';

        if (isset($_POST['sendZarazeni']) && isset($_POST['zarazeni'])) {
            $table = '<br /><br />tabulka firem:<br /><table border="1">';
            $st = $db->query('kontakty', 'Company, Contact', 'Zarazeni=?', array($_POST['zarazeni']));
            $emails = array();
            foreach ($st as $v) {
                $cont = unserialize($v->Contact);
                if ($cont['Email']) {
                    $emails[] = $cont['Email'];

                    $table .= '
                    <tr>
                        <td>'.($v->Company).'</td>
                        <td>'.($cont['Email']).'</td>
                    </tr>
                    ';
                }
            }

            $table .= '</table>';

            $result .= '<br />vsechny unikatni emaily:<br /><textarea rows="5" cols="140">'.implode(', ', array_unique($emails)).'</textarea>';
            $result .= $table;
        }

        if (isset($_POST['sendForExel'])) {
            $res = 'Company;Email;Zarazeni;Lokalita'.PHP_EOL;
            $st = $db->query('kontakty', 'Company, Contact, Zarazeni, Lokalita');
            foreach ($st as $v) {
                $cont = unserialize($v->Contact);
                if ($cont['Email']) {
                    $res .= ($v->Company).';'.($cont['Email']).';'.($v->Zarazeni).';'.($v->Lokalita).PHP_EOL;
                }
            }
            $result .= '<textarea rows="50" cols="140">'.$res.'</textarea>';
        }

        $result .= '
        </body>
        </html>';

        echo $result;

/*
        $db = 'vystup.sqlite3';
        $pdo = new \PDO('sqlite:'.$db);

        if ($pdo->beginTransaction()) { // zacatek transakce

            $s = 'SELECT FROM kontakty';
            $sth = $pdo->prepare($s);
            if ($sth->execute(array_values($result))) {
                // echo 'pridano id: ' . $pdo->lastInsertId() . ' == '. $id . PHP_EOL;
                $pdo->commit();
            } else {
                $e = $sth->errorInfo(); // nacteni chyby
                die($e[2]);
            }
        }
*/
    } catch (\Exception $e) {
        die($e->getMessage());
    }