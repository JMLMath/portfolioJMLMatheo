<!DOCTYPE html>

<?php
try
{
    $psqlclient = new PDO('pgsql:host=localhost;dbname=portfolio', 'phpserv', 'phpserv'); 
}
catch (Exception $e)
{
    die('ERREUR : ' . $e->getMessage()); // arrete execution du programme
}

if (!isset($_GET['id'])) // verification qu'il y a bien un id de projet en argument
{
    $errorMsg = 'ERREUR : Il n\'y a pas d\'id d\'outil passé en argument !';
?>
    <p> <?php echo $errorMsg; ?> </p>
<?php 
    die();

}

//recuperation de l'outil
$requete_outil_str = 'SELECT nom_outil FROM outil WHERE id_outil = :id_outil;';
$requete_outil = $psqlclient->prepare($requete_outil_str);
$requete_outil->bindParam('id_outil', $_GET['id']);
$requete_outil->execute();
$outil = $requete_outil->fetchAll();

//recuperation des projets utilisant l'outil
$requete_projets_str = 
'SELECT P.* FROM projet AS P
JOIN utilise_outil AS UO USING(id_projet)
WHERE UO.id_outil = :id_outil;';
$requete_projets = $psqlclient->prepare($requete_projets_str);
$requete_projets->bindParam('id_outil', $_GET['id']);
$requete_projets->execute();
$projets = $requete_projets->fetchAll();

?>

<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
    </head>

    <body>
        <h1> Projets utilisant l'outil </h1>

        <article>
            <h2> Outil <?php echo $outil[0]['nom_outil'];?> </h2>
            <p> Voici les projets que j'ai réalisé à l'aide de <?php echo $outil[0]['nom_outil'];?> </p>
            <div class="projets">
                <?php
                    foreach($projets as $projet)
                    {
                        $projet_page_link = '/projet.php?id=' . $projet['id_projet'];
                        ?>
                        <section>
                        <h3> <?php echo $projet['intitule']; ?> </h3>
                        <p> <?php echo $projet['objectif']; ?> </p>
                        <p> <a href="<?php echo $projet_page_link;?>"> Pour en voir plus, cliquez ici. </a></p>
                        </section>
                        <?php
                    }
                ?>
            </div>
        </article>
               
    </body>
</html>
