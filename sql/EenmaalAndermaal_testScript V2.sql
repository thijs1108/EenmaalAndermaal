USE Iproject21
go

INSERT INTO Vraag VALUES (1,'Wat was u eerste baan?')
INSERT INTO Vraag VALUES (2,'Hoe heette u eerste huisdier?')
INSERT INTO Vraag VALUES (3,'Wat is de meisjesnaam je moeder?')
INSERT INTO Vraag VALUES (4,'Wat is je lievelingsgerecht?')
INSERT INTO Vraag VALUES (5,'Waar bent u geboren?')

INSERT INTO Gebruiker VALUES ('JanPiet','Jan','Piet','Test van de groot straat 12', '1478 DF', 'Steenderen','Nederland','1999-10-20', 'test@beuzelbeuzel.com', '12345989',5,'Ik ben geboren hier',1,1)
INSERT INTO Gebruiker VALUES ('Henk','Henk','de tweede','De klein straat 12', '1478 DF', 'Steenderen','Nederland','1999-10-20', 'test@beuzelbeuzel.com', '12345989',1,'Bij de albert heijn',0,1)



INSERT INTO Verkoper VALUES ('JanPiet','ING','NLINGB00012345678','Post',NULL)




INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Asus','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',1.99,'Bank/Giro','Arnhem','Nederland',DEFAULT,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Lenovo','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',2.99,'Bank/Giro','Arnhem','Nederland',5,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Laptop Apple','Deze laptop voldoet niet meer aan mijn eisen daarom bied ik het bij deze aan.',6.99,'Bank/Giro','Arnhem','Nederland',7,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank zwart','Deze bank past niet meer bij mijn huis.',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank groen','Afgelopen winter is mijn huis gekropen en nu past de bank niet meer.',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank geel','Last van geelzucht',9.99,'Bank/Giro','Arnhem','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)
INSERT INTO Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('Bank donkerwit (a.k.a. zwart)','Het is de schuld van de Rabobank!!!!!!!11111!!!!',9.99,'Bank/Giro','Schilderswijk','Nederland',10,convert(date,getdate()),convert(time,getdate()),'JanPiet','12:00:00.000',0)

go
INSERT INTO Voorwerp_in_rubriek VALUES (1,28837)

/*
SELECT titel,looptijdeindeTijdstip FROM Voorwerp GROUP BY titel,looptijdeindeTijdstip
SELECT TOP 1 * FROM Voorwerp LEFT OUTER JOIN Bod on Voorwerp.voorwerpnummer= Bod.Voorwerp WHERE voorwerpnummer =1 ORDER BY Bodbedrag DESC
*/

INSERT INTO Bod VALUES (1,1.99,'Henk','2016-05-13','09:05:16.123')
INSERT INTO Bod VALUES (1,2.99,'Henk','2016-05-13','09:19:45.452')
INSERT INTO Bod VALUES (1,5.99,'Henk','2016-05-13','09:31:22.332')
INSERT INTO Bod VALUES (1,7.99,'Henk','2016-05-13','09:40:54.775')
INSERT INTO Bod VALUES (1,9.99,'Henk','2016-05-13','09:54:12.788')

INSERT INTO Bestand VALUES ('hoi1.jpg',1);
INSERT INTO Bestand VALUES ('hoi2.jpg',1);
INSERT INTO Bestand VALUES ('hoi3.jpg',1);
INSERT INTO Bestand VALUES ('hoi4.jpg',1);
INSERT INTO Bestand VALUES ('hoi5.jpg',2);
/*
SELECT * FROM Gebruiker LEFT OUTER JOIN Vraag ON Vraag= vraagnummer
SELECT * FROM Voorwerp LEFT OUTER JOIN Bod on Voorwerp.voorwerpnummer= Bod.Voorwerp WHERE voorwerpnummer =1

SELECT * FROM Gebruiker LEFT OUTER JOIN Voorwerp ON Gebruiker.gebruikersnaam=Voorwerp.verkopernaam

SELECT * FROM Bestand
SELECT * FROM Bod
SELECT * FROM Feedback
SELECT * FROM Gebruiker
SELECT * FROM Gebruikerstelefoon
SELECT * FROM Rubriek
SELECT * FROM Verkoper
SELECT * FROM Voorwerp
SELECT * FROM VoorwerpInRubriek
SELECT * FROM Vraag
*/

USE master
