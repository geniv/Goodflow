<?php

return <<<NEON
# neon file

project_name: project name
date_timezone: Europe/Berlin

system:
    clearall: false  # true, live nahled, false pro klasicke cachovani
    stable: false    # true, stabilni web, false pro develop vyvoj

tpl:
    auto_create: true  # true pro autovytvareni tpl pri volani metody template()
    force_compile: true # true pro okamzite kompilovani a ulozeni bez cachovani

NEON;
