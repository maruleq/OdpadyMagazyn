<?php
	session_start();

	require_once "../connect.php";
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: ../index.php');
		exit();	
	}
	
	include ('header_log.php');
?>


	<div class="container m-auto pb-5">
		<div class="m-auto text-center pb-5">
			<?php  //Odebranie zmiennych z sesji w pliku zaloguj.php
				echo "<h5>Zalogowany jako ->  ".$_SESSION['user']." ".$_SESSION['nazwisko']."</h5>";
				echo "<br>Każdy rekord można edytować lub usunć.<br>Po usunięciu wszystkich rekordów mozna dodawać je ponownie.";
			?>
			<br>
		</div>
		
		<div class="row">
			<div class="col-xs-6 m-auto">
				<?php
					//Wyświetlanie stanu magazynu olejów
				echo "<br><center><h3>Stan olejów na zbiornikach</h3></center>";
					$zapytanie = "SELECT * FROM zbiorniki ORDER BY id";
					$zerowanie = "ALTER TABLE zbiorniki AUTO_INCREMENT=0";
					
					if ($result = @$polaczenie->query($zapytanie)){
						$ile_znalezionych = $result->num_rows;
					//	echo "<h6><center>Ilość znalezionych pozycji:  ".$ile_znalezionych."</center></h6>";

						if ($result->num_rows > 0){
						
							echo '<br>';
							echo '<table class="table table-striped">';
							echo '<thead>
							      <tr>
							      	<th>ID</th>
							        <th>Zbiornik</th>
							        <th>Stan (m3)</th>
							        <th>Data aktualizacji</th>
							      </tr>
							    </thead>';
						
						while ($row = $result->fetch_object()){
							echo "<tr>";
								echo "<td>" . $row->id . "</td>";
								echo "<td>" . $row->zbiornik . "</td>";
								echo "<td>" . $row->stan . "</td>";
								echo "<td>" . $row->data . "</td>";
								echo "<td><a href='record.php?id=" . $row->id . "'>Edytuj</a></td>";	// link do usówania rekordu
								echo "<td><a href='delete.php?id=" . $row->id . "'>Usuń</a></td>";		// link do usówania rekordu
							echo "</tr>";
						}
						echo "</table>";
						echo '<br><a href="record.php"><center><button class="btn btn-primary btn-md text-white" type="submit">Dodaj zbiornik</button></center></a><br>';
						
						} else {
							@$polaczenie->query($zerowanie);
							echo "<br><h5><center>Magazyn jest pusty...</center></h5>";
							echo '<br><a href="record.php"><center><button class="btn btn-primary btn-md text-white" type="submit">Dodaj zbiornik</button></center><br></a>';
						}
						
					} else {
						echo "Błąd  -> " . $polaczenie->error;
					}

					
					//Wyświetlanie stanu zlanego odpadu ze zbiorników
					echo "<br><center><h3>Ilość zlanego odpadu ze zbiorników<br>(miesięcznie)</h3></center>";
					$zapytanie = "SELECT * FROM odpad_zb ORDER BY id";
					$zerowanie = "ALTER TABLE odpad_zb AUTO_INCREMENT=0";
					
					if ($result = @$polaczenie->query($zapytanie)){
						$ile_znalezionych = $result->num_rows;
					//	echo "<h6><center>Ilość znalezionych pozycji:  ".$ile_znalezionych."</center></h6>";

						if ($result->num_rows > 0){
							echo '<br>';
							echo '<table class="table table-striped">';
							echo '<thead>
							      <tr>
							      	<th>ID</th>
							        <th>Ilość odpadu (m3)</th>
							        <th>Data aktualizacji</th>
							      </tr>
							    </thead>';
							    	
						while ($row = $result->fetch_object()){
							echo "<tr>";
								echo "<td>" . $row->id . "</td>";
								echo "<td>" . $row->ilosc . "</td>";
								echo "<td>" . $row->data . "</td>";
								echo "<td><a href='record_odp.php?id=" . $row->id . "'>Edytuj</a></td>";	// link do usówania rekordu
								echo "<td><a href='delete_odp.php?id=" . $row->id . "'>Usuń</a></td>";		// link do usówania rekordu
							echo "</tr>";
						}
						echo "</table>";
						echo '<br><a href="record_odp.php"><center><button class="btn btn-primary btn-md text-white" type="submit">Dodaj ilość odpadu</button></center></a><br>';
						} else {
							@$polaczenie->query($zerowanie);
							echo "<br><h5><center>Magazyn jest pusty...</center></h5>";
							echo '<br><a href="record_odp.php"><center><button class="btn btn-primary btn-md text-white" type="submit">Dodaj ilość odpadu</button></center></a><br>';
						}
						
					} else {
						echo "Błąd  -> " . $polaczenie->error;
					}

					$polaczenie->close();
				?>
				
			</div>
		</div>
	</div>


<?php include ('footer.php'); ?>