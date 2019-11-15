<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

$dataOpts = $_GET['dataOpts'];

$dataArray = explode(",",$dataOpts);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Heyloyalty Signup</title>

  <style>

    label, input {
      display:block;
    }
    form div + div {
      margin-top:6px;
    }

    input {padding:4px;}

    input[type="submit"]{
      cursor:pointer;

      display:inline-block;
      margin-top:6px;
      padding:6px 12px;
      border:none;
      border-radius:6px;
      color:#fff;
      background:#4a70d1;
    }
    input[type="submit"]:hover {
      background:#6687dd;
    }

  </style>
</head>
<body>



</body>
</html>
