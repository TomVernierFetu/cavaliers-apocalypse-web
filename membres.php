<?php
    /*
     * Page de visualisation des membres du club
     * Auteur : Tom Vernier-Fétu
     */
    include("structure/header.php");
    include("utils/bdd.php");
?>

<div class="container my-5">
    <div class="d-flex align-items-center border p-3 rounded">
        <div class="flex-grow-1">
            <h1>Liste des membres du club</h1>
            <p class="m-0">
                Voici la liste des membres du club et leur classement officiel.
            </p>
        </div>
        <div>
            <a href="ajouter.php" class="btn btn-primary">Ajouter un membre</a>
        </div>
    </div>

    <?php
        // Récupération du connecteur à la base de données
        $pdo = getConnecteurBDD();

        // Récupération de l'ensemble des membres avec leur catégorie via une jointure LEFT JOIN
        $query = "SELECT m.IDFFEMEMBRE, m.NOMMEMBRE, m.PRENOMMEMBRE, m.ELOMEMBRE, m.RAPIDEMEMBRE, c.LIBELCATEGORIE 
                  FROM membre m 
                  LEFT JOIN categorie c ON m.IDCATEGORIE = c.IDCATEGORIE
                  ORDER BY m.NOMMEMBRE ASC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Tableau contenant l'ensemble des membres
        $membres = $stmt->fetchAll();
    ?>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>Identifiant FFE</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Catégorie</th>
                <th>ELO</th>
                <th>ELO Rapide</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membres as $membre) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($membre["IDFFEMEMBRE"] ?? "-"); ?></td>
                    <td><?php echo htmlspecialchars($membre["NOMMEMBRE"]); ?></td>
                    <td><?php echo htmlspecialchars($membre["PRENOMMEMBRE"]); ?></td>
                    <td><?php echo htmlspecialchars($membre["LIBELCATEGORIE"] ?? "Non définie"); ?></td>
                    <td><?php echo htmlspecialchars($membre["ELOMEMBRE"] ?? "-"); ?></td>
                    <td><?php echo htmlspecialchars($membre["RAPIDEMEMBRE"] ?? "-"); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php
    include("structure/footer.php");
?>
