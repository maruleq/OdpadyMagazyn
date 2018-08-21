<?php 
    require_once "../connect.php";
	function createForm($p_zbiornik='',$p_stan='',$error='',$id='') { 
	include ('header.php');
?>


<div class="container pt-5 pb-5 text-center">
	
    <h1><?php

        if($id != '') {
            echo "Edytuj stan zbiornika";
        } else {
            echo "Dodaj zbiornik";
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
                                
                    <label for="text"><h4>Zbiornik: </h4></label>
                    <input type="text" name="zbiornik" class="form-control" required="required" value="<?php echo $p_zbiornik; ?>" /></p>
                    <label for="text"><h4>Stan: </h4></label>
                    <input type="text" name="stan" class="form-control" required="required" value="<?php echo $p_stan; ?>" /></p>
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
            $zbiornik = htmlentities($_POST['zbiornik'], ENT_QUOTES);
            $stan = htmlentities($_POST['stan'], ENT_QUOTES);
            
			
            if ($zbiornik == '' || $stan == ''){
                $error = 'Wypełnij wszystkie pola';
                createForm($zbiornik,$stan,$error);
            } else {
                if ($stmt = $polaczenie->prepare("UPDATE zbiorniki SET zbiornik = ?, stan = ? WHERE id = ?")){
                    $stmt->bind_param("sii",$zbiornik,$stan,$id); // parametr "sii" to "string, ineger, integer"
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
            
            if ($stmt = $polaczenie->prepare("SELECT `id`, `zbiornik`, `stan` FROM zbiorniki WHERE id = ?")){
                $stmt->bind_param("i",$id); // parametr "i" to "integer"
                $stmt->execute();
                $stmt->bind_result($id,$zbiornik,$stan);
                $stmt->fetch();
                createForm($zbiornik,$stan,NULL,$id);
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
        
        $zbiornik = htmlentities($_POST['zbiornik'], ENT_QUOTES);
        $stan = htmlentities($_POST['stan'], ENT_QUOTES);
		
        
        if ($zbiornik == '' || $stan == ''){
            $error = 'Wypełnij wszystkie pola';
            createForm($zbiornik,$stan,$error);
        } else {
            if ($stmt = $polaczenie->prepare("INSERT zbiorniki (zbiornik,stan) VALUES (?,?)")){
                $stmt->bind_param("si",$zbiornik,$stan); // parametr "si" to "string, integer"
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