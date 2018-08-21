<?php

	require_once "../connect.php";

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    
    $id = $_GET['id'];
    
    if ($stmt = $polaczenie->prepare("DELETE FROM woda WHERE ID = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id); // parametr "i" to "integer"
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Błąd zapytania";
    }
    
    $polaczenie->close();
    
    header("Location: magazyn.php");
    
} else {
    header("Location: magazyn.php");
}