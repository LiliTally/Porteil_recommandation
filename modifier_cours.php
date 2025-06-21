<?php
$conn = new mysqli("localhost", "root", "", "portail");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$id = $_GET['id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $intitule_cours = $_POST["intitule_cours"];
    $niveau = $_POST["niveau"];
    $filiere = $_POST["filiere"];

    $sql = "UPDATE cours SET intitule_cours='$intitule_cours', niveau='$niveau', filiere='$filiere' WHERE id_cours=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Cours mis à jour !";
    } else {
        $message = "❌ Erreur : " . $conn->error;
    }
}

$sql = "SELECT * FROM cours WHERE id_cours=$id";
$result = $conn->query($sql);
$cours = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier le cours</title>
</head>
<body>
<div class="form-container">
    <h2>Modifier le cours</h2>
    <?php if ($message) echo "<p class='message'>$message</p>"; ?>

    <form method="post">
        <label>Intitulé du cours</label>
        <input type="text" name="intitule_cours" value="<?= htmlspecialchars($cours['intitule_cours']) ?>" required>

        <label>Niveau</label>
        <input type="text" name="niveau" value="<?= htmlspecialchars($cours['niveau']) ?>" required>

        <label>Filière</label>
        <input type="text" name="filiere" value="<?= htmlspecialchars($cours['filiere']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="Gestion.php" class="back-link">⬅ Revenir à la gestion</a>
</div>
</body>
</html>
