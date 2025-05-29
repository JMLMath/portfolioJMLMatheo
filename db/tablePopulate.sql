DROP TABLE IF EXISTS Outils_tmp;
DROP TABLE IF EXISTS TachesAccomplis_tmp;
DROP TABLE IF EXISTS DescriptionSAE_tmp;

CREATE TABLE DescriptionSAE_tmp (
    description_id SERIAL PRIMARY KEY,
    codeSAE VARCHAR,
    intitule VARCHAR,
    objectif VARCHAR,
    nb_pers INTEGER,
    duree INTEGER,
    annee INTEGER
);

CREATE TABLE TachesAccomplis_tmp (
    tache_id SERIAL PRIMARY KEY,
    codeSAE VARCHAR,
    tache VARCHAR
);

CREATE TABLE Outils_tmp (
    outil_id SERIAL PRIMARY KEY,
    codeSAE VARCHAR,
    outil VARCHAR
);

\copy DescriptionSAE_tmp(codeSAE, intitule, objectif, nb_pers, duree, annee) FROM 'data/descriptionSAE.csv' WITH (format csv, header, quote '"')

\copy TachesAccomplis_tmp(codeSAE, tache) FROM 'data/tachesAccomplis.csv' WITH (format csv, header, quote '"')

\copy Outils_tmp(codeSAE, outil) FROM 'data/outils.csv' WITH (format csv, header, quote '"')

INSERT INTO Projet(intitule, objectif, nb_pers, duree, annee) 
SELECT desc_tmp.intitule, desc_tmp.objectif, desc_tmp.nb_pers, desc_tmp.duree, desc_tmp.annee
FROM DescriptionSAE_tmp AS desc_tmp;

INSERT INTO Outil(nom_outil)
SELECT DISTINCT outil 
FROM Outils_tmp;

INSERT INTO Utilise_outil(id_outil, id_projet)
SELECT O.id_outil, P.id_projet
    FROM Outils_tmp AS O_tmp
    JOIN DescriptionSAE_tmp AS D_tmp USING(codeSAE)
    JOIN Outil AS O ON O_tmp.outil = O.nom_outil
    JOIN Projet AS P USING(intitule);

INSERT INTO Task(task_description, id_projet)
SELECT DISTINCT T_tmp.tache, P.id_projet
    FROM TachesAccomplis_tmp AS T_tmp
    JOIN DescriptionSAE_tmp D_tmp USING(codeSAE)
    JOIN Projet AS P USING(intitule);

DROP TABLE IF EXISTS Outils_tmp;
DROP TABLE IF EXISTS TachesAccomplis_tmp;
DROP TABLE IF EXISTS DescriptionSAE_tmp;