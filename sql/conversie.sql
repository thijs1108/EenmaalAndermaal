select * from Categorieen


INSERT INTO Rubriek 
SELECT ID AS rubrieknummer,
	Name AS rubrieknaam,
	Parent AS Rubriek,
	ID AS volgnummer
FROM Categorieen