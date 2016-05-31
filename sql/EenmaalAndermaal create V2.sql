/*==============================================================*/
/* Database name:  EenmaalAndermaalCreateScript                 */
/* DBMS name:      Microsoft SQL Server 2012                    */
/* Created on:     9/5/2016 9:21:22 AM							*/
/* Creators:	   Maarten Beuzel, Thijs Beltman,				*/
/*				   Wouter Holtslag, Robin Schneiders            */
/*==============================================================*/

/*==============================================================*/
/* DATABASE: iproject21			                                */
/*==============================================================*/


USE iproject21;
GO

/*=======================================*/
/*  DELETE ALL EXISTING TABLES           */
/*=======================================*/


IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Email_validatie' )
	DROP TABLE Email_validatie
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Gebruikerstelefoon' )
	DROP TABLE Gebruikerstelefoon
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Bod' )
	DROP TABLE Bod
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Voorwerp_in_rubriek' )
	DROP TABLE Voorwerp_in_rubriek
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Rubriek' )
	DROP TABLE Rubriek
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Bestand' )
	DROP TABLE Bestand
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Feedback' )
	DROP TABLE Feedback
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Voorwerp' )
	DROP TABLE Voorwerp
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Verkoper' )
	DROP TABLE Verkoper
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Gebruiker' )
	DROP TABLE Gebruiker
IF EXISTS ( SELECT [name] FROM sys.tables WHERE [name] = 'Vraag' )
	DROP TABLE Vraag


Go
IF EXISTS (
    SELECT * FROM sysobjects WHERE id = object_id(N'GroterDanBod') 
    AND xtype IN (N'FN', N'IF', N'TF')
)
	DROP FUNCTION GroterDanBod

GO
CREATE FUNCTION [GroterDanBod](@nieuw NUMERIC(8,2))
RETURNS BIT
AS
BEGIN
	DECLARE @vorig NUMERIC(8,2);
	SET @vorig = (SELECT MAX(Bodbedrag) FROM Bod)
	IF EXISTS (SELECT 1 FROM Bod)
	BEGIN
		IF @nieuw=@vorig
		BEGIN
			RETURN 1
		END
		ELSE
		BEGIN
			RETURN 0
		END
	END
	RETURN 1
END

/*=======================================*/
/*  CREATE TABLES                        */
/*=======================================*/

/*You should try to strive to have a primary key on a table. A
PK is a special field that provides a unique identity to ech record
A PK often defines a relationship and is frequently joined on.*/

/*The Foreign Key excists in the child table. The FK in a child table
points to the PK in its parent table*/

/*Remember that the foreign key in a child table is
tied to the primary key of a parent table. Logically, we should never have a foreign key
value that does not have a corresponding primary key value.*/

Go
CREATE TABLE Email_validatie (
	email					VARCHAR(50)		NOT NULL,
	code					VARCHAR(50)		NOT NULL,
	valid_on				DATE			NOT NULL,
	CONSTRAINT PK_Email_validatie
	PRIMARY KEY (email,code,valid_on)
)

Go
CREATE TABLE Gebruiker (
	gebruikersnaam			VARCHAR(50)		NOT NULL,
	voornaam				VARCHAR(50)		NOT NULL,
	achternaam				VARCHAR(50)		NOT NULL,
	adresregel				VARCHAR(255)	NOT NULL,
	postcode				VARCHAR(7)		NOT NULL,
	plaatsnaam				VARCHAR(25)		NOT NULL,
	Land					VARCHAR(50)		NOT NULL,
	GeboorteDag				DATE			NOT NULL,
	Mailbox					VARCHAR(50)		NOT NULL,
	wachtwoord				VARCHAR(30)		NOT NULL,
	Vraag					TINYINT			NOT NULL,
	antwoordtekst			VARCHAR(255)	NOT NULL,
	Verkoper				BIT				NOT NULL,
	Valid					BIT				NOT NULL,
	CONSTRAINT PK_Gebruiker_gebruikersnaam 
	PRIMARY KEY(gebruikersnaam)
	
);


CREATE TABLE Voorwerp (
	voorwerpnummer			NUMERIC(10) IDENTITY(1,1)	NOT NULL,
	titel					VARCHAR(50)					NOT NULL,
	beschrijving			VARCHAR(5000)				NOT NULL,
	startprijs				NUMERIC(8,2)				NOT NULL,
	betalingswijzenaam		VARCHAR(10)					NOT NULL,
	betalingsinstructie		VARCHAR(30)					NULL,
	plaatsnaam				VARCHAR(25)					NOT NULL,
	landnaam				VARCHAR(50)					NOT NULL,
	looptijd				TINYINT						NOT NULL DEFAULT 7,
	looptijdbeginDag		DATE						NOT NULL,
	looptijdbeginTijdstip	TIME						NOT NULL,
	verzendkosten			NUMERIC(8,2)				NULL,
	verzendinstructies		VARCHAR(100)				NULL,
	verkopernaam			VARCHAR(50)					NOT NULL,
	kopernaam				VARCHAR(50)					NULL,
	looptijdeindeDag		AS DATEADD(day,looptijd,looptijdbeginDag),
	looptijdeindeTijdstip	TIME						NOT NULL DEFAULT convert(time,getdate()),
	veilingGesloten			BIT							NOT NULL,
	verkoopprijs			NUMERIC(8,2)				NULL,
	CONSTRAINT PK_Voorwerp_voorwerpnummer 
	PRIMARY KEY (voorwerpnummer),
	CONSTRAINT CHK_looptijd 
	CHECK (looptijd IN(1,3,5,7,10)),
	CONSTRAINT CHK_betalingswijzenaam 
	CHECK (betalingswijzenaam='Contant' OR betalingswijzenaam='Bank/Giro' OR betalingswijzenaam='Anders'),
);

CREATE TABLE Feedback (
	Voorwerp 				NUMERIC(10) NOT NULL,
	Soort_Gebruiker			BIT			NOT NULL,
	Feedbacksoort 			VARCHAR(10) NOT NULL,
	Dag						DATE	    NOT NULL,
	Tijdstip				TIME		NOT NULL,
	commentaar				VARCHAR(50) NOT NULL,
	CONSTRAINT PK_Feedback_Voorwerp_Soort_Gebruiker 
	PRIMARY KEY (Voorwerp,Soort_Gebruiker)
);

CREATE TABLE Bestand (
	filenaam 				VARCHAR(50) NOT NULL,
	Voorwerp 				NUMERIC(10) NOT NULL,
	CONSTRAINT PK_Bestand_filenaam 
	PRIMARY KEY (filenaam)
);

CREATE TABLE Rubriek (
	rubrieknummer			INT			NOT NULL,
	rubrieknaam				VARCHAR(50) NOT NULL,
	parent					INT			NULL,
	volgnr					INT			NOT NULL,
	CONSTRAINT PK_Rubriek_rubrieknummer 
	PRIMARY KEY (rubrieknummer)
);

CREATE TABLE Voorwerp_in_rubriek (
	voorwerpnummer			NUMERIC(10) NOT NULL,
	RubriekOpLaagsteNiveau	INT			NOT NULL,
	CONSTRAINT PK_VoorwerpInRubriek_Voorwerp_Rubriek 
	PRIMARY KEY (voorwerpnummer,RubriekOpLaagsteNiveau)
);

CREATE TABLE Bod (
	Voorwerp 				NUMERIC(10)	 NOT NULL,
	Bodbedrag 				NUMERIC(8,2) NOT NULL,
	Gebruiker 				VARCHAR(50)  NOT NULL,
	BodDag 					DATE		 NOT NULL,
	BodTijdstip				TIME		 NOT NULL,
	CONSTRAINT PK_Bod_Voorwerp_Bodbedrag 
	PRIMARY KEY (Voorwerp,Bodbedrag),
	CONSTRAINT CHK_Bod_hoger CHECK (dbo.GroterDanBod(Bodbedrag)=1)
);

CREATE TABLE Gebruikerstelefoon (
	volgnr					INT			NOT NULL,
	gebruikersnaam			VARCHAR(50) NOT NULL,
	Telefoon				VARCHAR(15) NOT NULL,
	CONSTRAINT PK_Gebruikerstelefoon_volgnr_Gebruiker 
	PRIMARY KEY(gebruikersnaam,volgnr)
);

CREATE TABLE Verkoper (
	Gebruiker				VARCHAR(50) NOT NULL,
	Bank					VARCHAR(25) NULL,
	Bankrekening			VARCHAR(18) NULL,
	ControleOptie			VARCHAR(25) NOT NULL,
	Creditcard				VARCHAR(30) NULL,
	CONSTRAINT PK_Verkoper_Gebruiker 
	PRIMARY KEY (Gebruiker),
	CONSTRAINT CHK_ControlePostOrCreditcard CHECK(ControleOptie = 'Post' OR ControleOptie = 'Creditcard'),
	CONSTRAINT CHK_BankOrCreditcard CHECK(Bankrekening IS NOT NULL OR Creditcard IS NOT NULL), --B3
	CONSTRAINT CHK_CreditcardFilled CHECK(ControleOptie = 'Creditcard' AND Creditcard IS NOT NULL OR ControleOptie != 'Creditcard' AND Creditcard IS NULL)--b2
);

CREATE TABLE Vraag (
	vraagnummer				TINYINT		NOT NULL,
	tekstvraag				VARCHAR(50) NULL,
	CONSTRAINT PK_Vraag_vraagnummer 
	PRIMARY KEY (vraagnummer)
);

/*=======================================*/
/*  REFERENCE TO OTHER TABLES            */
/*=======================================*/

ALTER TABLE Bestand ADD
	CONSTRAINT FK_Bestand_voorwerp_voorwerpnummer FOREIGN KEY (Voorwerp)
	REFERENCES Voorwerp(voorwerpnummer)
	ON UPDATE CASCADE
	ON DELETE CASCADE

ALTER TABLE Bod ADD
	CONSTRAINT FK_Bod_voorwerp_voorwerpnummer FOREIGN KEY (Voorwerp)
	REFERENCES Voorwerp(voorwerpnummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION,
	CONSTRAINT FK_Bod_gebruiker_gebruikersnaam FOREIGN KEY (Gebruiker)
	REFERENCES Gebruiker(gebruikersnaam)
	ON UPDATE CASCADE
	ON DELETE NO ACTION

ALTER TABLE Feedback ADD
	CONSTRAINT FK_Feedback_voorwerp_voorwerpnummer FOREIGN KEY (Voorwerp)
	REFERENCES Voorwerp(voorwerpnummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION

ALTER TABLE Gebruikerstelefoon ADD
	CONSTRAINT FK_Gebruikerstelefoon_Gebruiker_gebruikersnaam FOREIGN KEY (gebruikersnaam)
	REFERENCES Gebruiker(gebruikersnaam)
	ON UPDATE CASCADE
	ON DELETE CASCADE

ALTER TABLE Rubriek ADD
	CONSTRAINT FK_Rubriek_rubriek_rubrieknummer FOREIGN KEY (parent)
	REFERENCES Rubriek(rubrieknummer)
	ON UPDATE NO ACTION
	ON DELETE NO ACTION

ALTER TABLE Voorwerp_in_rubriek ADD
	CONSTRAINT FK_VoorwerpInRubriek_Voorwerp_voorwerpnummer FOREIGN KEY (voorwerpnummer)
	REFERENCES Voorwerp(voorwerpnummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION,
	CONSTRAINT FK_VoorwerpInRubriek_RubriekOpLaagsteNiveau_rubrieknummer FOREIGN KEY (RubriekOpLaagsteNiveau)
	REFERENCES Rubriek(rubrieknummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION

ALTER TABLE Gebruiker ADD
	CONSTRAINT FK_Gebruiker_Vraag_vraagnummer FOREIGN KEY (Vraag)
	REFERENCES Vraag(vraagnummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION

ALTER TABLE Voorwerp ADD
	CONSTRAINT FK_Voorwerp_Verkoper_Gebruiker FOREIGN KEY (verkopernaam)
	REFERENCES Verkoper(Gebruiker)
	ON UPDATE CASCADE
	ON DELETE NO ACTION,
	CONSTRAINT FK_Voorwerp_Koper_gebruikersnaam FOREIGN KEY (kopernaam)
	REFERENCES Gebruiker(gebruikersnaam)
	ON UPDATE NO ACTION
	ON DELETE NO ACTION

ALTER TABLE Verkoper ADD
	CONSTRAINT FK_Verkoper_Gebruiker_gebruikersnaam FOREIGN KEY (Gebruiker)
	REFERENCES Gebruiker(gebruikersnaam)
	ON UPDATE NO ACTION
	ON DELETE NO ACTION

/*=======================================*/
/*  CREATE TRIGGERS			             */
/*=======================================*/


--B1
Go
CREATE TRIGGER Verkoper_Gebruiker_verkoper ON Verkoper
FOR INSERT,UPDATE
AS
BEGIN
  IF EXISTS(SELECT 1 FROM Gebruiker,Verkoper WHERE Verkoper.Gebruiker = Gebruiker.gebruikersnaam AND Gebruiker.Verkoper = 0)
  BEGIN
	RAISERROR ('Verkoper staat niet als verkopende gebruiker geregistreerd!',16,1) 
	ROLLBACK
  END
END


--B4
Go
CREATE TRIGGER Max_vier_bestanden_per_voorwerp ON Bestand
FOR INSERT
AS
BEGIN
	DECLARE @ID INT
	SET @ID = (SELECT Voorwerp FROM inserted)
	IF (SELECT COUNT(*) FROM Bestand WHERE Bestand.Voorwerp=@ID)>4
	BEGIN
		RAISERROR ('Één voorwerp mag maximaal vier bestanden hebben',16,1)
		ROLLBACK
	END
END

--B5

Go
CREATE TRIGGER Minimaal_verhoging_bod ON Bod
FOR INSERT, UPDATE
AS 
BEGIN
	DECLARE @nieuw_bod NUMERIC(8,2);
	DECLARE @vorig_bod NUMERIC(8,2);
	SET @nieuw_bod = (SELECT MAX(BodBedrag) FROM Bod WHERE Bod.Voorwerp = Voorwerp)
	SET @vorig_bod = (SELECT TOP 1 Bodbedrag FROM Bod WHERE Bodbedrag NOT IN (SELECT TOP 1 Bodbedrag FROM Bod ORDER BY Bodbedrag DESC) ORDER BY Bodbedrag DESC);
	IF @vorig_bod>0.0
	BEGIN
		IF @nieuw_bod>0.99 AND @nieuw_bod > @vorig_bod --bigger than one and not first bid
		BEGIN
			IF (SELECT MAX(Bodbedrag) FROM Bod)>0.99 AND (SELECT MAX(Bodbedrag) FROM bod)<50
			BEGIN
				IF @nieuw_bod-@vorig_bod<0.50
				BEGIN
					RAISERROR ('Een bod tussen 1 en 50 Euro moet met minimaal 50 eurocent worden verhoogd',16,1);
					ROLLBACK
				END		
			END
			IF (SELECT MAX(Bodbedrag) FROM Bod)>49.99 AND (SELECT MAX(Bodbedrag) FROM bod)<500
			BEGIN
				IF @nieuw_bod-@vorig_bod<1.00
				BEGIN
					RAISERROR ('Een bod tussen 50 en 500 Euro moet met minimaal 1 euro worden verhoogd',16,1);
					ROLLBACK
				END		
			END
			IF (SELECT MAX(Bodbedrag) FROM Bod)>499.99 AND (SELECT MAX(Bodbedrag) FROM bod)<1000
			BEGIN
				IF @nieuw_bod-@vorig_bod<5.00
				BEGIN
					RAISERROR ('Een bod tussen 500 en 1000 Euro moet met minimaal 5 euro worden verhoogd',16,1);
					ROLLBACK
				END		
			END
			IF (SELECT MAX(Bodbedrag) FROM Bod)>999.99 AND (SELECT MAX(Bodbedrag) FROM bod)<5000
			BEGIN
				IF @nieuw_bod-@vorig_bod<10.00
				BEGIN
					RAISERROR ('Een bod tussen 1000 en 5000 Euro moet met minimaal 10 euro worden verhoogd',16,1);
					ROLLBACK
				END		
			END
			IF (SELECT MAX(Bodbedrag) FROM Bod)>5000
			BEGIN
				IF @nieuw_bod-@vorig_bod<50.00
				BEGIN
					RAISERROR ('Een bod vanaf 5000 Euro moet met minimaal 50 euro worden verhoogd',16,1);
					ROLLBACK
				END		
			END
		END
		ELSE
		BEGIN
			RAISERROR ('Bod is kleiner dan of gelijk aan huidige hoogste bod',16,1);
			ROLLBACK
		END
	END
END

/* BACK TO MASTER TO GET OTHER FILES WORKING*/
Go
USE master