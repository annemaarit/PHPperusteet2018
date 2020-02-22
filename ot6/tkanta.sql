-- Maarit Parkkonen, 27.8.2018, oth6

-- jos tahtitieteilijat tietokanta on olemassa, se poistetaan
DROP DATABASE IF EXISTS tahtitieteilijat;

-- luodaan tahtitieteilijat tietokanta
CREATE DATABASE tahtitieteilijat DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;

use tahtitieteilijat;

-- jos taulu kayttajat on olemassa, se poistetaan
DROP TABLE IF EXISTS kayttajat;

-- luodaan kayttajat taulu ja sen kentät
CREATE TABLE kayttajat (
	tunnus VARCHAR(30) NOT NULL PRIMARY KEY,
	salasana VARCHAR(100) NOT NULL
);
