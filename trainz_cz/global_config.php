<?php

return <<<NEON
# neon file

project_name: Trainz.cz
date_timezone: Europe/Berlin

##################################################

#vyhozeno, deprecated!
#cache:
#  enabled: true
#  expire: 1 day

##################################################

system:
  clearall: false  # true, live nahled, false pro klasicke cachovani

##################################################

tpl:
  auto_create: false  # true pro autovytvareni tpl pri volani metody template()
  force_compile: false # true pro okamzite kompilovani a ulozeni bez cachovani

##################################################

# jazykove mutace
language:
  default: cs
  auto_create: false
  list:
    cs: [cs_CZ, CZ]
    en: [en_US, EN]
    de: [de_DE, DE]

##################################################

# upload sekce
user:
  expire: 2 hours
  url: upload
  menu:
    home:
      name: Home
      link: ''
    profile:
      name: Profile
      visible: false
      js:
        - js/bootstrap-filestyle.min.js
    downloads:
      name: Objekty / Mapy
      js:
        - admin_template/plugins/maskedinput/jquery.numberMask.js
        - js/bootstrap-filestyle.min.js
        - js/select2-3.4.2/select2.min.js
        - js/select2-3.4.2/select2_locale_cs.js
        - admin_template/plugins/autosize/jquery.autosize.min.js
        - js/tinymce/tinymce.min.js
        - js/jquery.jgrowl/jquery.jgrowl.min.js
        - js/jquery.fancybox/jquery.fancybox.pack.js
        - js/upload_download.js
    slideshows:
      name: Screenshoty
      js:
        - js/bootstrap-filestyle.min.js
        - js/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.js
        - js/upload_slideshow.js
    messages:
      name: Zprávy
      js:
        - js/select2-3.4.2/select2.min.js
        - js/select2-3.4.2/select2_locale_cs.js
        - js/tinymce/tinymce.min.js
        - js/upload_messages.js
    notification:
      name: Stav požadavků
    help:
      name: Nápověda
      js:
        - js/jquery.fancybox/jquery.fancybox.pack.js
        - js/upload_help.js

##################################################

# hlavni sekce
menu:
  home:
    name: Oficiální stránky Trainz Railroad Simulator
    link: ''
    js:
      - js/jquery.cycle2.min.js
    menu:
      novinky:
        name: Novinky
        visible: false
  forum:
    name: Forum
    link: http://forum.trainz.cz/
  download:
    name: Download
    css:
      - js/jquery.treeview/jquery.treeview.css
      - js/jquery.fancybox/jquery.fancybox.css
    js:
      - js/jquery.treeview/jquery.treeview.js
      - js/jquery.fancybox/jquery.fancybox.pack.js
      - js/download.js
    menu:
      autor:
        name: Autor
        visible: false
      hledat:
        name: Hledat
        visible: false
      historie:
        name: Historie Downloadu
        visible: false
  odkazy:
    name: Odkazy
  shop:
    name: Shop
  upload:
    name: Upload
    css:
      - js/select2-3.4.2/select2.css
      - css/icomoon/style.css
      - js/jquery.jgrowl/jquery.jgrowl.min.css
      - js/jquery.fancybox/jquery.fancybox.css
      - js/jquery.imgareaselect-0.9.10/css/imgareaselect-animated.css
    js:
      - js/jquery.ui.effect-shake-min.js
      - js/jquery.validate-min.js
      - js/upload.js
    menu:
      registrace:
        name: Registrace
        visible: false
      zebricek-autoru:
        name: Žebříček autorů
        visible: false
      nejstahovanejsi-objekty:
        name: 30 nejstahovanějších objektů/map
        visible: false
      screenshoty-autoru:
        name: Všechny screenshoty autorů
        visible: false

##################################################

# admin sekce
admin:
  url: admin
  search: # povolit hledani v:
    home:
      - ''
    users:
      - ''
    news:
      - ''
    slideshows:
      - ''
    downloads:
      - ''
      - deactivated
      - kuids
  menu: # admin menu
    home:
      name: Home
      ikona: home
      menu:
        stats:
          name: Statistiky
          js:
            - admin_template/plugins/Highcharts-3.0.5/js/highcharts.js
            - admin_template/plugins/Highcharts-3.0.5/js/modules/exporting.js
    search:
      name: Hledani
      visible: false
    messages:
      name: Zprávy
      ikona: envelope
    users:
      name: Uživatelé
      ikona: users
      menu:
        new:
          name: Nově registrovaní
        deactivated:
          name: Deaktivovaní
        roles:
          name: Oprávnění
        lastlogin:
          name: Log přihlašování
    news:
      name: Novinky
      ikona: newspaper
      menu:
        icons:
          name: Ikony
    slideshows:
      name: Slideshow
      ikona: pictures
      menu:
        new:
          name: Nově přidané
        integrity:
          name: Kontrola záznamů
    downloads:
      name: Download
      ikona: box-add
      menu:
        new:
          name: Nově přidané
        deactivated:
          name: Deaktivované
        category:
          name: Kategorie
        version:
          name: Trainz verze
        kuids:
          name: Databáze kuidů
        integrity:
          name: Kontrola záznamů
        converter:
          name: Převodník kuidů
    links:
      name: Odkazy
      ikona: link
    settings:
      name: Globalní nastavení
      ikona: tools
      menu:
        integrity:
          name: Kontrola systému
    archive:
      name: Archiv
      ikona: aws-archive
#    examples:
#      name: Vzory
#      ikona: light-bulb
    faq:
      name: Nápověda
      ikona: question-sign

NEON;
