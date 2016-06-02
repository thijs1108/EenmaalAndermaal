use iproject21

select * from Categorieen


INSERT INTO Rubriek 
SELECT ID AS rubrieknummer,
	Name AS rubrieknaam,
	Parent AS parent,
	ID AS volgnummer
FROM Categorieen



USE iproject21
SELECT * FROM Voorwerp
INSERT INTO Voorwerp
SELECT Titel AS titel,
	Beschrijving as beschrijving,
	Prijs AS startprijs,
	'Bank/Giro' AS betalingswijzenaam,
	'unset' AS plaatsnaam,
	Locatie AS landnaam,
	10 AS looptijd,
	convert(date,getdate()) AS looptijdbeginDag,
	convert(time,getdate()) AS looptijdbeginTijdstip,
	'Anton Mijnders' AS verkopernaam,
	'12:00:00.000' AS looptijdeindeTijdstip,
	0 AS veilingGesloten
FROM Items
use master



go
use master