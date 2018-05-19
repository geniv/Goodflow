<?php

return <<<NEON
# neon file

project_name: project name
date_timezone: Europe/Berlin

cache:
  enabled: true
  expire: 1 day

user:
  expire: 2 hours

system:
  clearall: true  # true, live nahled, false pro klasicke cachovani

tpl:
  auto_create: false  # true pro autovytvareni tpl pri volani metody template()
  force_compile: true # true pro okamzite kompilovani a ulozeni bez cachovani

# jazykove mutace
language:
  default: cs
  auto_create: false
  list:
    cs: [cs_CZ, CZ]
    en: [en_US, EN]
    de: [de_DE, DE]

menu:
  home:
    name: Home
    link: ''
  odkazy:
    name: Odkazy
    
admin:
  url: admin

NEON;
