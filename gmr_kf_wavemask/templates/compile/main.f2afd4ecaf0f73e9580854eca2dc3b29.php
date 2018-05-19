<?php $__r = <<<T
example template...


T;


  $url = classes\Core::getUrl();

  $file_name = 'config_death_space.json';
  //$file_name = 'config_default.json';

  $json = null;
  if (file_exists($file_name)) {
    $file = file_get_contents($file_name);
    $json = json_decode($file, true);
  }

  $monster = array(
    'A' => 'Clot',
    'B' => 'Crawler',
    'C' => 'GoreFast',
    'D' => 'Stalker',
    'E' => 'Scrake',
    'F' => 'Fleshpound',
    'G' => 'Bloat',
    'H' => 'Siren',
    'I' => 'Husk',
  );

  if (isset($json['monster'])) {
    $monster = $json['monster'];
  }

  $squad = array(
    '4A',
    '4A1G',
    '2B',
    '4B',
    '3A1G',
    '2D',
    '3A1C',
    '2A2C',
    '2A3B1C',
    '1A3C',
    '3A1C1H',
    '3A1B2D1G1H',
    '3A1E',
    '2A1E',
    '2A3C1E',
    '2B3D1G2H',
    '4A1C',
    '4A',
    '4D',
    '4C',
    '6B',
    '2B2C2D1H',
    '2A2B2C2H',
    '1F',
    '1I',
    '2A1C1I',
    '2I',
  );

  if (isset($json['squad'])) {
    $squad = $json['squad'];
  }

  $num = isset($_GET['num']) ? $_GET['num'] : 0;

  $dec = $num;  //196611 / 125892608;

  $bin = decbin($dec);
  $doplnit = count($squad) - strlen($bin);
  $finalbin = str_repeat('0', $doplnit) . $bin;
  $split = str_split($finalbin);
  $poc = count($squad) - 1;
  $prenos = array();


$__r .= <<<T


<br />
monsters:<br />

T;
  $counter1 =- 1; $__array1 = $monster; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $key => $value) { $counter1++; $__r .= <<<T

  
T
. ($key) . <<<T
: 
T
. ($value) . <<<T
 <br />

T;
  } $__r .= <<<T

<hr />

<form><input type="text" name="num" value="
T
. ($num) . <<<T
"><input type="submit"></form><hr />

pro cislo: 
T
. ($num) . <<<T
 je: <hr />


T;
  $counter1 =- 1; $__array1 = $split; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $i => $v) { $counter1++; $__r .= <<<T

  
T;
  if ($split["$poc"]) { $__r .= <<<T

    
T;

      $skupinky = $squad[$i];

      $prenos[$i] = $i;
      $sk = str_split($skupinky);
    
$__r .= <<<T

    
T;
  $counter2 =- 1; $__array2 = $sk; if (isset($__array2) && (is_array($__array2) || $__array2 instanceof \Traversable) && count($__array2)) foreach ($__array2 as $id => $va) { $counter2++; $__r .= <<<T

      
T;
  if ($id % 2 == 0) { $__r .= <<<T

        poc: 
T
. ($va) . <<<T
x
      
T;
  } else { $__r .= <<<T

        
T
. ($monster["$va"]) . <<<T
<br />
      
T;
  } $__r .= <<<T

    
T;
  } $__r .= <<<T

    <hr />
  
T;
  } $__r .= <<<T

  
T;
 $poc--; 
$__r .= <<<T


T;
  } $__r .= <<<T



T;

  $index = (isset($_GET['index']) ? $_GET['index'] : $prenos);
  $pole = null;

$__r .= <<<T


<form>
  
T;
  $counter1 =- 1; $__array1 = $squad; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $i => $s) { $counter1++; $__r .= <<<T

    i=
T
. ($i) . <<<T
:  <input type="checkbox" name="index[
T
. ($i) . <<<T
]" value="
T
. ($i) . <<<T
" 
T
. ($is=isset($index["$i"]) ? ' checked' : '') . <<<T
>: 
T
. ($s) . <<<T
<br />
  
T;
  } $__r .= <<<T


<input type="submit">
</form><hr />


T;
  if ($index) { $__r .= <<<T

  
T;
  $counter1 =- 1; $__array1 = $squad; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $i => $v) { $counter1++; $__r .= <<<T

    
T;

      $pole[] = (isset($index[$i]) ? 1 : 0);
    
$__r .= <<<T

  
T;
  } $__r .= <<<T


  
T;

    $novy = implode('', array_reverse($pole));
  
$__r .= <<<T


  WaveMask=<a href="
T
. ($url) . <<<T
/?num=
T
. (bindec($novy)) . <<<T
">
T
. (bindec($novy)) . <<<T
</a>


T;
  } $__r .= <<<T


<hr />

editace squadu:


T;
  if (isset($_GET['plus'])) { $__r .= <<<T

  
T;

  $squad[] = '';  // na pridani radku
  
$__r .= <<<T


T;
  } $__r .= <<<T


<form>
<input type="submit" value="++ pridat squadronu" name="plus"><br />
  
T;
  $counter1 =- 1; $__array1 = $squad; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $i => $v) { $counter1++; $__r .= <<<T

    <input type="text" name="val[
T
. ($i) . <<<T
]" value="
T
. ($v) . <<<T
"><br />
  
T;
  } $__r .= <<<T

<input type="submit" name="save" value="ulozit">
</form>


T;

  $newsquad = array();
  if (isset($_GET['val'])) {
    $newsquad = array_filter($_GET['val']);
  }

  if (isset($_GET['save']) && $_GET['save'] == 'ulozit') {
    echo 'ulozeno';

    $fin = array(
      'monster' => $monster,
      'squad' => $newsquad,
    );

    file_put_contents($file_name, json_encode($fin));
    classes\Core::setRefresh(0, classes\Core::getUrl());
  }

$__r .= <<<T

<hr />
MonsterSquad pro INI:
<hr />

T;
  $counter1 =- 1; $__array1 = $squad; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $i => $v) { $counter1++; $__r .= <<<T

MonsterSquad=
T
. ($v) . <<<T
<br />

T;
  } $__r .= <<<T


T;
return $__r;