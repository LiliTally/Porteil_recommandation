<?php
$conn = new mysqli("localhost", "root", "", "portail");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

// Liste des cours pour le select
$cours = $conn->query("SELECT id_cours, intitule_cours FROM cours");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom_ens"];
    $id_cours = $_POST["id_cours"];

    $sql = "INSERT INTO enseignant (nom_ens, id_cours) VALUES ('$nom', $id_cours)";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Enseignant ajouté avec succès !";
    } else {
        $message = "❌ Erreur : " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un enseignant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Ajouter un enseignant</h2>
    <?php if ($message) echo "<p class='message'>$message</p>"; ?>

    <form method="post">
        <label>Nom de l'enseignant</label>
        <input type="text" name="nom_ens" placeholder="ex : Jean Rakoto" required>

        <label>Cours associé</label>
        <select name="id_cours" required style="height: 40px;">
            <option value="">Cours enseigné</option>
            <?php while ($row = $cours->fetch_assoc()) : ?>
                <option value="<?= $row['id_cours'] ?>">
                    <?= htmlspecialchars($row['intitule_cours']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Ajouter l'enseignant</button>
    </form>

    <a href="Gestion.php" class="back-link">⬅ Revenir à la gestion</a>
</div>
</body>
</html>
