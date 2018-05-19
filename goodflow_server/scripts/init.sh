#! /bin/sh
#by geniv

# startovaci skript ktery bude spousteny pri dokonceni startu pc zaroven s TS
# umisteni do: /etc/rc.local

#zapinani WOL (wake on lan)
ethtool -s eth0 wol g

#spusteni TS3 serveru
/home/gmr/dedicated/teamspeak3-server_linux-amd64/ts3server_startscript.sh start
#zakazani portu 22
/var/www/gfdesign.cz/admin/iptables.sh disable22
#zakazani portu 15178 (UPS tomcat apache)
/var/www/gfdesign.cz/admin/iptables.sh disableportfor 15178

#povoleni portu 22 a UPS portu pro nase IP
/var/www/gfdesign.cz/admin/iptables.sh enableipportfor 88.83.251.187 15178
/var/www/gfdesign.cz/admin/iptables.sh enable22for 88.83.251.187

# start UPS programu
/home/gmr/ViewPower2.11/ViewPower &

#TODO co se tyce sposteni her tak se musi spoustetr az po natazeni dat z databaze nebo jestli lip konfigu ktery bude vygenerovany na zaklade databaze
#volani skriptu na spusteni bazovych serveru
