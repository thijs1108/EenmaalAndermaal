use iproject21

select * from Categorieen


INSERT INTO Rubriek 
SELECT ID AS rubrieknummer,
	Name AS rubrieknaam,
	Parent AS parent,
	ID AS volgnummer
FROM Categorieen

use iproject21
--selecteer alle onderste rubrieken
SELECT * FROM Rubriek WHERE rubrieknummer NOT IN (Select rubrieknummer FROM Rubriek where rubrieknummer IN (SELECT parent FROM Rubriek))
go
use master