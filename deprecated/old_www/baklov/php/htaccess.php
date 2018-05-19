
Options -Indexes

ErrorDocument 404 /error_page.html
ErrorDocument 403 /error_page.html
ErrorDocument 500 /error_page.html

AddHandler php5-cgi .php
Action php5-cgi /php5cgi/php

RewriteEngine On
RewriteRule ^hlavni-strana						%{DOCUMENT_ROOT}/index.php?action=uvod [L,QSA]
RewriteRule ^turisticke-informace-fyzicka-osoba			%{DOCUMENT_ROOT}/index.php?action=turistika-fyzicka [L,QSA]
RewriteRule ^turisticke-informace-podnikatel			%{DOCUMENT_ROOT}/index.php?action=turistika-pravnicka [L,QSA]
RewriteRule ^turisticke-informace					%{DOCUMENT_ROOT}/index.php?action=turistika [L,QSA]
RewriteRule ^doprava-autem						%{DOCUMENT_ROOT}/index.php?action=doprava-auto [L,QSA]
RewriteRule ^doprava-vlakem						%{DOCUMENT_ROOT}/index.php?action=doprava-vlak [L,QSA]
RewriteRule ^doprava							%{DOCUMENT_ROOT}/index.php?action=doprava [L,QSA]
RewriteRule ^poradani-akci-soukrome-akce				%{DOCUMENT_ROOT}/index.php?action=akce-soukroma [L,QSA]
RewriteRule ^poradani-akci-firemni-akce				%{DOCUMENT_ROOT}/index.php?action=akce-firemni [L,QSA]
RewriteRule ^poradani-akci						%{DOCUMENT_ROOT}/index.php?action=akce [L,QSA]
RewriteRule ^okolni-pamatky						%{DOCUMENT_ROOT}/index.php?action=pamatky [L,QSA]
RewriteRule ^kontakt							%{DOCUMENT_ROOT}/index.php?action=kontakt [L,QSA]
RewriteRule ^mapa-stranek						%{DOCUMENT_ROOT}/index.php?action=mapa [L,QSA]
RewriteRule ^opatreni-pro-zlepseni-on-page-a-off-page-faktoru	%{DOCUMENT_ROOT}/index.php?action=opatreni [L,QSA]
RewriteRule ^prohlaseni-o-pristupnosti				%{DOCUMENT_ROOT}/index.php?action=prohlaseni [L,QSA]