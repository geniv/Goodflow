<?php

return <<<NEON
# neon file

project_name: KF news
date_timezone: Europe/Berlin

cache:
  enabled: true
  expire: 1 day

session:
  expire: +30 minutes

system:
  clearall: true  # true, live nahled, false pro klasicke cachovani

tpl:
  auto_create: false
  force_compile: true

admin:
  url: admin

menu:
  home:
    name: Home
    link: ''
  servery:
    name: Servery
  novinka:
    name: Novinka
    visible: false
  server:
    name: Server
    visible: false

NEON;
