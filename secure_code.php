<?php
    $date_str = "20201116";
    $key = "awesomepassword";
	$output = system("python gen_sn.py " . $date_str . " " . $key . " encode");
?>
