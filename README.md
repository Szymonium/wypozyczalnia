
# Projekt Wypożyczalnia Rentakar

Projekt bazy danych wypożyczalni samochodów, łączącej się ze stroną internetową, na której można zarządzać bazą.
Aby strona internetowa działała należy umieścić ją w folderze o nazwie "wypozyczalnia" w htdocs localhost'a.

## Tabele w bazie

- pracownicy
![App Screenshot](https://i.ibb.co/CWszVTG/Screenshot-2024-03-06-182421.png)

- klienci
![App Screenshot](https://i.ibb.co/K092Wk3/Screenshot-2024-03-06-182426.png)

- samochody
![App Screenshot](https://i.ibb.co/QXr9NGX/Screenshot-2024-03-06-182431.png)

- wypożyczenia
![App Screenshot](https://i.ibb.co/kxdtRvG/Screenshot-2024-03-06-182436.png)


## Struktura bazy

![App Screenshot](https://i.ibb.co/4M85g3C/struktura.png)


## Widoki

Baza zawiera x widoków

- nazwa
```nazwa
  kod zapytania w widoku
```

- nazwa
```nazwa
  kod zapytania w widoku
```
## Zapytania

Lista możliwych do wykonania zapytań SELECT w bazie:

- Wybierz najstarszego pracownika:
```zapytanie
  SELECT imie, nazwisko, data_ur FROM `klienci` ORDER BY data_ur ASC LIMIT 1
```

- Wybierz imie, nazwisko i oblicz wiek klientow: 
```zapytanie
  SELECT imie, nazwisko, YEAR(NOW()) - YEAR(data_ur) AS 'wiek' FROM `klienci`
```

- Wybierz sredni wiek pracownikow: 
```zapytanie
  SELECT ROUND(AVG( YEAR(NOW()) - YEAR(data_ur))) AS 'sredni_wiek' FROM `pracownicy`
```

- Oblicz ilosc dni wypozyczen:
```zapytanie
  SELECT id, DATEDIFF(data_zwrotu, data_wypozyczenia) AS 'ilosc_dni' FROM `wypozyczenia`
```

- Wyswietl imie, nazwisko, id klienta i ilosc wypozyczen: 
```zapytanie
  SELECT klienci_id, imie, nazwisko, COUNT(klienci_id) AS ilosc_wypozyczen FROM `wypozyczenia` AS w
INNER JOIN klienci AS k ON k.id = w.klienci_id
GROUP BY klienci_id
```

- Wyswietl imie i nazwisko pracownikow jako pracownik, imie i nazwisko klientow jako klient i id wypozyczenia.Wyswietl wynik niemalejaco po id wypozyczenia:
```zapytanie
  SELECT CONCAT(p.imie," ", p.nazwisko) AS pracownik , CONCAT(k.imie," ", k.nazwisko) AS klient, w.id FROM `wypozyczenia` AS w
INNER JOIN pracownicy AS p ON p.id = w.pracownicy_id
INNER JOIN klienci AS k ON k.id = w.klienci_id
ORDER BY id
```

- Wyswietl imie, nazwisko klienta , marke, model samochodu i id wypozyczenia. Wyswietl wynik nierosnaco po id wypozyczenia:
```zapytanie
  SELECT CONCAT(k.imie," ", k.nazwisko) AS klient, marka, model, w.id FROM `wypozyczenia` AS w
INNER JOIN klienci AS k ON k.id = w.klienci_id
INNER JOIN samochody AS s ON s.id = w.samochody_id
ORDER BY id DESC
```

- Wyswietl koszt kazdego wypozyczenia nie malejaco
```zapytanie
  SELECT w.id, (DATEDIFF(data_zwrotu, data_wypozyczenia) * cena_za_dzien) AS koszt FROM `wypozyczenia` AS w
INNER JOIN samochody AS s ON w.samochody_id=s.id
GROUP BY koszt DESC
```

- Wyswietl rok najnowszego i najstarszego samochoodu
```zapytanie
  (SELECT rocznik FROM samochody GROUP BY rocznik DESC LIMIT 1)
UNION ALL
(SELECT rocznik FROM samochody GROUP BY rocznik ASC LIMIT 1)
```

- zapytanie 
```zapytanie
  kod zapytania
```

- zapytanie 
```zapytanie
  kod zapytania
```

- zapytanie 
```zapytanie
  kod zapytania
```

- zapytanie 
```zapytanie
  kod zapytania
```

- zapytanie 
```zapytanie
  kod zapytania
```

- zapytanie 
```zapytanie
  kod zapytania
```
