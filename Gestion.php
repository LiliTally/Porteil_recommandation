<?php
$conn = new mysqli("localhost", "root", "", "portail");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_course'])) {
        $id = intval($_POST['delete_course']);
        $conn->query("DELETE FROM cours WHERE id_cours = $id");
    }
    
    if (isset($_POST['delete_enseignant'])) {
        $id = intval($_POST['delete_enseignant']);
        $conn->query("DELETE FROM enseignant WHERE id_ens = $id");
    }
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchTerm = !empty($search) ? "%".$conn->real_escape_string($search)."%" : '';

if (!empty($searchTerm)) {
    $courses = $conn->query("SELECT * FROM cours WHERE intitule_cours LIKE '$searchTerm'");
    
    $enseignants = $conn->query("SELECT e.*, c.intitule_cours 
                                FROM enseignant e 
                                LEFT JOIN cours c ON e.id_cours = c.id_cours 
                                WHERE e.nom_ens LIKE '$searchTerm'
                                OR c.intitule_cours LIKE '$searchTerm'");
} else {
    $courses = $conn->query("SELECT * FROM cours");
    $enseignants = $conn->query("SELECT e.*, c.intitule_cours 
                                FROM enseignant e 
                                LEFT JOIN cours c ON e.id_cours = c.id_cours");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GESTION ADMIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <form method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Rechercher un cours ou enseignant..." 
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Rechercher</button>
        </form>

        <?php if (!empty($search)): ?>
            <div class="search-info">
                <?php 
                $totalCourses = $courses->num_rows;
                $totalTeachers = $enseignants->num_rows;
                $totalResults = $totalCourses + $totalTeachers;
                
                if ($totalResults > 0) {
                    echo "<p>$totalResults résultat(s) contenant \"".htmlspecialchars($search)."\"</p>";
                } else {
                    echo "<p>Aucun résultat ne contient \"".htmlspecialchars($search)."\"</p>";
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="actions">
            <a href="Cours.php">➕ Ajouter un cours</a>
            <a href="Enseignants.php">➕ Ajouter un enseignant</a>
        </div>

            <h2>Liste des cours</h2>
        <div class="scrollable-table-container">
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>Intitulé</th>
                            <th>Niveau</th>
                            <th>Filière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($courses->num_rows > 0): ?>
                            <?php while($row = $courses->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['intitule_cours']) ?></td>
                                    <td><?= htmlspecialchars($row['niveau']) ?></td>
                                    <td><?= htmlspecialchars($row['filiere']) ?></td>
                                    <td>
                                        <a href="modifier_cours.php?id=<?= $row['id_cours'] ?>" class="action-link">Modifier</a> |
                                        <a href="supprimer_cours.php?id=<?= $row['id_cours'] ?>" class="action-link">Supprimer</a>
                                        <form method="POST" style="display:none;">
                                        <input type="hidden" name="delete_course" value="<?= $row['id_cours'] ?>">
                                    </form>
                                    </td>
               </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Aucun cours trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

            <h2>Liste des enseignants</h2>
        <div class="scrollable-table-container">
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Cours associé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($enseignants->num_rows > 0): ?>
                            <?php while($row = $enseignants->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nom_ens']) ?></td>
                                    <td><?= htmlspecialchars($row['intitule_cours'] ?? 'Aucun') ?></td>
                                    <td>
                                        <a href="modifier_enseignant.php?id=<?= $row['id_ens'] ?>" class="action-link">Modifier</a> |
                                        <a href="supprimer_enseignant.php?id=<?= $row['id_ens'] ?>" class="action-link">Supprimer</a>
                                        <form method="POST" style="display:none;">
                                            <input type="hidden" name="delete_enseignant" value="<?= $row['id_ens'] ?>">
                                         </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Aucun enseignant trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>