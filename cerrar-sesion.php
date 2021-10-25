<?php
    session_start();//siempre que se quiera traer informacion  de la session del usuario se debe iniciar la session
    $_SESSION = [];

    header('Location: /')
?>