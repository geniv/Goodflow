<?php

return '
# neon file

project_name: GMR mc wiki
date_timezone: Europe/Berlin

system:
	install: false	# instalace systemovych slozek (maze cache a compile cache)
	debug: true		# povoleni debug modu pro vyvoj (generuje TPL compile cache)

cache:
	enabled: false
	expire: 1 day

session:
	expire: +30 minutes

# url: namespace\pageclass
main_index:
	pages:
		"": pages\Wiki
		mody: pages\Mody
		snapshoty: pages\Snapshoty
		texturepacky: pages\Texturepacky
		servery: pages\Servery
		mapy: pages\Mapy
		tutorialy: pages\Tutorialy
		archiv: pages\Archiv
		o-nas: pages\Onas
		admin: pages\Admin	#visibile=false

# url: namespace\pageclass
main_admin:
	pages:
		"": _admin\pages\Home
		# ?: _admin\pages\Home
		?users: _admin\pages\Users
		?retweb: _admin\pages\RetWeb
		?logout: _admin\pages\Logout

';
