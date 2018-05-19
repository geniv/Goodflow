<?php

return <<<NEON
# neon file

# ACL
'':
  - show
home:
  - show
  - list
home/stats:
  - show
messages:
  - show
  - list
  - send
messages/show:  # virtualni sekce
  - show
  - reply
  - archive
messages/send:
  - show
  - send
messages/reply:
  - show
  - reply
messages/archive:
  - show
  - archive
users:
  - show
  - list
  - add
  - edit
  - del
users/new:
  - show
  - activate
  - deactivate
users/deactivated:
  - show
  - del
  - restore
users/roles:
  - show
  - add
  - edit
  - del
users/lastlogin:
  - show
search/users:
  - show
news:
  - show
  - list
  - add
  - edit
  - del
news/icons:
  - show
  - add
  - edit
  - del
search/news:
  - show
slideshows:
  - show
  - list
  - add
  - edit
  - del
slideshows/new:
  - show
  - activate
  - deactivate
slideshows/integrity:
  - show
search/slideshows:
  - show
downloads:
  - show
  - list
  - add
  - edit
  - del
downloads/new:
  - show
  - activate
  - deactivate
downloads/deactivated:
  - show
  - del
  - restore
downloads/category:
  - show
  - add
  - edit
  - del
downloads/version:
  - show
  - add
  - edit
  - del
downloads/kuids:
  - show
  - add
  - edit
  - del
downloads/integrity:
  - show
downloads/converter:
  - show
search/downloads:
  - show
links:
  - show
  - list
  - add
  - edit
  - del
settings:
  - show
  - list
  - save
settings/integrity:
  - show
archive:
  - show
  - list
#    examples:
#      - show
#      - list
faq:
  - show
  - list
all:
  - all

NEON;
