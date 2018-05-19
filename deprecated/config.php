<?php

return '
# neon file

project_name: GMR mc wiki
language: cs

cache:
	enabled: true
	expire: 1 day

session:
	expire: +30 minutes

database:
	name: mc-wiki
	#driver: oci|mysql|sqlite
	host: localhost
	user: root
	pass:
	port:
	autoinstall: false
';

?>
