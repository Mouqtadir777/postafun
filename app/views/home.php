<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>PostaFun</title>
</head>

<body>
    <div class="navigation">
        <h3>PostaFun</h3>
        <nav class="navbar">
            
            <?php 
              require "app/utils/tools.php";
              if( is_authenticated()){
                $user = $_SESSION["user_info"];
                $first_name = $user["first_name"];
                $last_name = $user["last_name"];
                $avatar = $user["avatar"];
                $username = $user["username"];
                echo <<<HTML
                <ul>
                    <li>
                        <a href="/profil?u=$username">$first_name $last_name</a>
                    </li>
                    <li>
                        <a href="/logout">Deconnexion</a>
                    </li>
                </ul>
                HTML;
              }else{
                echo <<<HTML
                <ul>
                    <li>
                        <a href="/inscription">Inscription</a>
                    </li>
                    <li>
                        <a href="/connexion">Connexion</a>
                    </li>
                </ul>
              HTML;
              }
            ?>
             
        </nav>
    </div>

</body>

</html>