<?php
/*
 *      identify.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  exec('identify -version', $out);
  echo nl2br(print_r($out, true));

?>
