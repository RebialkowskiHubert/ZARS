DELIMITER //
CREATE PROCEDURE aktualizujMecz(IN id_druzyna1 INT, IN id_druzyna2 INT, IN id_ligaN INT, IN goleA1 INT, IN goleA2 INT, IN goleB1 INT, IN goleB2 INT)
BEGIN

DECLARE mingosp INT;
DECLARE mingosc INT;
DECLARE dodgosp INT;
DECLARE dodgosc INT;

INSERT INTO statystyki_druzyny (id_druzyna, id_liga) SELECT * FROM
(SELECT id_druzyna1 AS ID_Druzyny, id_ligaN AS ID_Ligi) AS tmp 
WHERE NOT EXISTS (SELECT id_druzyna FROM statystyki_druzyny WHERE id_druzyna = id_druzyna1 AND id_liga = id_ligaN) LIMIT 1;

INSERT INTO statystyki_druzyny (id_druzyna, id_liga) SELECT * FROM
(SELECT id_druzyna2 AS ID_Druzyny, id_ligaN AS ID_Ligi) AS tmp 
WHERE NOT EXISTS (SELECT id_druzyna FROM statystyki_druzyny WHERE id_druzyna = id_druzyna2 AND id_liga = id_ligaN) LIMIT 1;

INSERT INTO statystyki_klubu (id_statystyki_druzyny, bramki_ST, bramki_ZD, mecze, punkty)
SELECT * FROM
(SELECT 
	(SELECT id_statystyki_druzyny FROM statystyki_druzyny
		WHERE statystyki_druzyny.id_druzyna = id_druzyna1) AS id_statystyki_druzyny,
	0 AS BramkiST, 0 AS BramkiZD, 0 AS Mecze, 0 AS Punkty ) AS tmp WHERE NOT EXISTS 
(SELECT id_statystyki_druzyny FROM statystyki_klubu WHERE id_statystyki_druzyny = 
	(SELECT id_statystyki_druzyny FROM statystyki_druzyny
		WHERE statystyki_druzyny.id_druzyna = id_druzyna1 AND statystyki_druzyny.id_liga = id_ligaN)) LIMIT 1;

INSERT INTO statystyki_klubu (id_statystyki_druzyny, bramki_ST, bramki_ZD, mecze, punkty)
SELECT * FROM
(SELECT 
	(SELECT id_statystyki_druzyny FROM statystyki_druzyny
		WHERE statystyki_druzyny.id_druzyna = id_druzyna2) AS id_statystyki_druzyny,
	0 AS BramkiST, 0 AS BramkiZD, 0 AS Mecze, 0 AS Punkty ) AS tmp WHERE NOT EXISTS 
(SELECT id_statystyki_druzyny FROM statystyki_klubu WHERE id_statystyki_druzyny = 
	(SELECT id_statystyki_druzyny FROM statystyki_druzyny
		WHERE statystyki_druzyny.id_druzyna = id_druzyna2 AND statystyki_druzyny.id_liga = id_ligaN)) LIMIT 1;

IF goleA1 IS NOT NULL AND goleA2 IS NOT NULL THEN
IF goleA1 > goleA2 THEN
SET mingosp=3;
SET mingosc=0;
ELSEIF goleA1=goleA2 THEN
SET mingosp=1;
SET mingosc=1;
ELSE
SET mingosp=0;
SET mingosc=3;
END IF;

UPDATE statystyki_klubu SET bramki_ZD = bramki_ZD - goleA1, 
bramki_ST = bramki_ST - goleA2,
mecze = mecze - 1, punkty = punkty - mingosp
WHERE id_statystyki_druzyny = (SELECT statystyki_druzyny.id_statystyki_druzyny FROM statystyki_druzyny WHERE
	statystyki_druzyny.id_druzyna = id_druzyna1
	AND statystyki_druzyny.id_liga = id_ligaN);

UPDATE statystyki_klubu SET bramki_ZD = bramki_ZD - goleA2, 
bramki_ST = bramki_ST - goleA1,
mecze = mecze - 1, punkty = punkty - mingosc
WHERE id_statystyki_druzyny = (SELECT statystyki_druzyny.id_statystyki_druzyny FROM statystyki_druzyny WHERE
	statystyki_druzyny.id_druzyna = id_druzyna2
	AND statystyki_druzyny.id_liga = id_ligaN);
END IF;

IF goleB1>goleB2 THEN
SET dodgosp=3;
SET dodgosc=0;
ELSEIF goleB1=goleB2 THEN
SET dodgosp=1;
SET dodgosc=1;
ELSE
SET dodgosp=0;
SET dodgosc=3;
END IF;

UPDATE statystyki_klubu SET bramki_ZD = bramki_ZD + goleB1, 
bramki_ST = bramki_ST + goleB2,
mecze = mecze + 1, punkty = punkty + dodgosp
WHERE id_statystyki_druzyny = (SELECT statystyki_druzyny.id_statystyki_druzyny FROM statystyki_druzyny WHERE
	statystyki_druzyny.id_druzyna = id_druzyna1
	AND statystyki_druzyny.id_liga = id_ligaN);

UPDATE statystyki_klubu SET bramki_ZD = bramki_ZD + goleB2, 
bramki_ST = bramki_ST + goleB1,
mecze = mecze + 1, punkty = punkty + dodgosc
WHERE id_statystyki_druzyny = (SELECT statystyki_druzyny.id_statystyki_druzyny FROM statystyki_druzyny WHERE
	statystyki_druzyny.id_druzyna = id_druzyna2
	AND statystyki_druzyny.id_liga = id_ligaN);

END //