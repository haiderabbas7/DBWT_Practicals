CREATE PROCEDURE inkrementiere_anzahlanmeldungen (
    IN input_id bigint)
BEGIN
    UPDATE benutzer
    SET anzahlanmeldungen = anzahlanmeldungen + 1
    WHERE benutzer.id = input_id;
END;