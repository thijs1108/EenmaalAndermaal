use iproject21

INSERT INTO Rubriek 
SELECT ID AS rubrieknummer,
	Name AS rubrieknaam,
	Parent AS parent,
	ID AS volgnummer
FROM Categorieen

INSERT INTO Vraag VALUES (1,'Wat was u eerste baan?')
INSERT INTO Vraag VALUES (2,'Hoe heette u eerste huisdier?')
INSERT INTO Vraag VALUES (3,'Wat is de meisjesnaam je moeder?')
INSERT INTO Vraag VALUES (4,'Wat is je lievelingsgerecht?')
INSERT INTO Vraag VALUES (5,'Waar bent u geboren?')

INSERT INTO Gebruiker VALUES ('JanPiet','Jan','Piet','Test van de groot straat 12', '1478 DF', 'Steenderen','Nederland','1999-10-20', 'test@beuzelbeuzel.com', '12345989',5,'Ik ben geboren hier',1,1)
INSERT INTO Gebruiker VALUES ('Henk','Henk','de tweede','De klein straat 12', '1478 DF', 'Steenderen','Nederland','1999-10-20', 'thijs.beltman@gmail.com', '12345989',1,'Bij de albert heijn',0,1)
INSERT INTO Verkoper VALUES ('JanPiet','ING','NLINGB00012345678','Post',NULL)
INSERT INTO Gebruiker VALUES ('Anton Mijnders','Anton','Mijnders','De klein straat 12', '1478 DF', 'Steenderen','Nederland','1999-10-20', 'test@beuzelbeuzel.com', '12345989',1,'Bij de albert heijn',1,1)
INSERT INTO Verkoper VALUES ('Anton Mijnders','ING','NLINGB00012345678','Post',NULL)

INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Asus','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',1.99,'Bank/Giro','Arnhem','Nederland',DEFAULT,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
UPDATE Voorwerp SET looptijdbeginDag = '2016-05-30', looptijdeindeTijdstip='13:00' WHERE voorwerpnummer =1
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Lenovo','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',2.99,'Bank/Giro','Arnhem','Nederland',5,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Apple','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',6.99,'Bank/Giro','Arnhem','Nederland',7,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank zwart','Deze bank past niet meer bij mijn huis.',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank groen','Afgelopen winter is mijn huis gekropen en nu past de bank niet meer.',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank geel','Last van geelzucht',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank donkerwit (a.k.a. zwart)','Het is de schuld van de Rabobank!!!!!!!11111!!!!',9.99,'Bank/Giro','Schilderswijk','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)

go
INSERT INTO Voorwerp_in_rubriek VALUES (1,28837)

INSERT INTO Bod VALUES (1,1.99,'JanPiet','2016-05-13','09:05:16.123')
INSERT INTO Bod VALUES (1,2.99,'Henk','2016-05-13','09:19:45.452')
INSERT INTO Bod VALUES (1,5.99,'Henk','2016-05-13','09:31:22.332')
INSERT INTO Bod VALUES (1,7.99,'Henk','2016-05-13','09:40:54.775')
INSERT INTO Bod VALUES (2,8.99,'Henk','2016-05-13','09:40:54.775')
INSERT INTO Bod VALUES (2,11.99,'Henk','2016-05-13','09:40:54.775')
INSERT INTO Bod VALUES (1,13.99,'Henk','2016-05-13','09:40:54.775')
INSERT INTO Bod VALUES (2,15.99,'Henk','2016-05-13','09:54:12.788')


INSERT INTO Bestand VALUES ('hoi1.jpg',1);
INSERT INTO Bestand VALUES ('hoi2.jpg',1);
INSERT INTO Bestand VALUES ('hoi3.jpg',1);
INSERT INTO Bestand VALUES ('hoi4.jpg',1);
INSERT INTO Bestand VALUES ('hoi5.jpg',2);

SET IDENTITY_INSERT Voorwerp ON
USE iproject21
INSERT INTO Voorwerp (voorwerpnummer,titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten)
SELECT ID as voorwerpnummer,
	SUBSTRING(Titel,0,199) AS titel,
	SUBSTRING(Beschrijving,0,7999) as beschrijving,
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

USE iproject21
INSERT INTO Bestand
SELECT 'pics/' + IllustratieFile AS filenaam,
	ItemID as Voorwerp
FROM Illustraties
INNER JOIN Voorwerp 
ON Voorwerp.voorwerpnummer = ItemID
use master


go
use master