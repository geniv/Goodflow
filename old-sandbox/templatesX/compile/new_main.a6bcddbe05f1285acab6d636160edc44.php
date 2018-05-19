<?php $__r = <<<T
<!doctype html>
<html ng-app>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}} 
T
. ($neco) . <<<T
!</h1>
    </div>
  </body>
</html>


abc..

<div class="menu">

T;
  $counter1 =- 1; $__array1 = $tpl->getMenu(); if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $key => $value) { $counter1++; $__r .= <<<T

    
T;
  if (!$value->hasMenu()) { $__r .= <<<T

      -- <a href="
T
. ($value->allurl) . <<<T
">
T
. ($value->name) . <<<T
</a> [lvl: 
T
. ($value->level) . <<<T
, act: 
T
. ($value->active) . <<<T
]<br />
    
T;
  } else { $__r .= <<<T

      <ul class="sub">
      
T;
  $counter2 =- 1; $__array2 = $value->menu; if (isset($__array2) && (is_array($__array2) || $__array2 instanceof \Traversable) && count($__array2)) foreach ($__array2 as $key => $value) { $counter2++; $__r .= <<<T

        <li><a href="
T
. ($value->allurl) . <<<T
">
T
. ($value->name) . <<<T
</a> [lvl: 
T
. ($value->level) . <<<T
, act: 
T
. ($value->active) . <<<T
]</li>
      
T;
  } $__r .= <<<T

      </ul>
  
T;
  } $__r .= <<<T


T;
  } $__r .= <<<T

</div>


T;
return $__r;