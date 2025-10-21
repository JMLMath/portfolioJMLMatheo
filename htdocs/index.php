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

$requeteStr = 'SELECT * FROM projet;';
$requete = $psqlclient->prepare($requeteStr);
$requete->execute();
$projets = $requete->fetchAll();

?>
<html>
    <head>
        <title> Portfolio JML Mathéo </title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
        <link rel="stylesheet" href="/styles/style_first_page.css"/>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; ?>

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/static_docs/title_page.html"; ?>
        <h1>Qui suis-je ?</h1>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/static_docs/personal_presentation.html"; ?>

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
    </body>
</html>
