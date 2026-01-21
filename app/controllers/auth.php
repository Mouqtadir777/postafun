<?php 



function register($username , $password1, $password2, $first_name, $last_name, $born_date, $avatar){
    if (isset($username ) && !empty($username) && isset($password1) && ! empty($password1)
        && isset($password2) && ! empty($password2) && isset($first_name) && ! empty($first_name)
        && isset($last_name) && ! empty($last_name)&& isset($born_date) && ! empty($born_date)
        && isset($avatar) && ! empty($avatar)){

            if($password1 === $password2){
        
                require "app/models/user.php";

                if (!user_exits($username)){
                   try {
                    create_user($username, password_hash($password1, PASSWORD_ARGON2I));
                    $user = fetch_user($username);
                    
                    require "app/models/profil.php";
                    create_profil($user["id"] , "", $born_date, $first_name, $last_name);
                    echo "<script>alert('Féllicitation votre a été crée avec succès ')</script>";

                   }
                   catch (Exception $e ) {
                     echo "<script>alert('Une erreur est survenu lors de  la création de votre compte \n ".$e." ')</script>";

                   }
                }else{
                    echo "<script>alert('Erreur ce nom d\'utilisateur est déja utilisé ')</script>";
                }

            }else{
                 echo "<script>alert('Erreur les mots de passes ne sont pas identiques ')</script>";

            }


        

    }else{
        echo "<script>alert('Erreur Tout les  champs sont requis ')</script>";
    }
}


function login($username, $password){
    if( isset($username ) && !empty($username) && isset($password ) && !empty($password) ){

        require "app/models/user.php";
        $user = fetch_user($username);
        if($user){

            
            if(password_verify($password, $user["password"])){
                
                require "app/models/profil.php";

                $profil = fetch_profil($user["id"]);
                session_start();
                $user_info = array("username"=>$username, "first_name"=>$profil["first_name"], 
                "last_name"=>$profil["last_name"], "avatar"=>$profil["avatar"]);

                $_SESSION["user_info"]= $user_info;
                update_last_login($username);
                header("location:/");





                 echo "<script>alert(' Soyer les bienvenues dans votre espace blog personnel  ')</script>";

            }else{

                 echo "<script>alert('Erreur le nom d\'utilisateur ou le mot de passe est incorrect ')</script>";

            }

        }else{
             echo "<script>alert('Erreur le nom d\'utilisateur ou le mot de passe est incorrect ')</script>";

        }
        

    }else{
         
        echo "<script>alert('Erreur Tout les  champs sont requis ')</script>";
    }

}
function logout(){
    session_start();
    session_destroy();
    session_abort();
    header("location: /connexion");

}

?>