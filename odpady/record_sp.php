<?php 
    require_once "../connect.php";
	function createForm($p_ilosc='',$error='',$id='') { 
	include ('header.php');
?>


<div class="container pt-5 pb-5 text-center">
	
    <h1><?php

        if($id != '') {
            echo "Edytuj wysyłkę";
        } else {
            echo "Dodaj wysyłkę";
        } ?></h1>

		<?php

        if($error != '') {
            echo "<div style='color:red; padding: 5px'>" . $error . "</div>";
        } ?>
			
	<div class="row">
		<div class="col-xs-4 m-auto">
			<form action="" method="post" class="form-horizontal">
				<div class="form-group pt-5 pb-3">
					<?php if($id != '') { ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <p> ID: <?php echo $id; ?></p>
                    <?php } ?>
                                
                    <label for="text"><h4>Wysyłka: </h4></label>
                    <input type="text" name="ilosc" class="form-control" required="required" value="<?php echo $p_ilosc; ?>" /></p>
                    <input type="submit" name="submit" class="btn btn-primary" value="Zapisz" />			
				</div>
			</form>
			<br><a href="magazyn.php"><button class="btn btn-secondary" type="submit">Wróć do magazynu</button></a>
		</div>
	</div>
</div>
        
<?php include ('footer.php'); ?>
	
<?php }

if (isset($_GET['id'])){
	
    // tryb edycji
    if (isset($_POST['submit'])){
        
        if (is_numeric($_POST['id'])){
            $id = $_POST['id'];
            $ilosc = htmlentities($_POST['ilosc'], ENT_QUOTES);
            
			
            if ($ilosc == ''){
                $error = 'Wypełnij wszystkie pola';
                createForm($ilosc,$error);
            } else {
                if ($stmt = $polaczenie->prepare("UPDATE odpad SET ilosc = ? WHERE id = ?")){
                    $stmt->bind_param("ii",$ilosc,$id); // parametr "ii" to "integer, integer"
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Błąd zapytania";
                }
                
                header("Location: magazyn.php");
            }
            
        }
        
    } else {
        if (is_numeric($_GET['id']) && $_GET['id'] > 0 ){
            
            $id = $_GET['id'];
            
            if ($stmt = $polaczenie->prepare("SELECT `id`, `ilosc` FROM odpad WHERE id = ?")){
                $stmt->bind_param("i",$id); // parametr "i" to "integer"
                $stmt->execute();
                $stmt->bind_result($id,$ilosc);
                $stmt->fetch();
                createForm($ilosc,NULL,$id);
                $stmt->close();
            } else {
                echo "Błąd zapytania";
            }
            
        } else {
            header("Location: magazyn.php");
        }
    }
    
} else {

    //Tryb nowego rekordu
    if (isset($_POST['submit'])){
        
        $ilosc = htmlentities($_POST['ilosc'], ENT_QUOTES);
		
        
        if ($ilosc == ''){
            $error = 'Wypełnij wszystkie pola';
            createForm($ilosc,$error);
        } else {
            if ($stmt = $polaczenie->prepare("INSERT odpad (ilosc) VALUES (?)")){
                $stmt->bind_param("i",$ilosc); // parametr "i" to "integer"
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Błąd zapytania";
            }
            
            header("Location: magazyn.php");
        }
        
    } else {
        createForm();
    }
    
}
	$polaczenie->close();
?>