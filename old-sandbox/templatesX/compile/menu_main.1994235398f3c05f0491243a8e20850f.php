<?php $__r = <<<T

<div class="menu">  
  <ul>
  
T;
  $counter1 =- 1; $__array1 = $menu_loop; if (isset($__array1) && (is_array($__array1) || $__array1 instanceof \Traversable) && count($__array1)) foreach ($__array1 as $key => $v) { $counter1++; $__r .= <<<T

    <li><a href="
T
. ($v->allurl) . <<<T
">
T
. ($v->name) . <<<T
</a> - [ <strong>
T
. ($v->active) . <<<T
</strong> ], (
T
. ($v->url) . <<<T
), 
T
. ($v->poc) . <<<T
-
T
. ($v->count) . <<<T
, lvl: 
T
. ($v->level) . <<<T
  </li>
    
T;
  if ($v->hasMenu()) { $__r .= <<<T

      <ul>
      
T;
  $counter2 =- 1; $__array2 = $v->getMenu(); if (isset($__array2) && (is_array($__array2) || $__array2 instanceof \Traversable) && count($__array2)) foreach ($__array2 as $key => $v1) { $counter2++; $__r .= <<<T

        <li><a href="
T
. ($v1->allurl) . <<<T
">
T
. ($v1->name) . <<<T
</a> - [ <strong>
T
. ($v1->active) . <<<T
</strong> ], (
T
. ($v1->url) . <<<T
), 
T
. ($v1->poc) . <<<T
-
T
. ($v1->count) . <<<T
, lvl: 
T
. ($v1->level) . <<<T
  </li>
        
T;
  if ($v1->hasMenu()) { $__r .= <<<T

          <ul>
          
T;
  $counter3 =- 1; $__array3 = $v1->getMenu(); if (isset($__array3) && (is_array($__array3) || $__array3 instanceof \Traversable) && count($__array3)) foreach ($__array3 as $key => $v2) { $counter3++; $__r .= <<<T

            <li><a href="
T
. ($v2->allurl) . <<<T
">
T
. ($v2->name) . <<<T
</a> - [ <strong>
T
. ($v2->active) . <<<T
</strong> ], (
T
. ($v2->url) . <<<T
) 
T
. ($v2->poc) . <<<T
-
T
. ($v2->count) . <<<T
, lvl: 
T
. ($v2->level) . <<<T
  </li>
            
T;
  if ($v2->hasMenu()) { $__r .= <<<T

              <ul>
              
T;
  $counter4 =- 1; $__array4 = $v2->getMenu(); if (isset($__array4) && (is_array($__array4) || $__array4 instanceof \Traversable) && count($__array4)) foreach ($__array4 as $key => $v3) { $counter4++; $__r .= <<<T

                <li><a href="
T
. ($v3->allurl) . <<<T
">
T
. ($v3->name) . <<<T
</a> - [ <strong>
T
. ($v3->active) . <<<T
</strong> ], (
T
. ($v3->url) . <<<T
) 
T
. ($v3->poc) . <<<T
-
T
. ($v3->count) . <<<T
, lvl: 
T
. ($v3->level) . <<<T
  </li>
              
T;
  } $__r .= <<<T

              </ul>
            
T;
  } $__r .= <<<T

          
T;
  } $__r .= <<<T

          </ul>
        
T;
  } $__r .= <<<T

      
T;
  } $__r .= <<<T

      </ul>
    
T;
  } $__r .= <<<T

  
T;
  } $__r .= <<<T

  </ul>
</div>

<br />

pro tpl: <strong>
T
. (implode($menu->getActiveAddress(),'/')) . <<<T
</strong>
T;
return $__r;