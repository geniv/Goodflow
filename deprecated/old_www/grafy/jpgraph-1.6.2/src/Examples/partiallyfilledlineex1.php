<?php

include("../jpgraph.php");
include("../jpgraph_line.php");

// create the graph
$graph= new Graph(550,350,"auto");

$ydata = array(5,10,15,20,15,10,8,7,4,10,5);

$graph->SetScale("textlin");
$graph->SetShadow(true);
$graph->SetMarginColor("antiquewhite");
$graph->img->SetMargin(60,40,40,50);
$graph->img->setTransparent("white");
$graph->xaxis->SetFont(FF_FONT1);
$graph->xaxis->setTextTickInterval(1);
$graph->xaxis->SetTextLabelInterval(1);
$graph->legend->SetFillColor("antiquewhite");
$graph->legend->SetShadow(true);
$graph->legend->SetLayout(LEGEND_VERT);
$graph->legend->Pos(0.02,0.01);
$graph->title->Set("Filled Area Example");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$lineplot = new LinePlot($ydata);
$lineplot->SetColor("black");
//$lineplot->SetStepStyle();
$lineplot->AddArea(2,5,LP_AREA_FILLED,"indianred1");

$lineplot->AddArea(6,8,LP_AREA_FILLED,"orange");
$lineplot->mark->SetType(MARK_DIAMOND);
$lineplot->mark->Show();

// add plot to the graph
$graph->Add($lineplot);
//$graph->ygrid->show(false,false);

// display graph
$graph->Stroke();
?>