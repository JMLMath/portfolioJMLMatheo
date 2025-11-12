<!DOCTYPE html>

<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include "view_head.php"; ?>
    </head>

    <body>
        <?php include "view_header.php"; ?>

        <h1> Presentation du projet </h1>
        
        <article>
            <h2> <?= $intitule ?> </h2>


            <div class="elements_projet">
                <section>
                    <p> Objectif du projet : <?= $objectif ?> </p>
                    <p> Nombre de personnes : <?= $nb_pers ?> </p>
                    <p> Durée : <?= $duree ?> h </p>
                </section>
                <section>
                    <h4> Tâches réalisées : </h4>
                    
                    <h4> Outils utilisés </h4>
                    <p>
                        <ul class="outils">
                            <?php foreach($outils as $o):?>
                                <?php $outil_page_link = '/outil/showOutil?id=' . $o->getIdOutil(); ?>
                                <li>
                                    <?php if($o->getLienIcone() !== NULL): ?>
                                        <img class="icone" src="/Content<?= $o->getLienIcone() ?>"/>
                                    <?php endif ?>
                                    <a href="<?= $outil_page_link ?>"> <?= $o->getNomOutil() ?> </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </p>
                    
                </section>
            </div>

        </article>

        <script src="/Content/scripts/outilsIconesManager.js"></script>
        
        <?php include "view_footer.php"; ?>
    </body>
</html>
