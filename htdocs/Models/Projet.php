<?php
class Projet
{
    private int $id_projet;
    private String $intitule;
    private String $objectif;
    private int $nb_pers;
    private int $duree; // durée en années
    private int $annee; // année au cours duquelle projet réalisé
    private ?Array $outils;

    public function __construct(int $id_projet, String $intitule, String $objectif, int $nb_pers, int $duree, int $annee, ?Array $outils = NULL)
    {
        $this->id_projet = $id_projet;
        $this->intitule = $intitule;
        $this->objectif = $objectif;
        $this->nb_pers = $nb_pers;
        $this->duree = $duree;
        $this->annee = $annee;
        $this->outils = $outils; // shallow copy here
    }

    public function getAllAttributes()
    {
        $all = [
            "id_projet" => $this->id_projet,
            "intitule" => $this->intitule,
            "objectif" => $this->objectif,
            "nb_pers" => $this->nb_pers,
            "duree" => $this->duree,
            "annee" => $this->annee,
            "outils" => $this->outils
        ];

        return $all;
    }

    public function getIdProjet()
    {
        return $this->id_projet;
    }

    public function getIntitule()
    {
        return $this->intitule;
    }

    public function getObjectif()
    {
        return $this->objectif;
    }
}
?>