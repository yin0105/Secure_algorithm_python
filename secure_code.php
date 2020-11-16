<?php
    // $date_str = "20201116";
    // $key = "awesomepassword";
    if (isset($_GET['data']) && isset($_GET['key']) && isset($_GET['convert'])) {
        $date_str = $_GET['data'];
        $key = $_GET['key'];
        $encode = $_GET['convert'];
        system('python gen_sn.py "' . $date_str . '" "' . $key . '" ' . $encode);
    } else {
        return "Insufficient Parameters";
    }
?>
