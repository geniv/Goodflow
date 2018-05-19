<?php

require 'loader.php';

$tp = new classes\Xtpl;

var_dump($tp::synchronizeCron());
var_dump(classes\Xtpl::synchronizeCron());