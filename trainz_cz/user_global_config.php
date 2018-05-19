<?php
return <<<NEON
# neon file
expire:
	lastlogins-description: "days (posledni log prihlasovani za jak dlouho)"
	lastlogins: "7"
	notifications-description: "days (posledni archiv za jak dlouho)"
	notifications: "7"
	shoutboards-description: "days (posledni vzkazy za jak dlouho)"
	shoutboards: "14"
	users-description: "days (jak dlouho nechavat neaktivni uzivatele)"
	users: "14"
	
home:
	slideshowWidth-description: px
	slideshowWidth: "950"
	slideshowHeight-description: px
	slideshowHeight: "370"
	
novinky:
	pocetPolozekNaStranku-description: "pocet (na uvodni strane)"
	pocetPolozekNaStranku: "5"
	rozsahStrankovani-description: "pocet (kolik zobrazenych stranek pro listovani)"
	rozsahStrankovani: "10"
	pocetOdstavcuNaPolozku-description: "pocet (kolik odstavcu nez se zobrazi VICE...)"
	pocetOdstavcuNaPolozku: "3"
	pocetMesicuHistorie-description: "pocet (mesicu nazpet se ma zobrazovat historie)"
	pocetMesicuHistorie: "3"
	
download:
	miniWidth-description: px
	miniWidth: "240"
	miniHeight-description: px
	miniHeight: "180"
	fullWidth-description: px
	fullWidth: "800"
	fullHeight-description: px
	fullHeight: "600"
	pocetPoslednichPolozek-description: "pocet (na uvodni strane)"
	pocetPoslednichPolozek: "10"
	sessionExpire-description: "<a href='http:\/\/php.net\/manual\/en\/function.strtotime.php' class='btn btn-small'>strtotime<\/a> (za jak dlouho se bude znovu pocitat stazeni)"
	sessionExpire: 1 hour
	maxSearchItems-description: "pocet (maximum polozek na vyhledavani v download)"
	maxSearchItems: "50"
	kuidRozsahStrankovani-description: "pocet (kolik zobrazenych stranek pro listovani)"
	kuidRozsahStrankovani: "15"
	kuidPolozekNaStranku-description: "pocet (kuidu na stranku)"
	kuidPolozekNaStranku: "100"
	
user:
	rozsahStrankovani-description: "pocet (kolik zobrazenych stranek pro listovani)"
	rozsahStrankovani: "10"
	polozekNaStranku-description: "pocet (uzivatelu na stranku)"
	polozekNaStranku: "50"
	
slideshow:
	rozsahStrankovani-description: "pocet (kolik zobrazenych stranek pro listovani)"
	rozsahStrankovani: "10"
	polozekNaStranku-description: "pocet (screenshotu na stranku)"
	polozekNaStranku: "20"
	
link:
	pictureWidth-description: px
	pictureWidth: "150"
	pictureHeight-description: px
	pictureHeight: "80"
	
admin:
	sectionRefreshTime-description: "sec (jak dlouho se ceka pri redirectu pri pridavani\/ukladani)"
	sectionRefreshTime: "2"
	userAvatarWidth-description: px
	userAvatarWidth: "128"
	userAvatarHeight-description: px
	userAvatarHeight: "128"
	shoutboardRefresh-description: "sec (auto-obnovovaci chat vzkazniku)"
	shoutboardRefresh: "30"
	shoutboardUserOnline-description: "min (jak dlouho se ukaze online admin pri odeslani posledni zpravy)"
	shoutboardUserOnline: "5"
	
notification:
	admin1-description: "ID uzivatele (prijemce zprav v upload sekci)"
	admin1: "1"
	admin2-description: "ID uzivatele (prijemce zprav v upload sekci)"
	admin2: "2"
	admin3-description: "ID uzivatele (prijemce zprav v upload sekci)"
	admin3: "4"
	admin4-description: "ID uzivatele (prijemce zprav v upload sekci)"
	admin4: "5"
	admin5-description: "ID uzivatele (prijemce zprav v upload sekci)"
	admin5: "6"
	
notification_email:
	registration-description: "ID uzivatele (komu budou chodit info maily)"
	registration:
		- "1"
		
	download-description: "ID uzivatele (komu budou chodit info maily)"
	download:
		- "5"
		- "6"
		
	slideshow-description: "ID uzivatele (komu budou chodit info maily)"
	slideshow:
		- "1"
		
	

NEON;
