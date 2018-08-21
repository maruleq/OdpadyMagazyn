<?php 

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header ('Location: ../admin/zalogowany.php');
		exit();
	}


include ('header.php'); ?>

<html>
	<div class="container pt-2 pb-5 text-center">
		<div class="row pt-5">
			<div class="col-xs-4 m-auto">
				<form action="login_proc.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="text">Login</label>
						<input type="text" name="login" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label for="password">Hasło</label>
						<input type="password" name="haslo" class="form-control" required="required">	
					</div>
					<button type="submit" class="btn btn-primary btn-md">Zaloguj</button>
				</form>
			</div>
		</div>
	</div>
</html>
	
<?php include ('../footer.php'); ?>