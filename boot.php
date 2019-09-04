<?php 
  $e=array();
  $e[0]="a";
  /*
  for ($i=0; $i < 3; $i++) { 
    $e[$i]=$i;
  }
  */
?>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link href="boot.css?<?=filemtime("boot.css")?>" rel="stylesheet" type="text/css" />
</head>
<body>



<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple><br/>
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple><br/>
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple><br/>
    <input type="submit" value="Upload Image" name="submit">
</form>
<br/>
  <div style="margin-top: 15em;">
  <?php
      $j=-1;
  ?>
      <span><?php $j++;if (array_key_exists($j, $e)){echo $e[$j];}else{$c=array_key_exists($j, $e);echo $c;} ?></span>
      <span><?php $j++;if (array_key_exists($j, $e)){echo $e[$j];}else{$c=array_key_exists($j, $e);echo $c;} ?></span>
  
  </div>

</body>
</html>
