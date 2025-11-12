<!DOCTYPE html>

<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include "view_head.php"; ?>
    </head>

    <body>
        <?php include "view_header.php"; ?>

        <?php if($lien_banniere !== NULL): ?>
            <?php $lien_banniere = '/Content' . $lien_banniere; ?>
            <img class="banniere" src="<?= $lien_banniere ?>"/>
        <?php endif ?>
        
        <article>
            <h1>Projets utilisants <?= $nom_outil ?></h1>
            <p>Voici les projets que j'ai réalisés à l'aide de <?= $nom_outil ?></p>
            <div class="projets">
                <?php foreach($projets as $p): ?>
                    <?php $projet_page_link = '/projet/showProjet?id=' . $p->getIdProjet(); ?>
                    <section>
                        <h3><?= $p->getIntitule() ?></h3>
                        <p><?= $p->getObjectif() ?></p>
                        <p> <a href="<?= $projet_page_link ?>">Pour en voir plus, cliquez ici. </a></p>
                    </section>
                <?php endforeach ?>
            </div>
        </article>

        <?php include "view_footer.php"; ?>
    </body>
</html>
