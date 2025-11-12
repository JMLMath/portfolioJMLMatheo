<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/Projet.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/Outil.php";

/**
 * The Data Access Object for accesing to Projets from database.
 * @author JMLMatheo <jmlmatheo-pro@outlook.com>
 * @package dao
 */
class ProjetDAO
{
    private $conn;  // contains the PDO instance
    private static $instance = null;

    private function __construct()
    {
        $this->conn = new PDO('pgsql:host=localhost;dbname=portfolio', 'phpserv', 'phpserv');
    }

    /*
    *   for getting the only one instance of DB connection
    */
    public static function getModel()
    {
        if (self::$instance === null)
        {
            self::$instance = new self(); 
        }
        return self::$instance;
    }

    /**
     * Get a Projet by id
     * @param int $id the wanted Projet's id
     * @return Projet
     */
    public function getProjetFromId(int $id)
    {
        $requete_projet_str = 'SELECT * FROM projet WHERE id_projet = :id_projet;';
        $requete_projet = $this->conn->prepare($requete_projet_str);
        $requete_projet->bindParam('id_projet', $id);
        $requete_projet->execute();
        $result = $requete_projet->fetchAll();

        // requete pour les outils associés
        $requete_outils_str = 'SELECT * FROM Outil AS O 
                                INNER JOIN Utilise_outil AS Uo USING (id_outil) 
                                WHERE Uo.id_projet = :id_projet;';
        $requete_outils = $this->conn->prepare($requete_outils_str);
        $requete_outils->bindParam('id_projet', $id);
        $requete_outils->execute();
        $outils_result = $requete_outils->fetchAll();

        // instanciate all outils
        $all_outils = [];
        foreach($outils_result as $o)
        {
            $current_outil = new Outil(
                $o['id_outil'],
                $o['nom_outil'],
                $o['lien_icone'],
                $o['lien_banniere']
            );
            $all_outils[] = $current_outil; // append to the array 
        }
        
        //creating and returning the Projet
        $projet = new Projet(
            $result[0]['id_projet'],
            $result[0]['intitule'],
            $result[0]['objectif'],
            $result[0]['nb_pers'],
            $result[0]['duree'],
            $result[0]['annee'],
            $all_outils,
        );

        return $projet;
    }

    /**
     * Get all Projets from database as array of Projet objects. 
     * @return array
     */
    public function getAllProjet()
    {
        $requete_projet_str = "SELECT * FROM Projet;";
        $requete_projet = $this->conn->prepare($requete_projet_str);
        $requete_projet->execute();
        $result = $requete_projet->fetchAll();

        //instanciate all Projet
        //adding them to an array
        $allProjet = [];
        foreach($result as $p)
        {
            $current_projet = new Projet(
                $p['id_projet'],
                $p['intitule'],
                $p['objectif'],
                $p['nb_pers'],
                $p['duree'],
                $p['annee']
            );
            $allProjet[] = $current_projet; //adding to array
        }

        return $allProjet;
    }
}
?>