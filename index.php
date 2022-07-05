<?php
if (isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Vérifie si le fichier est une image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      echo "Le fichier est une image - " . $check["mime"] . ".<br>";
      $uploadOk = 1;
    } else {
      echo "Le fichier n'est pas une image. <br>";
      $uploadOk = 0;
    }
  }

  // Vérifie si le fichier existe déjà
  if (file_exists($target_file)) {
    echo "Désolé, le fichier existe déjà. <br>";
    $uploadOk = 0;
  }

  // Vérifie lataille du fichier
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désolé, votre fichier est trop volumineux. <br>";
    $uploadOk = 0;
  }

  // Permet certains formats de fichier
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont permis. <br>";
    $uploadOk = 0;
  }

  // Vérifie si $uploadOk est déifini à 0 par une erreur
  if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas été uploadé <br>";
    // Si tout est ok, on essaye d'uploader le fichier
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "Le fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a été uploadé. <br>";
    } else {
      echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier. <br>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- enctype est important pour spécifier l'encodage du fichier et ne peut être utilsié qu'avec POST -->
  <form method="POST" enctype="multipart/form-data">
    Sélectionner une image à uploader:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Uploader l'Image" name="submit">
  </form>
</body>

</html>