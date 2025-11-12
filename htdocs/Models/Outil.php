<?php
class Outil
{
    private int $id_outil;
    private String $nom_outil;
    private ?String $lien_icone;
    private ?String $lien_banniere;
    private ?Array $projets;

    public function __construct(int $id_outil, String $nom_outil, ?String $lien_icone, ?String $lien_banniere, ?Array $projets = NULL)
    {
        $this->id_outil = $id_outil;
        $this->nom_outil = $nom_outil;
        $this->lien_icone = $lien_icone;
        $this->lien_banniere = $lien_banniere;
        $this->projets = $projets; //shallow copy here
    }

    public function getAllAttributes()
    {
        $all = [
            "id_outil" => $this->id_outil,
            "nom_outil" => $this->nom_outil,
            "lien_icone" => $this->lien_icone,
            "lien_banniere" => $this->lien_banniere,
            "projets" => $this->projets
        ];

        return $all;
    }

    public function getNomOutil()
    {
        return $this->nom_outil;
    }

    public function getLienIcone()
    {
        return $this->lien_icone;
    }

    public function getLienBanniere()
    {
        return $this->lien_banniere;
    }

    public function getIdOutil()
    {
        return $this->id_outil;
    }
}
?>