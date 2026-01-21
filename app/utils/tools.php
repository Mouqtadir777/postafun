<?php
function is_authenticated(){
    session_start();
    if(isset($_SESSION["user_info"] )){

        return true ;
    }else{
        return false;
    }

}

?>