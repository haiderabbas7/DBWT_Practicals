#Aufgabe 5.4.a
CREATE VIEW view_suppengerichte AS
SELECT * FROM gericht WHERE name LIKE '%suppe%';

#Aufgabe 5.4.b
CREATE VIEW view_anmeldungen AS
SELECT id, name, email, anzahlanmeldungen
FROM benutzer
ORDER BY anzahlanmeldungen DESC;

#Aufgabe 5.4.c
CREATE VIEW view_kategoriegerichte_vegetarisch2 AS
SELECT kategorie.name AS Kategorie, gericht.name AS Vegetarisches_Gericht
FROM kategorie
         LEFT JOIN gericht_hat_kategorie ghk ON kategorie.id = ghk.kategorie_id
         LEFT JOIN gericht ON ghk.gericht_id = gericht.id
WHERE gericht.vegetarisch = TRUE OR gericht.vegetarisch IS NULL;