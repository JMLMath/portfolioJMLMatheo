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
    $errorMsg = 'ERREUR : Il n\'y a pas d\'id de projet passé en argument !';
?>
    <p> <?php echo $errorMsg; ?> </p>
<?php 
    die();

}

//recuperation des infos sur le projet
$requete_projet_str = 'SELECT * FROM projet WHERE id_projet = :id_projet;';
$requete_projet = $psqlclient->prepare($requete_projet_str);
$requete_projet->bindParam('id_projet', $_GET['id']);
$requete_projet->execute();
$projet = $requete_projet->fetchAll();

//recuperation des tâches effectuées
$requete_task_str = 'SELECT * FROM task WHERE id_projet = :id_projet;';
$requete_task = $psqlclient->prepare($requete_task_str);
$requete_task->bindParam('id_projet', $_GET['id']);
$requete_task->execute();
$task = $requete_task->fetchAll();

$requete_outil_str = 
'SELECT O.* FROM outil AS O
JOIN utilise_outil AS UO USING(id_outil)
WHERE UO.id_projet = :id_projet;';
$requete_outil = $psqlclient->prepare($requete_outil_str);
$requete_outil->bindParam('id_projet', $_GET['id']);
$requete_outil->execute();
$outil = $requete_outil->fetchAll();

//recuperation des images du projet
$requete_images_str = 
'SELECT I.position, I.lien_image
FROM Image AS I
WHERE id_projet = :id_projet
ORDER BY I.position ASC;';
$requete_images = $psqlclient->prepare($requete_images_str);
$requete_images->bindParam('id_projet', $_GET['id']);
$requete_images->execute();
$images = $requete_images->fetchAll();

?>

<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
    </head>

    <body>
        <h1> Presentation du projet </h1>
        
        <article>
            <h2> <?php echo $projet[0]['intitule']; ?> </h2>

            <div class="images_projet">
                <?php
                    if(count($images) != 0)
                    {
                        foreach($images as $i)  //printing images
                        {
                            ?>
                            <img src="<?php echo $i['lien_image'];?>">
                            <?php
                        }
                    }
                ?>
            </div>

            <div class="elements_projet">
                <section>
                    <p> Objectif du projet : <?php echo $projet[0]['objectif']; ?> </p>
                    <p> Nombre de personnes : <?php echo $projet[0]['nb_pers']; ?> </p>
                    <p> Durée : <?php echo $projet[0]['duree']; ?> h </p>
                </section>
                <section>
                    <h4> Tâches réalisées : </h4>
                    <p>
                        <ul>
                            <?php
                                foreach($task as $t)
                                {
                                    ?> 
                                    <li> <?php echo $t['task_description'];?> </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </p>
                    <h4> Outils utilisés </h4>
                    <p>
                        <ul>
                            <?php
                                foreach($outil as $o)
                                {
                                    $outil_page_link = '/outil.php?id=' . $o['id_outil'];
                                    ?>
                                    <li> <a href="<?php echo $outil_page_link;?>"> <?php echo $o['nom_outil'];?> </a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </p>
                </section>
            </div>

        </article>

        <?php
        // if images are displayed, so execute the script
        if(count($images) != 0)
        {
            ?>
            <script src="/scripts/imageSlider.js"></script>
            <?php
        }
        ?>
    </body>
</html>
