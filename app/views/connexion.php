<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
      require_once  'app/controllers/auth.php';
      login($_POST["username"]  , $_POST["password"] );

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
    <h2>connexion</h2>

    <form action="#" method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Nom d'utilisateur " required>
            <input type="password" name="password" placeholder="Mot de passe " required>
            <button type="submit">Se connecter</button>
        </div>
        

        <p class="login-link">Vous n'avez pas un compte ? <a href="/inscription">S'inscrire</a></p>
       
    </form>
    
</div>
    
</body>
</html>