<?php 

    include('../config.php');

    if(isset($_GET['logout'])){
        
        painel::logout();
        header('Location:'.PATH_PAINEL);
    }else{

        if(painel::login()){
            include('painel.php');
        }else{
            include('login.php');
        }
    }

?>