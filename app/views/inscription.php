<?php 
 
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "app/controllers/auth.php";
    
    register($_POST["username"],$_POST["password1"], $_POST["password2"], $_POST["first_name"],
    $_POST["last_name"], $_POST["born_date"], $_FILES["avatar"]);
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h2>Crée un compte</h2>

    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" placeholder="Nom d'utilisateur " name="username"  require>
            <input type="text" placeholder="Nom " name="last_name"  require>
            <input type="text" placeholder="Prénom" name="first_name" require > 
            <input type="file" placeholder="Avatar" name="avatar" require >
            <input type="date" placeholder=" Date de naissance" name="born_date" require>
            <input type="password" placeholder="Mot de passe " name="password1" require >
            <input type="password" placeholder="Confirmer mot de passe" name="password2"  require>
            <button type="submit">S'inscrire</button>
        </div>
        

        <p class="login-link">Déja un compte ? <a href="/connexion">Se connecter</a></p>
       
    </form>
    
</div>
    
</body>
</html>