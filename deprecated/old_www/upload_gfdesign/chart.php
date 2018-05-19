<?php
include_once "promenne.php";
include_once "funkce.php";

class Graf
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    switch ($_GET["action"])
    {
      case "navstevnost":
        $this->GrafNavstevnosti();
      break;
    }

/*
    $font = imageloadfont("./data/font.gdf"); //naètení fontu
    $img = imagecreate(200, 200);
    $background_color = imagecolorallocate($img, 255, 255, 255);
    $text_color = imagecolorallocate($img, 12, 12, 12);
    //imagestring($img, 6, 5, 5, "A Simple Text String", $text_color);
    //list($r, $g, $b) = str_split($_GET["barva"], 2);  //rozdìlení barvy
    //$text_color = imagecolorallocate($img, hexdec("0x$r"), hexdec("0x$g"), hexdec("0x$b")); //pøevod barvy do dec
    imagestringup($img, 5, 20, 150, "ahojky!!", $text_color); //výpis textu
    //stripslashes(iconv("UTF-8", "Windows-1250", "ahojky"))
    imagepng($img); //vykresleni obrázku
    imagedestroy($img); //vycisteni pameti
*/
  }
//******************************************************************************
  function GrafNavstevnosti()
  {
    include ("./data/jpgraph.php");
    include ("./data/jpgraph_line.php");

    //data pro statistiku prostupu z data, ip  GROUP BY cas1,
                                         // count(cas) as poc
    if ($res = @$this->var->sqlite->query("SELECT
                                          cas, strftime('%d.%m.%Y', cas) as cas1,
                                          count(cas) as poc,
                                          date(cas) as pok
                                          FROM adresa
                                          GROUP BY cas1
                                          ORDER BY cas1 ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          //$dat = strtotime($data->cas);
          //$cas[$i] = date("d.m.Y", $dat);
          echo "{$data->cas1} {$data->poc}x ({$data->pok})<br/>";
          $i++;
        }
      }
    }
      else
    {
      echo $error;
      //$this->ErrorMsg($error);
    }

/*
    $datumy = array_values(array_unique($cas)); //odstranen duplcity a vynulovani pole
    sort($datumy);
    $sumdat = count($datumy);  //pocet unikatnich datumu
    $datumpoc = array_values(array_count_values($cas)); //spocitan jednotlivych polozek

    //$ydata = array(11,3,8,12,5,1,9,13,5,7);
    // Create the graph. These two calls are always required
    $graph = new Graph(500,300);
    $graph->SetScale("textlin");

    $graph->img->SetMargin(40,20,40,80);
    // Add graph and axis title
    $graph->title->Set("nazev");
    $graph->xaxis->title->Set("Datum");
    $graph->yaxis->title->Set("Pocet");


    $graph->xaxis->SetTickLabels($datumy);
    $graph->xaxis->SetLabelAngle(90);


    // Create the linear plot
    $lineplot = new LinePlot($datumpoc);
    // Add the plot to the graph
    $graph->Add($lineplot);
    // Display the graph
    $graph->Stroke();
*/








/*
    //vypis datumu
    $datumy = array_values(array_unique($cas)); //odstranen duplcity a vynulovani pole
    sort($datumy);
    $sumdat = count($datumy);  //pocet unikatnich datumu
    $datumpoc = array_count_values($cas); //spocitan jednotlivych polozek

    $delka = count($datumy) * 15 + 20;
    $img = imagecreate($delka, 250);
    $background_color = imagecolorallocate($img, 255, 255, 255);
    $text_color = imagecolorallocate($img, 12, 12, 12);

    imageline($img, 20, 0, 20, 150, $text_color);
    imageline($img, 0, 150, $delka, 150, $text_color);

    $y = 0;
    $posun = 15;
    for ($i = 0; $i < count($datumy); $i++)
    {
      $posun += 5;
imagestringup($img, 5, $posun, 250, $datumy[$i], $text_color); //výpis textu
$y = 5;
//$datumpoc[$datumy[$i]];
//imageline($img, $posun, 0, $posun, $y, $text_color);



      $datumm .=
      "
<p class=\"expirace_central".($i == (count($datumy) - 1) ? " neborder_central" : "")."\">
  <span class=\"expirace\">{$datumy[$i]}</span>
  <span class=\"neborder prihlasen_v\">{$datumpoc[$datumy[$i]]}x</span>
</p>
      ";
    }

    imagepng($img); //vykresleni obrázku
    imagedestroy($img); //vycisteni pameti
*/



    //imagestring($img, 6, 5, 5, "A Simple Text String", $text_color);
    //list($r, $g, $b) = str_split($_GET["barva"], 2);  //rozdìlení barvy
    //$text_color = imagecolorallocate($img, hexdec("0x$r"), hexdec("0x$g"), hexdec("0x$b")); //pøevod barvy do dec

    //stripslashes(iconv("UTF-8", "Windows-1250", "ahojky"))

  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

//header("Content-type: image/png");
$web = new Graf();
?>