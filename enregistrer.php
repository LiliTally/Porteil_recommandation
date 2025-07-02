<?php
    $host="localhost";
    $dbname="";
    $user="root";
    $pass="";
    try{
        $pdo=new PDO("mysql:host=localhost;dbname=projet_tranversal;charset=utf8");
    }catch(PDOException $e){
        die("Erreur de connection:".$e->getMessage());
    }
if(!empty($_POST['email']) && ! empty($_POST['password']) && ! empty($_POST['username']) && ! empty($_POST['identifiant'])){
    $email=$_POST['email'];
    $username=$_POST['username'];
    $identifiant=$_POST['identifiant'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $stmt=$pdo->prepare("INSERT INTO comptes(email,username,identifiant,password) VALUES(?,?,?,?)");
    try{
        $stmt->excute([$email,$username,$identifiant,$password]);
    }catch(PDOExpection $e){
        if($e->getCode()== 23000){
            echo"Ce nom d'utilisateur existe déja.";
        }else{
            echo"Ereur: ".$e->getMessage();
        }
    }
}else{
    echo"Veuillez remplir tous les champs."; 
}
?>