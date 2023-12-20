<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<!-- in evry page veiw we neeed to get a value for $title and $body  -->
<title><?=$title?></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
  <!-- nav bar  for example its not match with this mini project-->
<?php include '../app/View/include/navbar.php'; ?>
<div  style="height:10%; background-color:red;" > jus exampl for  navbar </div>
<!-- nav bar  -->




    <!-- we willuse function ob_start and ob_get_clean to import the  body to variable $body -->
  <?=$body?>


<div  style="height:10%; background-color:red;" > jus exampl for  footer </div>

<?php  
// include your footer that just a exampl

// include '../app/View/include/footer.php';
?>


 
</body>
</html>