CREATE TABLE Kanci (
  Rasa_id_r INT NOT NULL,
  id_odber INT NOT NULL,
  id_r INT UNSIGNED NULL,
  id_k INT NULL,
  linie VARCHAR(20) NULL,
  visacka VARCHAR(10) NULL,
  jmeno VARCHAR(20) NULL,
  zmasilost VARCHAR(10) NULL,
  prirustek VARCHAR(10) NULL,
  dni100 VARCHAR(10) NULL,
  spek VARCHAR(10) NULL,
  barva VARCHAR(20) NULL,
  umisteni VARCHAR(20) NULL,
  struky VARCHAR(20) NULL,
  poznamky VARCHAR(150) NULL,
  datumnarozeni DATE NULL,
  datumvstupu DATE NULL,
  mistonarozeni VARCHAR(20) NULL,
  datumvystupu DATE NULL,
  duvodvystupu VARCHAR(20) NULL,
  vyrazen BOOL NULL,
  odbery BOOL NULL,
  PRIMARY KEY(Rasa_id_r, id_odber),
  INDEX Kanci_FKIndex1(Rasa_id_r)
);

CREATE TABLE Language (
  cislo INT NOT NULL AUTO_INCREMENT,
  poznamky VARCHAR(100) NULL,
  cze VARCHAR(200) NULL,
  pol VARCHAR(200) NULL,
  PRIMARY KEY(cislo)
);

CREATE TABLE Odbery (
  id_odber INT NOT NULL AUTO_INCREMENT,
  Kanci_id_odber INT NOT NULL,
  Kanci_Rasa_id_r INT NOT NULL,
  datum DATE NULL,
  tak BOOL NULL,
  objem INT NULL,
  zle BOOL NULL,
  zleduvod VARCHAR(20) NULL,
  sdid INT NULL,
  PRIMARY KEY(id_odber, Kanci_id_odber, Kanci_Rasa_id_r),
  INDEX Odbery_FKIndex1(Kanci_id_odber, Kanci_Rasa_id_r)
);

CREATE TABLE Rasa (
  id_r INT NOT NULL,
  rasa VARCHAR(20) NULL,
  hlavcka VARCHAR(50) NULL,
  PRIMARY KEY(id_r)
);

CREATE TABLE System (
  cislo INT NOT NULL AUTO_INCREMENT,
  poznamka VARCHAR(100) NULL,
  hodnota VARCHAR(50) NULL,
  PRIMARY KEY(cislo)
);


