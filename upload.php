<?php
if (isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];

  $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

  $allowed = array('csv', 'txt'); // List of allowed file extensions

  if (in_array($fileExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) { // Maximum file size of 1MB
        $fileNameNew = uniqid('', true) . "." . $fileExt;
        $fileDestination = 'uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: index.php?uploadsuccess");
      } else {
        echo "Error: File size exceeds maximum limit.";
      }
    } else {
      echo "Error: There was an error uploading your file.";
    }
  } else {
    echo "Error: File type not allowed. Only CSV and TXT files are allowed.";
  }
}
?>
