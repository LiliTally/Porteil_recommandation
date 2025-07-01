<?php
$pdo= new PDO("mysql:host=localhost;dbname=projet_transversal;charset=utf8", "root", "");
$email= $_POST['email'];
$password= password_hash($_POST['password'],PASSWORD_DEFAULT);
$nom_etudiant= $_POST['username'];
$identifiant= $_POST['identifiant'];
$sql ="INSERT INTO projet_transversal(email,password,username,identifiant) VALUES(?,?,?,?)";
$stmt=$pdo-> prepare($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="container">
        <form action="enregistrer.php">
            <input type="email" name="email" placeholder="Email"/><br>
            <input type="password" name="password" placeholder="Mot de passe"/><br>
            <input type="text" name="username" placeholder="Nom d'utilisateur"><br>
            <input type="text" name="identifiant" placeholder="Identifiant"><br>
            <button type="submit">S'inscrire</button>
            <a href="Se_connecter.php">Se connecter</a>
        </form>
    </div>

</body>
</html>