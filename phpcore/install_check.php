<?php
/*
 * install_check.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload
  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {
    classes\Core::checkPHP(false);

    //TODO doplnit dalsi uzitecne veci
    //TODO hlavne dodelat!!!!

    echo 'php ini:<br />';
    foreach (array(
                'disable_functions',
                'display_errors',
                'display_startup_errors',
                'file_uploads',
                'log_errors',
                'log_errors_max_len',
                'max_execution_time',
                'max_file_uploads',
                'upload_max_filesize',
                'post_max_size',
                'memory_limit',
                'max_input_nesting_level',
                'max_input_time',
                'max_input_vars',
                'output_buffering',
                'safe_mode',
                'SMTP',
                'smtp_port',
                'magic_quotes_gpc',
                'magic_quotes_runtime',
                'magic_quotes_sybase',
                'register_argc_argv',
                'register_globals',
                'register_long_arrays',
                'sendmail_path',
              ) as $v) {
      echo $v.': '.(ini_get($v) ?: 0).'<br />';
    }

  } catch (Exception $e) {
    die($e);
  }