<?php

return <<<NEON
# neon file

autoinstall: false    # true pro povoleni instalace databaze
name: dbname          # jmeno databaze
driver: MySQL         # jmeno databazoveho driveru podle PDOHelper-u

MySQL:
  host: localhost
  username:
  password:
  port:

SQLite3:
  host:

Oci8:
  host:
  username:
  password:
  port:

# ochrana
runnable: false

# error loger
errorloger:
  email: email@gmail.com
  printstdout: true     # true pro vypis na stdout
  instantlysend: false  # true pro okamzite odeslani chyby pri vyskytu

# ACL
admin:
  roles:
    user: uživatel
  resources:
    user_section: user sekce
  login:
    log: [in]

NEON;
