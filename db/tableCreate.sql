DROP TABLE IF EXISTS Formation;
DROP TABLE IF EXISTS Etablissement;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS Utilise_outil;
DROP TABLE IF EXISTS Outil;
DROP TABLE IF EXISTS Developper_competence;
DROP TABLE IF EXISTS Competence;
DROP TABLE IF EXISTS Projet;

CREATE TABLE Projet(
    id_projet SERIAL PRIMARY KEY,
    intitule VARCHAR,
    objectif VARCHAR,
    nb_pers INTEGER,
    duree INTEGER,
    annee INTEGER
);

CREATE TABLE Competence (
    id_competence SERIAL PRIMARY KEY,
    nom_competence VARCHAR
);

CREATE TABLE Developper_competence (
    id_projet INTEGER REFERENCES Projet(id_projet),
    id_competence INTEGER REFERENCES Competence(id_competence),
    PRIMARY KEY (id_projet, id_competence)
);

CREATE TABLE Outil (
    id_outil SERIAL PRIMARY KEY,
    nom_outil VARCHAR
);

CREATE TABLE Utilise_outil (
    id_outil INTEGER REFERENCES Outil(id_outil),
    id_projet INTEGER REFERENCES Projet(id_projet),
    PRIMARY KEY (id_outil, id_projet)
);

CREATE TABLE Image(
    id_image SERIAL PRIMARY KEY,
    lien_image VARCHAR,
    position INTEGER,
    id_projet INTEGER REFERENCES Projet(id_projet)
);

CREATE TABLE Task (
    id_task SERIAL PRIMARY KEY,
    task_description VARCHAR,
    id_projet INTEGER REFERENCES Projet(id_projet)
);

CREATE TABLE Etablissement (
    id_etablissement SERIAL PRIMARY KEY,
    nom_etablissement VARCHAR,
    adresse_etablissement VARCHAR
);

CREATE TABLE Formation (
    id_formation SERIAL PRIMARY KEY,
    nom_formation VARCHAR,
    id_etablissement INTEGER REFERENCES Etablissement(id_etablissement),
    annee INTEGER
);