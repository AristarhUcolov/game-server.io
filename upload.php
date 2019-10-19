<?php 

define("UPLOAD_DIR", "/var/www/test.ed-fun.ru/upload/"); // здесь должен быть Ваш путь
 
if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
 
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Owibka.</p>";
        exit;
    }
    
    // для работы необходимо расширение php_exif (поэтому с 14 - 19 линию можно убрать)
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) { 
        echo "<p>File ne img.</p>";
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
 
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
 
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Ne udalos' save file.</p>";
        exit;
    }
 
    chmod(UPLOAD_DIR . $name, 0644);

    echo "<p>File " . $name . " successfully load.</p>";

}

?>