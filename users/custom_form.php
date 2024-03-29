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

    input {
      padding:4px;
      background:#fff;
    }

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

  <div class="hl-wp-form" style="font-family:sans-serif;">
    <?php
      if($_GET['formHeading']){
        echo '<h2>' . $_GET['formHeading'] . '</h2>';
      }

      if($_GET['formDesc']){
        echo '<p>' . $_GET['formDesc'] . '</p>';
      }
     ?>
  <form action="../admin/heyloyalty/heyloyaltyFunctions.php?access1=<?php echo $_GET['access1']; ?>&access2=<?php echo $_GET['access2'] ?>&list=<?php echo $_GET['list']; ?>" method="post">
    <div>
      <label for="hl-email">Email</label>
      <input type="email" name="hl-email" id="hl-email">
    </div>

    <?php
      if(in_array('name', $dataArray)){
    ?>
    <div>
      <label for="hl-firstname">First Name</label>
      <input type="text" name="hl-firstname" id="hl-firstname">
    </div>
    <div>
      <label for="hl-lastname">Last Name</label>
      <input type="text" name="hl-lastname" id="hl-lastname">
    </div>
    <?php
      }
      if(in_array('mobile', $dataArray)){
     ?>
    <div>
      <label for="hl-mobile">Mobile</label>
      <input type="number" name="hl-mobile" id="hl-mobile">
    </div>
    <?php
      }
    ?>
    <div>
      <input type="submit" name="hl-wp-submit" value="Sign Up">
    </div>
  </form>
  </div>


</body>
</html>
