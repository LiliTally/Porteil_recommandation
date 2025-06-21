<?php
$conn = new mysqli("localhost", "root", "", "portail");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $intitule = $_POST["intitule_cours"];
    $niveau = $_POST["niveau"];
    $filiere = $_POST["filiere"];

    $sql = "INSERT INTO cours (intitule_cours, niveau, filiere) VALUES ('$intitule', '$niveau', '$filiere')";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Cours ajouté avec succès !";
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
    <title>Ajouter un cours</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Ajouter un cours</h2>
    
    <?php if (!empty($message)): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="intitule_cours">Intitulé du cours</label>
            <input type="text" id="intitule_cours" name="intitule_cours" placeholder="ex : Gestion d'entreprise" required>
        </div>

        <div class="form-group">
            <label for="niveau">Niveau</label>
            <input type="text" id="niveau" name="niveau" placeholder="ex : Master 2" required>
        </div>

        <div class="form-group">
            <label for="filiere">Filière</label>
            <input type="text" id="filiere" name="filiere" placeholder="ex : BANCASS" required>
        </div>

        <button type="submit">Ajouter le cours</button>
    </form>

    <a href="Gestion.php" class="back-link">⬅ Revenir à la gestion</a>
</div>
</body>
</html>