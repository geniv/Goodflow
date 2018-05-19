#! /bin/bash
#by geniv

#uptime

echo "info:{w}"
w

echo "info:{sensors}"
sensors
#sensors -u

echo "info:{free}"
free -m

echo "info:{repquota}"
sudo repquota -suv /dev/mapper/isw_cghcfihjcj_Volume0p2

#echo "info:{netstat}"
#netstat -ntu
#netstat -tupan
#netstat -t

echo "info:{df}"
df -h --total

echo "info:{samba}"
smbstatus

echo "info:{lscpu}"
lscpu

echo "info:{ps}"
ps aux --sort -pcpu

echo "info:{reboot}"
last reboot