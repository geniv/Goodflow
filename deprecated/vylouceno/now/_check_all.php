<?php
  /**
  * @desc Script for automatic recursive syntax checking.
  *
  * Licensed under the Apache License, Version 2.0 (the "License");
  * you may not use this file except in compliance with the License.
  * You may obtain a copy of the License at
  *
  *    http://www.apache.org/licenses/LICENSE-2.0
  *
  * Unless required by applicable law or agreed to in writing, software
  * distributed under the License is distributed on an "AS IS" BASIS,
  * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  * See the License for the specific language governing permissions and
  * limitations under the License.
  *
  * Copyright 2008 Lubor Nosek
  *
  * @author Lubor Nosek <nosek@logio.cz>
  * @license http://opensource.org/licenses/apache2.0.php
  */

  $atLeastOneError = false;
  $PHP_COMMAND = '/usr/bin/php -l "%1"';

  function mylog($msg, $clear=false)
  {
    $f = fopen('./_check_all.log', ($clear ? 'wt' : 'at'));
    fwrite($f, $msg);
    fclose($f);
  }

  function testDirectory($dir, $level = 1)
  {
    global $PHP_COMMAND, $atLeastOneError;

    // nejdriv projedeme soubory v tomhle adresari
    if ($handle = opendir($dir))
    {
      $dirWritten = false;
      while (false !== ($file = readdir($handle)))
      {
        if ($file == '.' || $file == '..' || $file == '.svn')
          continue;

        $full = $dir."/".$file;

        if (is_dir($full))
        {
          continue;
        }

        if (is_file($full) == false || strtolower(substr($file, -4)) != '.php')
          continue;

        if ($dirWritten == false)
        {
          for ($i=0; $i<$level-1; $i++)
          {
            echo("  ");
          }

          echo("Checking directory: $dir\n");
          $dirWritten = true;
        }

        for ($i=0; $i<$level; $i++)
        {
          echo("  ");
        }

        echo("Checking file $file - ");

        $handle2 = popen(str_replace('%1', realpath($full), $PHP_COMMAND), 'r');
        $output = fread($handle2, 4096);
        pclose($handle2);

        //echo("\n".$output);

        if (strpos($output, 'No syntax errors detected') !== FALSE)
        {
          echo("OK\n");
        }
        else
        {
          echo("ERROR\n\n".$output);
          $atLeastOneError = true;
          mylog("---------------------------------------------------------------------\nSyntax error in $full\n$output");
        }
      }

      closedir($handle);
    }

    // pak adresare
    if ($handle = opendir($dir))
    {
      while (false !== ($file = readdir($handle)))
      {
        if ($file == '.' || $file == '..' || $file == '.svn')
          continue;

        $full = $dir."/".$file;

        if (is_dir($full))
        {
          testDirectory($full, $level+1);
          continue;
        }
      }

      closedir($handle);
    }
  }

  $timeStarted = time();

  mylog("Running _check_all.php on ".date('Y-m-d H:i:s')."\n", true);

  testDirectory('.');

  if ($atLeastOneError == false)
  {
    mylog("---------------------------------------------------------------------\nAll syntax OK\n");
  }
  else
  {
    mylog("---------------------------------------------------------------------\nSYNTAX ERROR(S) FOUND!\n");
  }

  $timeFinished = time();

  mylog("Process completed in ".($timeFinished-$timeStarted)." seconds");
?>
