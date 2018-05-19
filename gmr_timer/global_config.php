<?php

return <<<NEON
# neon file

project_name: GMR Timer
date_timezone: Europe/Berlin

system:
    clearall: false  # true, live nahled, false pro klasicke cachovani
    stable: false    # true, stabilni web, false pro develop vyvoj

tpl:
    auto_create: true  # true pro autovytvareni tpl pri volani metody template()
    force_compile: true # true pro okamzite kompilovani a ulozeni bez cachovani

global_css:
    - css/bootstrap.css

global_js:
    - js/jquery-1.10.2.min.js
    - js/functions.js
    - js/jquery.autosize.min.js
    - js/bootstrap.min.js

menu:
    home:
        name: Home
        link: ''
    statistiky:
        name: Statistiky
    archiv:
        name: Archiv

NEON;
