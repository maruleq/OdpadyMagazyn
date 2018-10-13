<?php

/**
	************************************************************************
	**	Strona nagłówka aplikacji magazynowej. Bootsrap 4
	************************************************************************
	**
	**	1. Załadowanie menu
	**	2. Załadowanie nagłówka
	**
	************************************************************************
*/

?>

	<!-- Navbar -->
	<nav class="navbar navbar-light navbar-expand-md bg-light">
		<div class="container">
			<a href="index.php" class="navbar-brand">Ekomax Sp. z o.o.</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navContent">
				<div class="navbar-nav">
					<a href="index.php" class="nav-item nav-link active">Strona główna</a>
					<a href="oleje/tabela.php" class="nav-item nav-link">Magazyn olejów</a>
					<a href="odpady/tabela.php" class="nav-item nav-link">Magazyn odpadów</a>
					<a href="logowanie/login.php" class="nav-item nav-link">Logowanie</a>
				</div>
			</div>
		</div>
	</nav>
	
	<body>
		<!-- Nagłówek -->
		<div class="jumbotron jumbotron-fluid bg-primary text-white text-center pt-5 pb-5">
			<div class="container">
				<h1 class="display-3">Magazyn</h1>
			</div>
		</div>