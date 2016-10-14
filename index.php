<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
    <link rel="stylesheet" href="style.css" >
    </head>
    <body>
        <h1>Mon super blog !</h1>
        <p>Dernièrs billets du blog : </p>

<?php
// *******************   1. Connection à la base de donnees
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'justyna24');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// *******************   2. On récupère 5 dérniers billet

$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch()) {
    ?>
    <div class="news">
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
            <h3>

                <p>
                    <?php
                    // *******************   3_1. On affiche le contenu du billet
                    echo nl2br(htmlspecialchars($donnees['contenu']));
                    ?>
                    <br/>
                    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a>
                    </em>
                </p>
    </div>
    <?php
} // *******************   3_2. Fin de la boucle des billets

$req->closeCursor();
?>
</body>
</html>

