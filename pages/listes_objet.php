<?php
include ("../inc/functions.php");
$bdd=connect_base();

$categories_result = mysqli_query($bdd, "SELECT id_categorie, nom_categorie FROM categorie_objet");
$selected_category = isset($_GET['category']) ? intval($_GET['category']) : 0;

$querry= "SELECT o.nom_objet, c.nom_categorie, m.nom as proprietaire, e.date_retour 
FROM objet o JOIN categorie_objet c ON o.id_categorie = c.id_categorie 
JOIN membre m ON o.id_membre = m.id_membre LEFT JOIN emprunts e ON o.id_objet = e.id_objet";

if ($selected_category > 0) {
    $querry .= " WHERE o.id_categorie = $selected_category";
}

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
    <form method="GET" action="listes_objet.php">
        <label for="category">Filtrer par catégorie :</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="0">Toutes les catégories</option> 
            <?php while($cat = mysqli_fetch_assoc($categories_result)): ?>
                <option value="<?=$cat['id_categorie']?>" <?=($selected_category == $cat['id_categorie']) ? 'selected' : ''?>>
                    <?=$cat['nom_categorie']?>
                </option>
            <?php endwhile; ?>
        </select>
        <noscript><input type="submit" value="Filtrer"></noscript>
    </form>
    <form action="../index.php" method="post">
        <input type="submit" value="Retour" class="con">
    </form>
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
            <td><?php if(!empty($row['date_retour'])){
            echo"emprunte: " . $row['date_retour'] . ")";
            
        }else{
            echo "disponible";
        }
                ?>
                </td>
        </tr>
        <?php endwhile ?>
</table>
    
</body>
</html>
