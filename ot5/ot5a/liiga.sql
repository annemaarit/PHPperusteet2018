
-- jos veikkausliiga tietokanta on olemassa, se poistetaan

DROP DATABASE IF EXISTS veikkausliiga;

-- luodaan veikkausliiga tietokanta
CREATE DATABASE veikkausliiga DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;

use veikkausliiga;

-- jos taulu sarjataulukko on olemassa, se poistetaan
DROP TABLE IF EXISTS sarjataulukko;

-- luodaan sarjataulukko taulu ja sen kentät
CREATE TABLE sarjataulukko (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	joukkue VARCHAR(30) NOT NULL,
	voitot INT(3),
	tasapelit INT(3),
	tappiot INT(3),
	date TIMESTAMP
);

-- lisätään sarjataulukko tauluun tietoja
INSERT INTO sarjataulukko (joukkue,voitot,tasapelit,tappiot) 
VALUES  ('HJK',23,7,3),
('KuPS',16,8,9),
('Ilves',15,11,7),
('FC Lahti',12,13,8);