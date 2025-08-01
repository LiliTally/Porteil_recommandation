<?php
$conn = new mysqli("localhost", "root", "", "portail");
$id = $_GET['id'];

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['confirmer']) && $_POST['confirmer'] === "Oui") {
        $conn->query("DELETE FROM cours WHERE id_cours=$id");
        $conn->close();
        header("Location: Gestion.php");
        exit;
    } else {
        header("Location: Gestion.php");
        exit;
    }
}

$sql = "SELECT intitule_cours FROM cours WHERE id_cours=$id";
$result = $conn->query($sql);
$cours = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un enseignant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Confirmer la suppression</h2>
    <p>Voulez-vous vraiment supprimer le cous <strong><?= htmlspecialchars($cours['intitule_cours']) ?></strong> ?</p>

    <form method="post">
        <button type="submit" name="confirmer" value="Oui">✅ Oui, supprimer</button>
        <button type="submit" name="confirmer" value="Non">❌ Non, annuler</button>
    </form>

    <a href="Gestion.php" class="back-link">⬅ Retour sans supprimer</a>
</div>
</body>
</html>
