<?php $__r = <<<T


example template...
asdasd




T;
  $counter1 =- 1; $__array1 = $menu->getArrayMenu(1); if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $key => $value) { $counter1++; $__r .= <<<T

  
T;
$__r .= ($key) . <<<T
 - 
T;
$__r .= ($value) . <<<T
 - [
T;
$__r .= ($value->url) . <<<T
]

T;
  } $__r .= <<<T

ddf
dsfdsfdf 
 sdads
 fd
 sfdsfdsfsdf
T;
return $__r;