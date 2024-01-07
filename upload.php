<?php
// Getting user uploaded file
$file =$_FILES["file"];
// Saving file in uploads folder
move_uploaded_file($file["tmp_name"],"uploads/".$file["name"]);

// redirecting back to home
header("Location: cours.php");
?>