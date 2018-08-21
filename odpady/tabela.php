<?php
	session_start();

	require_once "../connect.php";
	include ('header.php');
?>


	<div class="container m-auto">
		<div class="row">
			<div class="col-xs-6 m-auto pt-2 pb-2">
				<?php
					//Wyświetlanie stanu magazynu
					echo "<br><center><h3>Odpady do Spalarni</h3></center>";
					$zapytanie = "SELECT * FROM odpad ORDER BY id";
					$zerowanie = "ALTER TABLE odpad AUTO_INCREMENT=0";
					
					if ($result = @$polaczenie->query($zapytanie)){
						$ile_znalezionych = $result->num_rows;
					//	echo "<h6><center>Ilość znalezionych pozycji:  ".$ile_znalezionych."</center></h6>";

						if ($result->num_rows > 0){
							echo '<br>';
							echo '<table class="table table-striped">';
							echo '<thead>
							      <tr>
							      	<th>ID</th>
							        <th>Ilość wysyłek</th>
							        <th>Data aktualizacji</th>
							      </tr>
							    </thead>';
							    	
						while ($row = $result->fetch_object()){
							echo "<tr>";
								echo "<td>" . $row->id . "</td>";
								echo "<td>" . $row->ilosc . "</td>";
								echo "<td>" . $row->data . "</td>";
							echo "</tr>";
							}	

							echo '</table>';

						} else {
							@$polaczenie->query($zerowanie);
							echo "<br><h5><center>Magazyn jest pusty...</center></h5>";
						}
						
					} else {
						echo "Błąd  -> " . $polaczenie->error;
					}
					
					
					//Wyświetlanie stanu magazynu
					echo "<br><center><h3>Woda zanieczyszczona</h3></center>";
					$zapytanie = "SELECT * FROM woda ORDER BY id";
					$zerowanie = "ALTER TABLE woda AUTO_INCREMENT=0";
					
					if ($result = @$polaczenie->query($zapytanie)){
						$ile_znalezionych = $result->num_rows;
					//	echo "<h6><center>Ilość znalezionych pozycji:  ".$ile_znalezionych."</center></h6>";

						if ($result->num_rows > 0){
							echo '<br>';
							echo '<table class="table table-striped">';
							echo '<thead>
							      <tr>
							      	<th>ID</th>
							        <th>Ilość wysyłek</th>
							        <th>Data aktualizacji</th>
							      </tr>
							    </thead>';
							    	
						while ($row = $result->fetch_object()){
							echo "<tr>";
								echo "<td>" . $row->id . "</td>";
								echo "<td>" . $row->ilosc . "</td>";
								echo "<td>" . $row->data . "</td>";
							echo "</tr>";
							}	

							echo '</table>';

						} else {
							@$polaczenie->query($zerowanie);
							echo "<br><h5><center>Magazyn jest pusty...</center></h5>";
						}
						
					} else {
						echo "Błąd  -> " . $polaczenie->error;
					}


					$polaczenie->close();
				?>


				<!-- Wygaszony przycisk
				<br/><br/><a href="../../index.php"><center><button class="btn btn-secondary btn-md text-white" type="submit">Powrót do strony głównej</button></center></a>
				-->
			</div>
		</div>
	</div>


<?php include ('footer.php'); ?>