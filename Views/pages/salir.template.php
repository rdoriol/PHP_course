<?php
    $_SESSION = array();
    
    session_destroy();

    header("location: index.php?pages=ingreso");
