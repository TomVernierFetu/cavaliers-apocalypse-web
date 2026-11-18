<?php
/*
 * Page d'ajout d'un nouveau membre
 * Auteur : Tom Vernier-Fétu (BTS SIO SLAM)
 */

include("structure/header.php");
include("utils/bdd.php");

$pdo = getConnecteurBDD();

// Récupération des catégories existantes pour alimenter la liste déroulante
$stmtCat = $pdo->query("SELECT IDCATEGORIE, LIBELCATEGORIE FROM categorie ORDER BY LIBELCATEGORIE ASC");
$categories = $stmtCat->fetchAll();

// Traitement du formulaire lors de la soumission
if (isset($_POST["nomMembre"]) && !empty($_POST["nomMembre"])) {
    // Nettoyage et récupération des champs
    $idffemembre = isset($_POST["idffemembre"]) && !empty($_POST["idffemembre"]) ? trim($_POST["idffemembre"]) : null;
    $nomMembre = trim($_POST["nomMembre"]);
    $prenomMembre = trim($_POST["prenomMembre"]);
    $eloMembre = !empty($_POST["eloMembre"]) ? intval($_POST["eloMembre"]) : null;
    $rapidMembre = !empty($_POST["rapidMembre"]) ? intval($_POST["rapidMembre"]) : null;
    $idCategorie = !empty($_POST["idCategorie"]) ? intval($_POST["idCategorie"]) : 1;

    // Calcul de l'ID suivant pour la table membre (ID Max + 1)
    $stmtMax = $pdo->query("SELECT COALESCE(MAX(IDMEMBRE), 0) + 1 AS nextId FROM membre");
    $nextId = $stmtMax->fetch()["nextId"];

    // Requête préparée sécurisée contre les injections SQL
    $query = "INSERT INTO membre (IDMEMBRE, IDCLUB, IDCATEGORIE, IDFFEMEMBRE, NOMMEMBRE, PRENOMMEMBRE, ELOMEMBRE, RAPIDEMEMBRE) 
              VALUES (:idmembre, :idclub, :idcategorie, :idffemembre, :nomMembre, :prenomMembre, :eloMembre, :rapidMembre)";
    $stmt = $pdo->prepare($query);

    $stmt->execute([
        "idmembre" => $nextId,
        "idclub" => 1, // Club 1 = Les Cavaliers de l'Apocalypse
        "idcategorie" => $idCategorie,
        "idffemembre" => $idffemembre,
        "nomMembre" => $nomMembre,
        "prenomMembre" => $prenomMembre,
        "eloMembre" => $eloMembre,
        "rapidMembre" => $rapidMembre
    ]);

    // Redirection vers la liste des membres après ajout réussi
    header("Location: membres.php");
    exit();
}
?>

<form method="post" action="ajouter.php">
    <div class="container my-5">
        <div class="border p-3 rounded">
            <h1>Ajouter un membre</h1>
            <p class="m-0">
                Veuillez saisir les informations concernant le nouveau membre.
            </p>
        </div>

        <div class="my-3 alert alert-warning">
            Les champs marqués d'un * sont obligatoires.
        </div>

        <div class="mt-3">
            <div class="mb-3 row">
                <label for="idffemembre" class="col-sm-2 col-form-label">Identifiant FFE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="idffemembre" name="idffemembre" placeholder="Ex: N12345">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nomMembre" class="col-sm-2 col-form-label">Nom *</label>
                <div class="col-sm-10">
                    <input type="text" required class="form-control" id="nomMembre" name="nomMembre">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="prenomMembre" class="col-sm-2 col-form-label">Prénom *</label>
                <div class="col-sm-10">
                    <input type="text" required class="form-control" id="prenomMembre" name="prenomMembre">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="idCategorie" class="col-sm-2 col-form-label">Catégorie *</label>
                <div class="col-sm-10">
                    <select required class="form-control" id="idCategorie" name="idCategorie">
                        <option value="">-- Choisir une catégorie --</option>
                        <?php foreach ($categories as $cat) { ?>
                            <option value="<?php echo $cat['IDCATEGORIE']; ?>">
                                <?php echo htmlspecialchars($cat['LIBELCATEGORIE']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="eloMembre" class="col-sm-2 col-form-label">Classement ELO</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="eloMembre" name="eloMembre" placeholder="Ex: 1500">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="rapidMembre" class="col-sm-2 col-form-label">Classement Rapide</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="rapidMembre" name="rapidMembre" placeholder="Ex: 1480">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2 text-center">
                    <button type="submit" class="btn btn-primary">Enregistrer le membre</button>
                    <a href="membres.php" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include("structure/footer.php");
?>
