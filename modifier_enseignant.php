<?php
$conn = new mysqli("localhost", "root", "", "portail");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$id = $_GET['id'];
$message = "";

// Liste des cours
$cours = $conn->query("SELECT id_cours, intitule_cours FROM cours");

// Si submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom_ens"];
    $id_cours = $_POST["id_cours"];

    $sql = "UPDATE enseignant SET nom_ens='$nom', id_cours=$id_cours WHERE id_ens=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Enseignant mis à jour !";
    } else {
        $message = "❌ Erreur : " . $conn->error;
    }
}

// Charger enseignant actuel
$sql = "SELECT * FROM enseignant WHERE id_ens=$id";
$result = $conn->query($sql);
$enseignant = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un enseignant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Modifier l'enseignant</h2>
    <?php if ($message) echo "<p class='message'>$message</p>"; ?>

    <form method="post">
        <label>Nom de l'enseignant</label>
        <input type="text" name="nom_ens" value="<?= htmlspecialchars($enseignant['nom_ens']) ?>" required>

        <label>Cours associé</label>
        <select name="id_cours" required style="height: 40px">
            <?php while ($row = $cours->fetch_assoc()) : ?>
                <option value="<?= $row['id_cours'] ?>" <?= $row['id_cours'] == $enseignant['id_cours'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['intitule_cours']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="Gestion.php" class="back-link">⬅ Revenir à la gestion</a>
</div>
</body>
</html>
