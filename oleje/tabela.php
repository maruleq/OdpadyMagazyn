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
			
			</div>
		</div>
	</div>


<?php include ('footer.php'); ?>