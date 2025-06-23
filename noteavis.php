<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Note et Avis</title>
    <link rel="stylesheet" href="noteavis.css">
</head>

<body>

    <h1>Note et Avis</h1>

    <div class="search-container">
        <form action="/search" method="get">
            <input type="text" name="search" placeholder="Recherche...">
            <button type="submit">OK</button>
        </form>
    </div>

    <h2>Cours populaires</h2>

    <div class="scroll-container">
        <?php
        $courses = [
            ["title" => "Maths", "description" => "Cours de mathématiques générales"],
            ["title" => "Algorithmique", "description" => "Bases des algorithmes"],
            ["title" => "Java", "description" => "Programmation orientée objet avec Java"],
            ["title" => "Merise", "description" => "Modélisation des données"],
            ["title" => "Logique", "description" => "Logique mathématique et informatique"]
        ];

        foreach ($courses as $c) {
            echo '<div class="scroll-item">';
            echo '<img src="#" alt="img">';
            echo '<h3>' . htmlspecialchars($c['title']) . '</h3>';
            echo '<p>' . htmlspecialchars($c['description']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

    <h2>Enseignants populaires</h2>

    <div class="scroll-container">
        <?php
        $teachers = [
            ["name" => "Mr Romano", "specialite" => "Mathématiques"],
            ["name" => "Mr Tojo", "specialite" => "Algorithmique"],
            ["name" => "Mr Donatien", "specialite" => "Logique"],
            ["name" => "Mr Fabrice", "specialite" => "Projet Transversal"],
            ["name" => "Mr Tsinjo", "specialite" => "Java"]
        ];

        foreach ($teachers as $t) {
            echo '<div class="scroll-item teacher">';
            echo '<img src="#" alt="photo">';
            echo '<h3>' . htmlspecialchars($t['name']) . '</h3>';
            echo '<p>' . htmlspecialchars($t['specialite']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

    <h2>Donner un avis</h2>

    <form action="/submit-review" method="post">
        <div style="display: flex; gap: 10px; margin-bottom: 8px;">
            <div>
                <label for="cours">Cours</label><br>
                <select name="cours" id="cours">
                    <option value="">Aucun</option>
                    <option value="maths">Maths</option>
                    <option value="algo">Algorithmique</option>
                    <option value="java">Java</option>
                    <option value="merise">Merise</option>
                    <option value="logique">Logique</option>
                </select>
            </div>

            <div>
                <label for="enseignant">Enseignant</label><br>
                <select name="enseignant" id="enseignant">
                    <option value="">Aucun</option>
                    <option value="romano">Mr Romano</option>
                    <option value="tojo">Mr Tojo</option>
                    <option value="donatien">Mr Donatien</option>
                    <option value="fabrice">Mr Fabrice</option>
                    <option value="tsinjo">Mr Tsinjo</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="avis">Avis :</label><br>
            <textarea name="avis" id="avis" rows="5" placeholder="écrire ici..."></textarea>
        </div>

        <button type="submit">Envoyer</button>
    </form>

</body>
</html>
