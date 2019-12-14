DROP TABLE RendezVous CASCADE CONSTRAINTS;
DROP TABLE Directeur CASCADE CONSTRAINTS;
DROP TABLE Patient CASCADE CONSTRAINTS;
DROP TABLE Medecin CASCADE CONSTRAINTS;
DROP TABLE Motif CASCADE CONSTRAINTS;
DROP TABLE Compte CASCADE CONSTRAINTS;
DROP TABLE Agent CASCADE CONSTRAINTS;
# -----------------------------------------------------------------------------
#       TABLE : DIRECTEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DIRECTEUR
 (
   LOGIN CHAR(32) NOT NULL  ,
   IDMEDECIN INTEGER(10) NOT NULL  ,
   IDAGENT INTEGER(2) NOT NULL  ,
   MOTDEPASSE VARCHAR(128) NOT NULL  
   , PRIMARY KEY (LOGIN) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE DIRECTEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_DIRECTEUR_MEDECIN
     ON DIRECTEUR (IDMEDECIN ASC);

CREATE  INDEX I_FK_DIRECTEUR_AGENT
     ON DIRECTEUR (IDAGENT ASC);

# -----------------------------------------------------------------------------
#       TABLE : MEDECIN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MEDECIN
 (
   IDMEDECIN INTEGER(10) NOT NULL  ,
   IDMEDECIN_MODIFIE BIGINT(8) NOT NULL  ,
   IDRENDEZVOUS BIGINT(8) NOT NULL  ,
   LOGIN CHAR(32) NOT NULL  ,
   MOTDEPASSE CHAR(32) NOT NULL  ,
   NOM CHAR(32) NOT NULL  ,
   SPECIALITE CHAR(32) NOT NULL  
   , PRIMARY KEY (IDMEDECIN) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE MEDECIN
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_MEDECIN_EMPLOIDUTEMPS
     ON MEDECIN (IDMEDECIN_MODIFIE ASC);

CREATE UNIQUE INDEX I_FK_MEDECIN_RENDEZVOUS
     ON MEDECIN (IDRENDEZVOUS ASC);

# -----------------------------------------------------------------------------
#       TABLE : MOTIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MOTIF
 (
   NOM VARCHAR(128) NOT NULL  ,
   CONSIGNE CHAR(255) NOT NULL  ,
   PIECES CHAR(255) NOT NULL  ,
   PRIX DECIMAL(10,2) NOT NULL  
   , PRIMARY KEY (NOM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PATIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PATIENT
 (
   NSS VARCHAR(128) NOT NULL  ,
   IDAGENT INTEGER(2) NULL  ,
   NOM CHAR(32) NOT NULL  ,
   PRENOM CHAR(32) NOT NULL  ,
   ADRESSE VARCHAR(128) NOT NULL  ,
   NUMTEL INTEGER(10) NOT NULL  ,
   DATENAISSANCE DATE NOT NULL  ,
   DEPNAISSANCE INTEGER(4) NOT NULL  ,
   IDRENDEZVOUS BIGINT(8) NULL  
   , PRIMARY KEY (NSS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PATIENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PATIENT_AGENT
     ON PATIENT (IDAGENT ASC);

# -----------------------------------------------------------------------------
#       TABLE : EMPLOIDUTEMPS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPLOIDUTEMPS
 (
   IDMEDECIN BIGINT(8) NOT NULL  ,
   DATE DATE NOT NULL  ,
   HEURE TIME NOT NULL  
   , PRIMARY KEY (IDMEDECIN) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AGENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AGENT
 (
   IDAGENT INTEGER(2) NOT NULL  ,
   NOM VARCHAR(128) NOT NULL  ,
   LOGIN CHAR(32) NOT NULL  ,
   MOTDEPASSE CHAR(32) NOT NULL  
   , PRIMARY KEY (IDAGENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE AGENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_AGENT_MOTIF
     ON AGENT (NOM ASC);

# -----------------------------------------------------------------------------
#       TABLE : COMPTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTE
 (
   NSS_GÈRE VARCHAR(128) NOT NULL  ,
   SOLDE DECIMAL(10,2) NOT NULL  ,
   NSS VARCHAR(128) NOT NULL  
   , PRIMARY KEY (NSS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COMPTE
# -----------------------------------------------------------------------------


CREATE UNIQUE INDEX I_FK_COMPTE_PATIENT
     ON COMPTE (NSS_GÈRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   IDRENDEZVOUS BIGINT(8) NOT NULL  ,
   DATE DATE NOT NULL  ,
   HEURE TIME NOT NULL  ,
   NSS VARCHAR(128) NOT NULL  ,
   IDMEDECIN INTEGER(10) NOT NULL  ,
   ENATTENTEDEPAYEMENT BOOL NOT NULL  ,
   NOM VARCHAR(128) NULL  
   , PRIMARY KEY (IDRENDEZVOUS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TRAITE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TRAITE
 (
   IDAGENT INTEGER(2) NOT NULL  ,
   IDRENDEZVOUS BIGINT(8) NOT NULL  
   , PRIMARY KEY (IDAGENT,IDRENDEZVOUS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE TRAITE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_TRAITE_AGENT
     ON TRAITE (IDAGENT ASC);

CREATE  INDEX I_FK_TRAITE_RENDEZVOUS
     ON TRAITE (IDRENDEZVOUS ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE DIRECTEUR 
  ADD FOREIGN KEY FK_DIRECTEUR_MEDECIN (IDMEDECIN)
      REFERENCES MEDECIN (IDMEDECIN) ;


ALTER TABLE DIRECTEUR 
  ADD FOREIGN KEY FK_DIRECTEUR_AGENT (IDAGENT)
      REFERENCES AGENT (IDAGENT) ;


ALTER TABLE MEDECIN 
  ADD FOREIGN KEY FK_MEDECIN_EMPLOIDUTEMPS (IDMEDECIN_MODIFIE)
      REFERENCES EMPLOIDUTEMPS (IDMEDECIN) ;


ALTER TABLE MEDECIN 
  ADD FOREIGN KEY FK_MEDECIN_RENDEZVOUS (IDRENDEZVOUS)
      REFERENCES RENDEZVOUS (IDRENDEZVOUS) ;


ALTER TABLE PATIENT 
  ADD FOREIGN KEY FK_PATIENT_AGENT (IDAGENT)
      REFERENCES AGENT (IDAGENT) ;


ALTER TABLE AGENT 
  ADD FOREIGN KEY FK_AGENT_MOTIF (NOM)
      REFERENCES MOTIF (NOM) ;


ALTER TABLE COMPTE 
  ADD FOREIGN KEY FK_COMPTE_PATIENT (NSS_GÈRE)
      REFERENCES PATIENT (NSS) ;


ALTER TABLE TRAITE 
  ADD FOREIGN KEY FK_TRAITE_AGENT (IDAGENT)
      REFERENCES AGENT (IDAGENT) ;


ALTER TABLE TRAITE 
  ADD FOREIGN KEY FK_TRAITE_RENDEZVOUS (IDRENDEZVOUS)
      REFERENCES RENDEZVOUS (IDRENDEZVOUS) ;

