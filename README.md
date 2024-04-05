
# Projekt Wypożyczalnia Rentakar

Projekt bazy danych wypożyczalni samochodów, łączącej się ze stroną internetową, na której można zarządzać bazą.
Aby strona internetowa działała poprawnie należy umieścić ją w folderze o nazwie "wypozyczalnia" w htdocs localhost'a.

## Tabele w bazie

- pracownicy
![App Screenshot](https://i.ibb.co/CWszVTG/Screenshot-2024-03-06-182421.png)

- klienci
![App Screenshot](https://i.ibb.co/K092Wk3/Screenshot-2024-03-06-182426.png)

- samochody
![App Screenshot](https://i.ibb.co/QXr9NGX/Screenshot-2024-03-06-182431.png)

- wypożyczenia
![App Screenshot](https://i.ibb.co/hmvNzGg/shared-image.jpg)


## Struktura bazy

![App Screenshot](https://i.ibb.co/82rMvWh/68747470733a2f2f692e6962622e636f2f344d38356733432f737472756b747572612e706e67.png)


## Widoki

Baza zawiera 5 widoków

- Utwórz widok klientów (id, imie i nazwisko):
```nazwa
  CREATE VIEW wszyscy_klienci AS
      SELECT id, imie, nazwisko FROM klienci
```

- Utwórz widok kilentów urodzonych po 1999 r.:
```nazwa
  CREATE VIEW klienci_urodzeni_po_1999 AS
      SELECT * FROM klienci WHERE YEAR(data_ur) > 1999
```

- Utwórz widok długości wypozyczeń:
```nazwa
  CREATE VIEW dlugosc_wypozyczenia AS
      SELECT id, DATEDIFF(data_zwrotu, data_wypozyczenia) AS 'ilosc_dni' FROM `wypozyczenia`
```

- Utwórz widok pracowników, którzy są mężczyznami:
```nazwa
  CREATE VIEW pracownicy_mezczyzni AS
      SELECT imie, nazwisko FROM pracownicy WHERE plec = 'M'
```

- Utwórz widok, w którym połączysz imie i nazwisko (odstęp między nimi) oraz małe znaki zamienisz na duże:
```nazwa
  CREATE VIEW klienci_duzymi_literami AS
 	    SELECT UPPER(CONCAT(imie, ' ',nazwisko)) AS duze FROM klienci 
```
## Zapytania

Lista możliwych do wykonania zapytań SELECT w bazie:

- Wyświetl najstarszego pracownika:
```zapytanie
  SELECT imie, nazwisko, data_ur FROM `klienci` ORDER BY data_ur ASC LIMIT 1
```

- Wyświetl imie, nazwisko i oblicz wiek klientów: 
```zapytanie
  SELECT imie, nazwisko, YEAR(NOW()) - YEAR(data_ur) AS 'wiek' FROM `klienci`
```

- Wyświetl średni wiek pracowników: 
```zapytanie
  SELECT ROUND(AVG( YEAR(NOW()) - YEAR(data_ur))) AS 'sredni_wiek' FROM `pracownicy`
```

- Oblicz ilość dni wypozyczeń:
```zapytanie
  SELECT id, DATEDIFF(data_zwrotu, data_wypozyczenia) AS 'ilosc_dni' FROM `wypozyczenia`
```

- Wyświetl imie, nazwisko, id klienta i ilosc wypożyczeń: 
```zapytanie
  SELECT klienci_id, imie, nazwisko, COUNT(klienci_id) AS ilosc_wypozyczen FROM `wypozyczenia` AS w
INNER JOIN klienci AS k ON k.id = w.klienci_id
GROUP BY klienci_id
```

- Wyświetl imie i nazwisko pracowników jako pracownik, imie i nazwisko klientow jako klient i id wypożyczenia. Wyświetl wynik rosnąco po id wypożyczenia:
```zapytanie
  SELECT CONCAT(p.imie," ", p.nazwisko) AS pracownik , CONCAT(k.imie," ", k.nazwisko) AS klient, w.id FROM `wypozyczenia` AS w
INNER JOIN pracownicy AS p ON p.id = w.pracownicy_id
INNER JOIN klienci AS k ON k.id = w.klienci_id
ORDER BY id
```

- Wyświetl imie, nazwisko klienta, marke, model samochodu i id wypozyczenia. Wyświetl wynik malejąco po id wypozyczenia:
```zapytanie
  SELECT CONCAT(k.imie," ", k.nazwisko) AS klient, marka, model, w.id FROM `wypozyczenia` AS w
INNER JOIN klienci AS k ON k.id = w.klienci_id
INNER JOIN samochody AS s ON s.id = w.samochody_id
ORDER BY id DESC
```

- Wyświetl koszt każdego wypożyczenia nie malejaco:
```zapytanie
  SELECT w.id, (DATEDIFF(data_zwrotu, data_wypozyczenia) * cena_za_dzien) AS koszt FROM `wypozyczenia` AS w
INNER JOIN samochody AS s ON w.samochody_id=s.id
GROUP BY koszt DESC
```

- Wyświetl rok najnowszego i najstarszego samochoodu:
```zapytanie
  (SELECT rocznik FROM samochody GROUP BY rocznik DESC LIMIT 1)
UNION ALL
(SELECT rocznik FROM samochody GROUP BY rocznik ASC LIMIT 1)
```

- Wyświetl ilość znaków w mailach pracowników:
```zapytanie
  SELECT mail, CHAR_LENGTH(mail) AS znaki FROM pracownicy
```
