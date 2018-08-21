<?php

/**
	**********************************************************************
	**	Strona główna aplikacji magazynowej. Projekt wykonany w Bootsrap 4
	**********************************************************************
	**
	**	1. Uruchomienie sesji
	**	2. Sprawdzenie czy użytkownik jest zalogowany
	**	3. Załadowanie nagłówka z pliku header.php
	**	4. Wyświetlenie treści powitania strony startowej
	**	5. Załadowanie stopki z pliku footer.php
	**
	**********************************************************************
*/

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header ('Location: admin/zalogowany.php');
		exit();
	}
	
	require ('sekcja_head.php');
	require ('header.php');

//	Treść powitania na stronie głównej
	echo '<div class="m-auto text-center">
			<h4>Witaj w aplikacji gospodarki odpadami</h4>
			<br>Jeśli chcesz sprawdzić stan magazynowy odpadów<br>wybierz z menu odpowiedni magazyn.<br>
			<br>Jeśli chcesz zaktualizować stan magazynowy<br>zaloguj się w menu i wybierz odpowiedni magazyn.<br><br>
			<br><b>Jeśli chcesz zalogować się do panelu administracyjnego wpisz:</b>
			<br>Login: tr
			<br>Hasło: Test
			</div>';

	Include ('footer.php');