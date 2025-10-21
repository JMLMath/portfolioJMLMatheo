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
?>
<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; ?>

        <article>
            <h2>Mes projets</h2>
            <p> Voici quelques uns de mes projets, ci dessous. </p>
            
            <div class="projets">
                <?php
                $requeteStr = 'SELECT * FROM projet;';
                $requete = $psqlclient->prepare($requeteStr);
                $requete->execute();
                $projets = $requete->fetchAll();
                foreach ($projets as $projet)
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

            <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
    </body>
</html>
