<?php
/*
 * cron.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * cron:
 * 00 21 * * * wget -qO /dev/null http://url/url/url/cron.php
 * auth cron:
 * 00 21 * * * wget -qO /dev/null http://user:pass@localhost/www/git/goodflow/trainz_cz/cron.php
 * $ crontab -l
 */

  require 'lightloader.php';
  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {
    classes\Core::checkPHP(false);
    classes\Debugger::startTime();

    $cfg = classes\Configurator::decode('cron_config.php');

    classes\DateAndTime::setDateTimezone('Europe/Berlin');

    if (!isset($_SERVER['PHP_AUTH_USER']) && isset($cfg['auth'])) { // pokud existuje autorizace
      header('WWW-Authenticate: Basic realm="'.$cfg['auth']['realm'].'"');
      header('HTTP/1.0 401 Unauthorized');
      die($cfg['auth']['cancel']);
    } else {
      // pokud je autorizace
      if (isset($cfg['auth']) ? $_SERVER['PHP_AUTH_USER'] === $cfg['auth']['user'] && $_SERVER['PHP_AUTH_PW'] === $cfg['auth']['pw'] : true) {
        echo date('Y-m-d H:i:s') . '<br />' . PHP_EOL;

        $poc = 0;
        foreach ($cfg['tasks'] as $class => $args) {
          if (class_exists($class)) { // pokud trida existuje
            echo 't' . $poc . '=p' . $class::synchronizeCron($args) . '<br />' . PHP_EOL;
            $poc++;
          }
        }

        echo ($time = classes\Debugger::viewTime());

        classes\ErrorLoger::addLog('Cron spusten, cas vykonavani ' . trim($time));  // zalogovani
      } else {
        die($cfg['auth']['cancel']);
      }
    }

  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e);
  }