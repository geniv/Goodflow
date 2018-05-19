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

database:	# MySQL driver
	name: mc-wiki
	host: localhost
	user: u
	pass: p
	port:
	autoinstall: false
';
