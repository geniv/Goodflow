create database db_Zaklad;
use db_Zaklad;
create table Zamestnanec
	(ID_Zamestnanec integer not null primary key,
	 Jmeno varchar(20),
	 Prijmeni varchar(30),
	 Datum_prijeti Date,
	 Ridicsky_prukaz char(1) default 'N');
