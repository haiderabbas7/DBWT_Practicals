#Aufgabe 6.1.b
CREATE TABLE bewertung(
                          id INT8 PRIMARY KEY AUTO_INCREMENT,
                          eingetragen_von_benutzer_id INT8 NOT NULL,
                          FOREIGN KEY (eingetragen_von_benutzer_id) REFERENCES benutzer(id),
                          zu_gericht_id INT8 NOT NULL,
                          FOREIGN KEY (zu_gericht_id) REFERENCES gericht(id),
                          bemerkung VARCHAR(300) NOT NULL,
                          sterne_bewertung VARCHAR(30) NOT NULL,
                          bewertungszeitpunkt DATETIME NOT NULL,
                          hervorgehoben BOOLEAN NOT NULL DEFAULT false
);