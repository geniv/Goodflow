<?php $__r = <<<T

toto je chybova stranka.. bojte se...
cas: 
T
. ($date) . <<<T
,
typ: 
T
. ($type) . <<<T

zprava: 
T
. ($message) . <<<T

soubor: 
T
. ($file) . <<<T

linka: 
T
. ($line) . <<<T

-------------------
dalsi info: 
T
. ($other) . <<<T


T;
return $__r;