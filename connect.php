<?php
	include "admin/config.php";
	
	@$polaczenie = @ new mysqli($host, $db_user, $db_password, $db_name);
	
	// Ustawienie polskich znaków w bazie danych
	$polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	$polaczenie->query("SET CHARACTER_SET 'utf8_polish_ci'");