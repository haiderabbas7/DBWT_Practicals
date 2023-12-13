CREATE DATABASE IF NOT EXISTS emensawerbeseite
    CHARACTER SET UTF8mb4
    COLLATE  utf8mb4_unicode_ci;

USE emensawerbeseite;

CREATE TABLE gericht (
                         id INT8 PRIMARY KEY,
                         name VARCHAR(80) NOT NULL UNIQUE,
                         beschreibung VARCHAR(800) NOT NULL,
                         erfasst_am DATE NOT NULL,
                         vegan BOOLEAN NOT NULL DEFAULT FALSE,
                         vegetarisch BOOLEAN NOT NULL DEFAULT FALSE,
                         preisintern DOUBLE NOT NULL CHECK(preisintern > 0),
                         preisextern DOUBLE NOT NULL CHECK(preisintern <= preisextern)
);

CREATE TABLE allergen (
                          code CHAR(4) PRIMARY KEY,
                          name VARCHAR(300) NOT NULL,
                          typ VARCHAR(20) NOT NULL DEFAULT 'allergen'
);

CREATE TABLE kategorie (
                           id INT8 PRIMARY KEY,
                           eltern_id INT8,
                           name VARCHAR(80) NOT NULL,
                           bildname VARCHAR(200)
);

CREATE TABLE gericht_hat_allergen (
                                      code CHAR(4),
                                      gericht_id INT8 NOT NULL
);

CREATE TABLE gericht_hat_kategorie (
                                       kategorie_id INT8 NOT NULL,
                                       gericht_id INT8 NOT NULL

);

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preisintern`, `preisextern`) VALUES
                                                                                                                               (1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4),
                                                                                                                               (3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
                                                                                                                               (4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
                                                                                                                               (5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
                                                                                                                               (6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 0, 1, 2.5, 4.5),
                                                                                                                               (7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
                                                                                                                               (8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
                                                                                                                               (9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
                                                                                                                               (10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
                                                                                                                               (11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 0, 1, 2, 3),
                                                                                                                               (12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
                                                                                                                               (13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 0, 1, 2.5, 4.5),
                                                                                                                               (14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 0, 1, 3, 5),
                                                                                                                               (15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
                                                                                                                               (16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 0, 1, 1, 1.5),
                                                                                                                               (17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
                                                                                                                               (18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
                                                                                                                               (19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 0, 1, 1.25, 1.75),
                                                                                                                               (20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
                                                   ('a', 'Getreideprodukte', 'Getreide (Gluten)'),
                                                   ('a1', 'Weizen', 'Allergen'),
                                                   ('a2', 'Roggen', 'Allergen'),
                                                   ('a3', 'Gerste', 'Allergen'),
                                                   ('a4', 'Dinkel', 'Allergen'),
                                                   ('a5', 'Hafer', 'Allergen'),
                                                   ('a6', 'Dinkel', 'Allergen'),
                                                   ('b', 'Fisch', 'Allergen'),
                                                   ('c', 'Krebstiere', 'Allergen'),
                                                   ('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
                                                   ('e', 'Sellerie', 'Allergen'),
                                                   ('f', 'Milch und Laktose', 'Allergen'),
                                                   ('f1', 'Butter', 'Allergen'),
                                                   ('f2', 'Käse', 'Allergen'),
                                                   ('f3', 'Margarine', 'Allergen'),
                                                   ('g', 'Sesam', 'Allergen'),
                                                   ('h', 'Nüsse', 'Allergen'),
                                                   ('h1', 'Mandeln', 'Allergen'),
                                                   ('h2', 'Haselnüsse', 'Allergen'),
                                                   ('h3', 'Walnüsse', 'Allergen'),
                                                   ('i', 'Erdnüsse', 'Allergen');


INSERT INTO `kategorie` (`id`, `eltern_id`, `name`, `bildname`) VALUES
                                                                    (1, NULL, 'Aktionen', 'kat_aktionen.png'),
                                                                    (2, NULL, 'Menus', 'kat_menu.gif'),
                                                                    (3, 2, 'Hauptspeisen', 'kat_menu_haupt.bmp'),
                                                                    (4, 2, 'Vorspeisen', 'kat_menu_vor.svg'),
                                                                    (5, 2, 'Desserts', 'kat_menu_dessert.pic'),
                                                                    (6, 1, 'Mensastars', 'kat_stars.tif'),
                                                                    (7, 1, 'Erstiewoche', 'kat_erties.jpg');


INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
                                                              ('h', 1),
                                                              ('a3', 1),
                                                              ('a4', 1),
                                                              ('f1', 3),
                                                              ('a6', 3),
                                                              ('i', 3),
                                                              ('a3', 4),
                                                              ('f1', 4),
                                                              ('a4', 4),
                                                              ('h3', 4),
                                                              ('d', 6),
                                                              ('h1',7),
                                                              ('a2', 7),
                                                              ('h3', 7),
                                                              ('c', 7),
                                                              ('a3', 8),
                                                              ('h3', 10),
                                                              ('d', 10),
                                                              ('f', 10),
                                                              ('f2', 12),
                                                              ('h1', 12),
                                                              ('a5',12),
                                                              ('c', 1),
                                                              ('a2', 9),
                                                              ('i', 14),
                                                              ('f1', 1),
                                                              ('a1', 15),
                                                              ('a4', 15),
                                                              ('i', 15),
                                                              ('f3', 15),
                                                              ('h3', 15);

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`) VALUES
                                                                       (3, 1),	(3, 3),	(3, 4),	(3, 5),	(3, 6),	(3, 7),	(3, 9),	(4, 16), (4, 17), (4, 18), (5, 16), (5, 17), (5, 18);



SELECT COUNT(*) FROM allergen;

SELECT * FROM gericht;

SELECT name, erfasst_am FROM gericht;

SELECT name AS Gerichtname, erfasst_am FROM gericht ORDER BY Gerichtname DESC;

SELECT name, beschreibung FROM gericht ORDER BY name LIMIT 5;

SELECT name, beschreibung FROM gericht ORDER BY name LIMIT 10 OFFSET 5;

SELECT DISTINCT typ FROM allergen;

SELECT name FROM gericht WHERE name LIKE 'K%' OR name LIKE 'k%';

SELECT id, name FROM gericht WHERE name LIKE '%suppe%';

SELECT * FROM kategorie WHERE eltern_id IS NULL;

UPDATE allergen SET name = 'Kamut' WHERE code = 'a6';

INSERT INTO gericht (id, name, beschreibung, erfasst_am, vegan, vegetarisch, preisintern, preisextern)
VALUES (2, 'Currywurst mit Pommes', 'mmm yummy', '2023-11-17', 0, 0, 13.37, 13.37);

INSERT INTO gericht_hat_kategorie (kategorie_id, gericht_id) VALUES (3, 21);

CREATE TABLE ersteller(
                          ersteller_id INT8 AUTO_INCREMENT PRIMARY KEY ,
                          name VARCHAR(80) NOT NULL,
                          email VARCHAR(80) NOT NULL
);

CREATE TABLE wunschgericht(
                              nummer INT8 AUTO_INCREMENT PRIMARY KEY,
                              eingetragen_von_ersteller_id INT8 NOT NULL,
                              FOREIGN KEY (eingetragen_von_ersteller_id) REFERENCES ersteller(ersteller_id),
                              name VARCHAR(80) DEFAULT 'anonym' NOT NULL,
                              erstellungsdatum DATETIME NOT NULL,
                              beschreibung VARCHAR(300) NOT NULL
);

CREATE TABLE page_views(
    id INT AUTO_INCREMENT PRIMARY KEY,
    visit_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

UPDATE gericht SET id = 2 WHERE id = 21;

#SELECT * FROM wunschgericht LIMIT 6 OFFSET 1;

#SELECT e.ersteller_id, e.name, e.email, COUNT(w.nummer) AS anzahl_wuensche
#FROM ersteller e LEFT JOIN wunschgericht w ON e.ersteller_id = w.eingetragen_von_ersteller_id
#WHERE w.nummer > 0
#GROUP BY e.ersteller_id, e.name, e.email;


CREATE TABLE benutzer(
    id INT8 PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE ,
    passwort VARCHAR(200) NOT NULL,
    admin BOOLEAN NOT NULL,
    anzahlfehler INT NOT NULL,
    anzahlanmeldungen INT NOT NULL,
    letzteanmeldung DATETIME,
    letzterfehler DATETIME
);

INSERT INTO benutzer (id, name, email, passwort, admin, anzahlfehler, anzahlanmeldungen, letzteanmeldung, letzterfehler)
VALUES (1, 'admin', 'admin@emensa.example', '72924ce2ad839c265c32405d57278fcc36d20112', true, 0, 0, NULL, NULL);

INSERT INTO benutzer (id, name, email, passwort, admin, anzahlfehler, anzahlanmeldungen, letzteanmeldung, letzterfehler)
VALUES (2, 'ferrari', 'ferrari@fh-aachen.de', 'aaafe076c3215d5117552decf4c2132b5fa6a5be', false, 0, 0, NULL, NULL);

ALTER TABLE gericht ADD COLUMN bildname VARCHAR(200) DEFAULT NULL;

UPDATE gericht SET bildname = CONCAT(id, '.jpg');

UPDATE gericht SET bildname = '1.jpg' WHERE id = 1;
UPDATE gericht SET bildname = '3.jpg' WHERE id = 3;
UPDATE gericht SET bildname = '4.jpg' WHERE id = 4;
UPDATE gericht SET bildname = '6.jpg' WHERE id = 6;
UPDATE gericht SET bildname = '9.jpg' WHERE id = 1;
UPDATE gericht SET bildname = '10.jpg' WHERE id = 10;
UPDATE gericht SET bildname = '11.jpg' WHERE id = 11;
UPDATE gericht SET bildname = '12.jpg' WHERE id = 12;
UPDATE gericht SET bildname = '13.jpg' WHERE id = 13;
UPDATE gericht SET bildname = '15.jpg' WHERE id = 15;
UPDATE gericht SET bildname = '17.jpg' WHERE id = 17;
UPDATE gericht SET bildname = '19.jpg' WHERE id = 19;
UPDATE gericht SET bildname = '20.jpg' WHERE id = 20;



#Aufgabe 4.1
ALTER TABLE gericht_hat_kategorie ADD UNIQUE (gericht_id,kategorie_id);
SELECT * FROM gericht_hat_kategorie;

#Aufgabe 4.2
CREATE INDEX index_name ON gericht(name);

#Aufgabe 4.3
#SET FOREIGN_KEY_CHECKS=0; weil ich zu faul war das problem richtig zu lösen, ist ne idee von stackoverflow
#restlicher code unter den ALTERs ist zum Testen: Füge einen eintrag mit id 21 ein und lösche ihn aus gericht
#danach sollten die dazugehörigen einträge in den anderen zwei tabellen gelöscht werden
SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT fk_gericht_hat_kategorie_gericht_delete_cascade
        FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE;

ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT fk_gericht_hat_allergen_gericht_delete_cascade
        FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;

#INSERT INTO gericht (id, name, beschreibung, erfasst_am, vegan, vegetarisch, preisintern, preisextern)
#VALUES (21,'reis', 'mmm yummy', '2023-11-17', 0, 0, 13.37, 13.37);

#INSERT INTO gericht_hat_allergen(code, gericht_id)
#VALUES ('h3', 21);

#INSERT INTO gericht_hat_kategorie(kategorie_id, gericht_id)
#VALUES (3, 21);

#DELETE FROM gericht WHERE id = 21;


#Aufgabe 4.4, bei dem DELETE ganz unten muss ein Fehler auftreten
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT fk_gericht_hat_kategorie_kategorie_delete_no_action
        FOREIGN KEY (kategorie_id) REFERENCES kategorie(id) ON DELETE NO ACTION;

ALTER TABLE kategorie
    ADD CONSTRAINT fk_eltern_id_id_delete_no_action
        FOREIGN KEY (eltern_id) REFERENCES kategorie(id) ON DELETE NO ACTION;

#DELETE FROM kategorie WHERE id = 3;

#Aufgabe 4.5
ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT fk_gericht_hat_allergen_gericht_update_cascade
        FOREIGN KEY (code) REFERENCES allergen(code) ON UPDATE CASCADE;

#UPDATE allergen SET code = 'h33' WHERE code = 'h3';

#UPDATE allergen SET code = 'h3' WHERE code = 'h33';

#Aufgabe 4.6
ALTER TABLE gericht_hat_kategorie
    ADD PRIMARY KEY (gericht_id, kategorie_id);















