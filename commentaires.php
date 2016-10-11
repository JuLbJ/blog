<!DOCTYPE html>
    <html>

<head>
    <meta charset="utf-8" />
    <title>Mon blog</title>
    <link href="style.css" rel="stylesheet" />
</head>
<!--¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨ BODY ¨¨¨¨¨-->
<body>
    <h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>
<?php
    // ¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨   1. Connection à la base de données
try{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'justyna24');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
    // ¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨   2.Recuperation de billet
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();
?>

<div class = "news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>

    <p>
<?php
        echo nl2br(htmlspecialchars($donnees['contenu']));
?>
    </p>
</div>

<h2>Commentaires</h2>











</body>
</html>