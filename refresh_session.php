<?php
    session_start();
    
    // store session data
    if (isset($_SESSION['id']))
    $_SESSION['id'] = $_SESSION['id']; // or if you have any algo.
?>