<!DOCTYPE html>
<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include "view_head.php"; ?>
    </head>
    <body>
        <?php include "view_header.php"; ?>

        <article>
            <h2>Mes projets</h2>
            <p> Voici quelques uns de mes projets, ci dessous. </p>
            
            <div class="projets">
                <?php foreach($all as $projet): //all contains all arrays of projet ?> 
                    <?php $projet_page_link = "/projet/showProjet?id=" . $projet['id_projet']; ?>
                    <section>
                        <h3> <?php echo $projet['intitule']; ?> </h3>
                        <p> <?php echo $projet['objectif']; ?> </p>
                        <p> <a href="<?php echo $projet_page_link;?>"> Pour en voir plus, cliquez ici. </a></p>
                    </section>
                <?php endforeach ?>
            </div>

            </article>

            <?php include "view_footer.php"; ?>
    </body>
</html>
