<?php

return <<<NEON
# neon file

project_name: project name
date_timezone: Europe/Berlin

user:
  expire: 2 hours

system:
  clearall: false  # true, live nahled, false pro klasicke cachovani

tpl:
  auto_create: true  # true pro autovytvareni tpl pri volani metody template()
  force_compile: false # true pro okamzite kompilovani a ulozeni bez cachovani

# jazykove mutace
language:
  default: en


menu:
  home:
    name: Home
    link: ''
  post:
    name: Post
    visible: false

menu_css:
  - css/reset.css
  - css/bootstrap.css
  - css/main.css

menu_js:
  - js/modernizr-2.6.2.min.js


admin:
  url: admin
  menu:
    home:
      name: Home
    languages:
      name: Languages
    menus:
      name: Menu
    posts:
      name: Post

admin_css:
  # Plugin Stylesheets first to ease overrides
  - admin_template/custom-plugins/wizard/wizard.css
  - admin_template/plugins/select2-3.4.2/select2.css
  - admin_template/plugins/ibutton/jquery.ibutton.css
  - admin_template/plugins/imgareaselect/css/imgareaselect-default.css
  - admin_template/plugins/jgrowl/jquery.jgrowl.css
  # equired Stylesheets
  - admin_template/bootstrap/css/bootstrap.min.css
  - admin_template/css/fonts/ptsans/stylesheet.css
  - admin_template/css/fonts/icomoon/style.css
  - admin_template/css/fonts/font-awesome/font-awesome.css
  # MWS icons
  - admin_template/css/mws-style.css
  - admin_template/css/icons/icol16.css
  - admin_template/css/icons/icol32.css
  # Components Stylesheet
  - admin_template/css/main.css
  # jQuery-UI Stylesheet
  - admin_template/jui/css/jquery.ui.all.css
  - admin_template/jui/jquery-ui.custom.css
  # Theme Stylesheet
  - admin_template/css/mws-theme.css
  - admin_template/css/themer.css
  # Plugin Stylesheets
  - admin_template/plugins/treeview/jquery.treeview.css

admin_js: null

NEON;
