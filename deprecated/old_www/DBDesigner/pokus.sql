CREATE TABLE Kanci (
  id_odber VARCHAR(10) NOT NULL,
  Rasa_id_r INT NOT NULL,
  id_k INT NULL,
  id_r INT NULL,
  linie VARCHAR(20) NULL,
  visacka VARCHAR(10) NULL,
  jmeno VARCHAR(20) NULL,
  zmasilost VARCHAR(10) NULL,
  prirustek VARCHAR(10) NULL,
  dni100 VARCHAR(10) NULL,
  spek VARCHAR(10) NULL,
  barva VARCHAR(20) NULL,
  umisteni VARCHAR(10) NULL,
  struky VARCHAR(20) NULL,
  poznamky VARCHAR(150) NULL,
  datumnarozeni DATE NULL,
  datumvstupu DATE NULL,
  mistonarozeni VARCHAR(20) NULL,
  odbery BOOL NULL,
  PRIMARY KEY(id_odber, Rasa_id_r),
  INDEX Kanci_FKIndex1(Rasa_id_r)
);

CREATE TABLE Language (
  cislo INT NOT NULL AUTO_INCREMENT,
  poznamky VARCHAR(100) NULL,
  cze VARCHAR(200) NULL,
  pol VARCHAR(200) NULL,
  eng VARCHAR(200) NULL,
  PRIMARY KEY(cislo)
);

CREATE TABLE Odbery (
  id_odber VARCHAR(10) NOT NULL AUTO_INCREMENT,
  Kanci_id_odber VARCHAR(10) NOT NULL,
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
  id_r INT NOT NULL AUTO_INCREMENT,
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


