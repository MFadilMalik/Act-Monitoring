<?php
    session_start();
    error_reporting(0);
    include '../../config/koneksi.php';
    if(@$_SESSION['username']==""){
        echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../../index.php'</script>";
      }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Act Mot | Dashboard</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../image/logo-wk.png" />
</head>
<body>
<ul class="nav nav-tabs justify-content-center nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="?menu=account">Manage Account</a></li>
                <li class="nav-item"><a class="nav-link" href="../../logout.php" style="color: grey;">Log Out</a></li>
 </ul>
 <?php 
    switch ($_GET['menu']) {
    case 'account':
        include 'account.php';  
        break;
    
    default:
        include 'account.php';
        break;
    }
 ?>
</body>
</html>