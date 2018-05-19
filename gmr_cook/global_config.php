<?php

return <<<NEON
# neon file

date_timezone: Europe/Berlin

htmlpage:	# konfigurace html stranky
	title: "GMR cook - Zajimavá GMR kuchařka"
	keywords: "slova..."
	description: "descr..."
	robots: "noindex, nofollow"
	urladmin: \$ad		# musi byt stejny jako klic v: index_menu.pages

system:
	install: false		# instalace systemovych slozek (maze cache a compile cache)
	debug: true			# povoleni debug modu pro vyvoj (generuje TPL compile cache)

cache:
	enabled: false
	expire: 1 day

user:
	expire: 2 hours

# url: namespace\pageclass
# index menu
index_menu:
	'': pages\Home
	recepty: pages\Recepty
	suroviny: pages\Suroviny
	\$ad: pages\Admin

index_menu_admin:
	'': _admin\pages\Home
	?recepty: _admin\pages\Recepty
	?kategorie: _admin\pages\Kategorie
#	?jednotky: _admin\pages\Jednotky
	?suroviny: _admin\pages\Suroviny
	?nadobi: _admin\pages\Nadobi
	?uzivatele: _admin\pages\Uzivatele
	?logout: _admin\pages\Logout

NEON;
