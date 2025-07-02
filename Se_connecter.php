<?php
$pdo= new PDO("mysql:host=localhost;dbname=projet_transversal;charset=utf8", "root", "");
$email= $_POST['email'];
$password= password_hash($_POST['password'],PASSWORD_DEFAULT);
$identifiant= $_POST['identifiant'];
$sql ="INSERT INTO projet_transversal(email,password,identifiant) VALUES(?,?,?,?)";
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
            <input type="email" name="email" placeholder="Email ou Nom d'utilisateur"/><br>
            <input type="text" name="identifiant" placeholder="Identifiant"><br>
            <input type="password" name="password" placeholder="Mot de passe"/><br>
            <button type="submit">Se connecter</button>
            <a href="S_inscrire.php">S'inscrire</a>
        </form>
    </div>
</body>
</html>