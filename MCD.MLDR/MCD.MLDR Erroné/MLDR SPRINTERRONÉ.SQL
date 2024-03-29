DROP DATABASE IF EXISTS MLDR SprintErroné;

CREATE DATABASE IF NOT EXISTS MLDR SprintErroné;
USE MLDR SprintErroné;
# -----------------------------------------------------------------------------
#       TABLE : DIRECTEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DIRECTEUR
 (
   LOGIN CHAR(32) NOT NULL  ,
   NOM VARCHAR(128) NOT NULL  ,
   MOTDEPASSE VARCHAR(128) NOT NULL  
   , PRIMARY KEY (LOGIN) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE DIRECTEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_DIRECTEUR_MOTIF
     ON DIRECTEUR (NOM ASC);

# -----------------------------------------------------------------------------
#       TABLE : MEDECIN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MEDECIN
 (
   IDMEDECIN INTEGER(10) NOT NULL  ,
   LOGIN CHAR(32) NOT NULL  ,
   MOTDEPASSE CHAR(32) NOT NULL  ,
   NOM CHAR(32) NOT NULL  ,
   SPECIALITE CHAR(32) NOT NULL  
   , PRIMARY KEY (IDMEDECIN) 
 ) 
 comment = "";

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
   IDCOMPTE INTEGER(2) NULL  ,
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


CREATE  INDEX I_FK_PATIENT_COMPTE
     ON PATIENT (IDCOMPTE ASC);

# -----------------------------------------------------------------------------
#       TABLE : EMPLOIDUTEMPS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPLOIDUTEMPS
 (
   IDMEDECIN INTEGER(10) NOT NULL  ,
   DATE DATE NOT NULL  ,
   HEURE TIME NOT NULL  ,
   IDEDT INTEGER(2) NOT NULL  
   , PRIMARY KEY (IDEDT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE EMPLOIDUTEMPS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_EMPLOIDUTEMPS_MEDECIN
     ON EMPLOIDUTEMPS (IDMEDECIN ASC);

# -----------------------------------------------------------------------------
#       TABLE : AGENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AGENT
 (
   IDAGENT INTEGER(2) NOT NULL  ,
   NSS VARCHAR(128) NOT NULL  ,
   LOGIN CHAR(32) NOT NULL  ,
   MOTDEPASSE CHAR(32) NOT NULL  
   , PRIMARY KEY (IDAGENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE AGENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_AGENT_PATIENT
     ON AGENT (NSS ASC);

# -----------------------------------------------------------------------------
#       TABLE : COMPTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTE
 (
   SOLDE DECIMAL(10,2) NOT NULL  ,
   IDCOMPTE INTEGER(2) NOT NULL  
   , PRIMARY KEY (IDCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   IDRENDEZVOUS BIGINT(8) NOT NULL  ,
   NSS_PRENDS VARCHAR(128) NOT NULL  ,
   IDMEDECIN INTEGER(10) NULL  ,
   NOM_PRÉCISE VARCHAR(128) NOT NULL  ,
   DATE DATE NOT NULL  ,
   HEURE TIME NOT NULL  ,
   NSS VARCHAR(128) NOT NULL  ,
   ENATTENTEDEPAYEMENT BOOL NOT NULL  ,
   NOM VARCHAR(128) NULL  
   , PRIMARY KEY (IDRENDEZVOUS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RENDEZVOUS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RENDEZVOUS_PATIENT
     ON RENDEZVOUS (NSS_PRENDS ASC);

CREATE  INDEX I_FK_RENDEZVOUS_MEDECIN
     ON RENDEZVOUS (IDMEDECIN ASC);

CREATE  INDEX I_FK_RENDEZVOUS_MOTIF
     ON RENDEZVOUS (NOM_PRÉCISE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE DIRECTEUR 
  ADD FOREIGN KEY FK_DIRECTEUR_MOTIF (NOM)
      REFERENCES MOTIF (NOM) ;


ALTER TABLE PATIENT 
  ADD FOREIGN KEY FK_PATIENT_COMPTE (IDCOMPTE)
      REFERENCES COMPTE (IDCOMPTE) ;


ALTER TABLE EMPLOIDUTEMPS 
  ADD FOREIGN KEY FK_EMPLOIDUTEMPS_MEDECIN (IDMEDECIN)
      REFERENCES MEDECIN (IDMEDECIN) ;


ALTER TABLE AGENT 
  ADD FOREIGN KEY FK_AGENT_PATIENT (NSS)
      REFERENCES PATIENT (NSS) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_PATIENT (NSS_PRENDS)
      REFERENCES PATIENT (NSS) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_MEDECIN (IDMEDECIN)
      REFERENCES MEDECIN (IDMEDECIN) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_MOTIF (NOM_PRÉCISE)
      REFERENCES MOTIF (NOM) ;

