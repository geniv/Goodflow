<?php

// var_dump($_SERVER);
// var_dump(php_sapi_name(), PHP_SAPI, PHP_OS);
// var_dump($argv);

function getArguments($args) {
    return ($args);
}

if ($argv && PHP_SAPI == 'cli' && PHP_OS == 'Linux') {
    // pokud je posteno v cli
    $args = getArguments($argv);
    $rev = $args[1];
    $repo = $args[2];

    // nazev projektu skupina/projekt
    $proj = implode('/', array_slice(explode('/', $repo), -2));

    // dotaz na svn
    exec('svn log --xml --verbose --revision '.$rev.' file://'.$repo, $out, $ret);
    if ($ret == 0) {
        $xml = new SimpleXMLElement(implode(PHP_EOL, $out));

        $attr = $xml->logentry->attributes();
        $date = date('Y-m-d H:i:s O (l, j M Y)', strtotime($xml->logentry->date));

        $group = array();
        foreach ($xml->logentry->paths->children() as $path) {
            $atr = $path->attributes();
            $group[strval($atr->action)][] = $proj . strval($path); // zarazeni do skupin
        }

        $newline = PHP_EOL . '   '; // \n . '   '

        $changes = array(); // pro slucovani do vyskytu
        if (isset($group['A'])) {
            $pole = implode($newline, $group['A']);
            $changes[] = <<<TPL
Added:
   {$pole}
TPL;
        }

        if (isset($group['M'])) {
            $pole = implode($newline, $group['M']);
            $changes[] = <<<TPL
Modified:
   {$pole}
TPL;
        }

        if (isset($group['D'])) {
            $pole = implode($newline, $group['D']);
            $changes[] = <<<TPL
Removed:
   {$pole}
TPL;
        }
        $changes = implode(PHP_EOL, $changes);

        $tpl = <<<TPL
<pre style="font-size: 12px;">
Author: {$xml->logentry->author}
Date: {$date}
New Revision: {$attr->revision}

{$changes}

Log:
{$xml->logentry->msg}
</pre>
TPL;

        $to = 'geniv.radek@gmail.com, martin.fugess@gmail.com';
        $subject = $proj . ' r' . $rev;
        $headers = array(
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: svn@gfdesign.cz',
            );

        // finalni odeslani emailu
        mail($to, $subject, $tpl, implode(PHP_EOL, $headers));
    }
} else {
    echo 'bezi pouze pod CLI' . PHP_EOL;
}