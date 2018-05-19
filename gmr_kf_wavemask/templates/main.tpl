example template...

{code}

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

{/code}

<br />
monsters:<br />
{loop="$monster"}
  {$key}: {$value} <br />
{/loop}
<hr />

<form><input type="text" name="num" value="{$num}"><input type="submit"></form><hr />

pro cislo: {$num} je: <hr />

{loop="$split" as $i => $v}
  {if="$split[$poc]"}
    {code}
      $skupinky = $squad[$i];

      $prenos[$i] = $i;
      $sk = str_split($skupinky);
    {/code}
    {loop="$sk" as $id => $va}
      {if="$id % 2 == 0"}
        poc: {$va}x
      {else}
        {$monster[$va]}<br />
      {/if}
    {/loop}
    <hr />
  {/if}
  {code} $poc--; {/code}
{/loop}

{code}
  $index = (isset($_GET['index']) ? $_GET['index'] : $prenos);
  $pole = null;
{/code}

<form>
  {loop="$squad" as $i => $s}
    i={$i}:  <input type="checkbox" name="index[{$i}]" value="{$i}" {$is=isset($index[$i]) ? ' checked' : ''}>: {$s}<br />
  {/loop}

<input type="submit">
</form><hr />

{if="$index"}
  {loop="$squad" as $i => $v}
    {code}
      $pole[] = (isset($index[$i]) ? 1 : 0);
    {/code}
  {/loop}

  {code}
    $novy = implode('', array_reverse($pole));
  {/code}

  WaveMask=<a href="{$url}/?num={$novy|bindec}">{$novy|bindec}</a>

{/if}

<hr />

editace squadu:

{if="isset($_GET['plus'])"}
  {code}
  $squad[] = '';  // na pridani radku
  {/code}
{/if}

<form>
<input type="submit" value="++ pridat squadronu" name="plus"><br />
  {loop="$squad" as $i => $v}
    <input type="text" name="val[{$i}]" value="{$v}"><br />
  {/loop}
<input type="submit" name="save" value="ulozit">
</form>

{code}
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
{/code}
<hr />
MonsterSquad pro INI:
<hr />
{loop="$squad" as $i => $v}
MonsterSquad={$v}<br />
{/loop}
