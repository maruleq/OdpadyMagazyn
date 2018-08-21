<?php
	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: ../admin/zalogowany.php');
		exit();
	}
	

	//Pobieranie skryptów potrzebnych do połączenia z bazą danych
	require_once "../connect.php";
	
	//Sprawdzanie czy połączenie zostało ustanowione prawidłowo
	//Zmienna $polaczenie została ustanowiona w pliku connect.php
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno; //Wyświetlenie błędu
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		//Zabezpieczenie przed wstrzykiwaniem - wstawianie encji zamiast znaków specjalnych
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		//Ustawienie zabezpieczenia wpływania na zapytanie do bazy
		if ($rezultat = @$polaczenie->query(
			sprintf("SELECT * FROM users WHERE user='%s'",
			mysqli_real_escape_string($polaczenie, $login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if ($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();

				if (password_verify($haslo, $wiersz['pass']))
				{

					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['userID'];
					$_SESSION['user'] = $wiersz['imie']; 
					$_SESSION['nazwisko'] = $wiersz['nazwisko'];
					
					unset($_SESSION['error']);  // jeśli zalogowany - brak błędu
					
					$rezultat->free_result(); //czyszczenie rezultatu zapytania
		
					header('Location: ../admin/zalogowany.php');
					
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: ../index.php');
				}
			
			} else {
				
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../index.php');
			}
		}
		$polaczenie->close();
	}