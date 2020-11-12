<!DOCTYPE html>
<html>
<head>
  <title>Uploading...</title>
</head>
<body>
   <h1>Uploading File...</h1>

<?php

  if ($_FILES['the_files']['error'][0] > 0)
  {
    echo 'Problem: ';
    switch ($_FILES['the_files']['error'][0])
    {
      case 1:
         echo 'File exceeded upload_max_filesize.';
         break;
      case 2:
         echo 'File exceeded max_file_size.';
         break;
      case 3:
         echo 'File only partially uploaded.';
         break;
      case 4:
         echo 'No file uploaded.';
         break;
      case 6:
         echo 'Cannot upload file: No temp directory specified.';
         break;
      case 7:
         echo 'Upload failed: Cannot write to disk.';
         break;
      case 8:
         echo 'A PHP extension blocked the file upload.';
         break;
    }
    exit;
  }

  // Does the file have the right MIME type?
  if ($_FILES['the_files']['type'][0] != 'image/png')
  {
    echo 'Problem: file is not a PNG image.';
    exit;
  }

  // put the file where we'd like it
  $uploaded_file = 'uploads/'.$_FILES['the_files']['name'][0];

  if (is_uploaded_file($_FILES['the_files']['tmp_name'][0]))
  {
     if (!move_uploaded_file($_FILES['the_files']['tmp_name'][0], $uploaded_file))
     {
        echo 'Problem: Could not move file to destination directory.';
        exit;
     }
  }
  else
  {
    echo 'Problem: Possible file upload attack. Filename: ';
    echo $_FILES['the_files']['name'][0];
    exit;
  }

  echo 'File uploaded successfully.';

  // show what was uploaded
  echo '<p>You uploaded the following image:<br/>';
  echo '<img src="uploads/'.$_FILES['the_files']['name'][0].'"/>';
?>
</body>
</html>