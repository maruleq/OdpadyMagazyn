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
			<h4>Witaj w demonstracyjnej aplikacji<br>Magazynu Gospodarki Odpadami</h4>
			<br>Magazyn wyświetla stan oleju przepracowanego zgromadzonego w zbiornikach,
			<br>ilość odpadów przygotowanych do utylizacji w spalarni
			<br>oraz ilość zgromadzonej wody zabrudzonej przeznaczonej do oczyszczenia.
			<br><br>
			<br>Jeśli chcesz sprawdzić stan magazynowy odpadów<br>wybierz z menu odpowiedni magazyn.<br>
			<br>Jeśli chcesz zaktualizować stan magazynowy<br>zaloguj się w menu i wybierz odpowiedni magazyn.<br><br>
			<br><b>Aby się zalogować wpisz:</b>
			<br>Login: tr
			<br>Hasło: Test
			</div>';

	Include ('footer.php');