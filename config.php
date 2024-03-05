<?php 
    session_start();

    function autoload($class){
        $class = str_replace('\\','/',$class);
        include('classes/'.$class.'.class.php');
    }
    spl_autoload_register('autoload');

    define('PATH','http://localhost/fitsof_projeto/');
    define('PATH_PAINEL',PATH.'painel_adm/');

    define('HOST', 'localhost');
    define('BDNAME','fitsof');
    define('USER','root');
    define('PASS','');

    date_default_timezone_set('America/Sao_Paulo');
?>