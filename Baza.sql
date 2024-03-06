CREATE TABLE samochody (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nr_rejestracyjny VARCHAR(8) NULL,
  marka VARCHAR(20) NULL,
  model VARCHAR(20) NULL,
  rocznik VARCHAR(4) NULL,
  cena_za_dzien FLOAT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE pracownicy (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  imie VARCHAR(20) NULL,
  nazwisko VARCHAR(30) NULL,
  pesel VARCHAR(11) NULL,
  plec VARCHAR(1) NULL,
  data_ur DATE NULL,
  PRIMARY KEY(id)
);

CREATE TABLE klienci (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  imie VARCHAR(20) NULL,
  nazwisko VARCHAR(30) NULL,
  pesel VARCHAR(11) NULL,
  nr_telefonu VARCHAR(9) NULL,
  data_ur DATE NULL,
  PRIMARY KEY(id)
);

CREATE TABLE wypozyczenia (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  pracownicy_id INTEGER UNSIGNED NOT NULL,
  klienci_id INTEGER UNSIGNED NOT NULL,
  samochody_id INTEGER UNSIGNED NOT NULL,
  data_wypozyczenia DATE NULL,
  data_zwrotu DATE NULL,
  kwota FLOAT NULL,
  PRIMARY KEY(id),
  INDEX wypozyczenia_FKIndex1(pracownicy_id),
  INDEX wypozyczenia_FKIndex2(klienci_id),
  INDEX wypozyczenia_FKIndex3(samochody_id),
  FOREIGN KEY(pracownicy_id)
    REFERENCES pracownicy(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(klienci_id)
    REFERENCES klienci(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(samochody_id)
    REFERENCES samochody(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


