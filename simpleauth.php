<?php

require_once('getParam.php');

if(!defined('AUTH_SESSION_NAME')){
    $dirKey = md5($_SERVER['PATH_TRANSLATED']);
    define('AUTH_SESSION_NAME', "auth_$dirKey");
}

if(!defined('AUTH_SESSION_PASSWORD')){
    define('AUTH_SESSION_PASSWORD', uniqid());
}

if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

$auth = getArraySafe($_SESSION, AUTH_SESSION_NAME, false);

if($auth!==true){
    $pass = getParam('pass');

    if($pass == AUTH_SESSION_PASSWORD){
        $_SESSION[AUTH_SESSION_NAME] = true;
        unset($_REQUEST['pass']);
        unset($_GET['pass']);
    }else{
?>
        <form method="post">
            <input type="password" id="pass" name="pass"></input>
            <input type="submit" id="submit" name="submit" value="submit"></input>
        </form>
<?php
        exit;
    }
    
}

?>