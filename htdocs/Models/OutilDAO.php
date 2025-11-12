<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/Outil.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Models/Projet.php";

/**
 * The Data Access Object for accesing to Outils from database.
 * @author JMLMatheo <jmlmatheo-pro@outlook.com>
 * @package dao
 */
class OutilDAO
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
     * Get an Outil by id
     * @param int $id the wanted Outil's id
     * @return Outil
     */
    public function getOutilFromId(int $id)
    {
        $requete_outil_str = 'SELECT * FROM outil WHERE id_outil = :id_outil;';
        $requete_outil = $this->conn->prepare($requete_outil_str);
        $requete_outil->bindParam('id_outil', $id);
        $requete_outil->execute();
        $result = $requete_outil->fetchAll();

        // requete pour les projets associés
        $requete_projets_str = 'SELECT P.* FROM Projet AS P 
                                INNER JOIN Utilise_outil AS Uo USING (id_projet) 
                                WHERE Uo.id_outil = :id_outil;';
        $requete_projets = $this->conn->prepare($requete_projets_str);
        $requete_projets->bindParam('id_outil', $id);
        $requete_projets->execute();
        $projets_result = $requete_projets->fetchAll();

        // instanciate all projets
        $all_projets = [];
        foreach($projets_result as $p)
        {
            $current_projet = new Projet(
                $p['id_projet'],
                $p['intitule'],
                $p['objectif'],
                $p['nb_pers'],
                $p['duree'],
                $p['annee'],
            );
            $all_projets[] = $current_projet; // append to the array 
        }
        
        //creating and returning the Outil
        $outil = new Outil(
            $result[0]['id_outil'],
            $result[0]['nom_outil'],
            $result[0]['lien_icone'],
            $result[0]['lien_banniere'],
            $all_projets,
        );

        return $outil;
    }
}
?>