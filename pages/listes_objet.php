<?php
include ("../inc/functions.php");
$bdd=connect_base();
$querry= "SELECT o.nom_objet, c.nom_categorie, m.nom as proprietaire, e.date_retour 
FROM objet o JOIN categorie_objet c ON o.id_categorie = c.id_categorie 
JOIN membre m ON o.id_membre = m.id_membre LEFT JOIN emprunts e ON o.id_objet = e.id_objet";
$resultat = mysqli_query($bdd,$querry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes </title>
</head>
<body>
    <table border=1 width=500>
<tr>
    <th>Nom_objet</th>
    <th>nom_categorie</th>
    <th>proprietaire</th>
    <th>date_retour</th>
</tr>
    <?php while($row=mysqli_fetch_assoc($resultat)):?>
        <tr>
            <td><?=$row['nom_objet']?></td>
            <td><?=$row['nom_categorie']?></td>
            <td><?=$row['proprietaire']?></td>
            <td><?=$row['date_retour']?></td>
        </tr>
        <?php endwhile ?>
</table>
    
</body>
</html>