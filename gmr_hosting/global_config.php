<?php

return <<<NEON
# neon file

date_timezone: Europe/Berlin

htmlpage:	# konfigurace html stranky
	title: "GMR - Hosting herních serverů"
	keywords: "slova..."
	description: "descr..."
	robots: "noindex, nofollow"
	urladmin: \$ad		# musi byt stejny jako klic v: main_index.pages

system:
	install: false	# instalace systemovych slozek (maze cache a compile cache)
	debug: true		# povoleni debug modu pro vyvoj (generuje TPL compile cache)

cache:
	enabled: false
	expire: 1 day

session:
	expire: "+1 hour"


# url: namespace\pageclass
# index menu
index_menu:
	'': pages\Home
	herni-servery:
		'': pages\Herni_servery
		seznam: pages\Herni_servery_seznam
		akce: pages\Herni_servery_akce
		balicky: pages\Herni_servery_balicky
	web-development: pages\webdevelopment
	kontakt: pages\Kontakt
	\$ad: pages\Admin	# visibile=false, musi byt stejny jako: htmlpage.urladmin
	prihlasit-se: pages\User_login
	registrace: pages\Registrace
	user: pages\User
	novinky: pages\Novinky


# admin menu
admin_menu:
	?webadmin:
		'': _admin\pages\WebAdmin_Home
		novinky:
			'': _admin\pages\Novinky_Home
			#nov1: _admin\pages\Novinky_Home
		uzivatele:
			'': _admin\pages\Uzivatele_Home
		nabidka_her:
			'': _admin\pages\NabidkaHer_Home
		spravce:
			'': _admin\pages\Spravce_Home
	?serveradmin:
		'': _admin\pages\ServerAdmin_Home
		domeny:
			'': _admin\pages\Domeny_Home
	?faktury:
		'': _admin\pages\Faktury_Home
	?statistiky:
		'': _admin\pages\Statistiky_Home
	?retweb: _admin\pages\RetWeb
	?logout: _admin\pages\Logout


NEON;
