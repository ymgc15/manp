<?php

  // もしditだったら修
  if(isset($_POST['edit']) == true) {

    if(isset($_POST['staffcode']) == false) {
      header('Location:staff_ng.php');
      exit();
    }

    $staff_code = $_POST['staffcode'];
    header('Location:staff_edit.php?staffcode='.$staff_code);
    exit();

  }

  // もしdeleteだったら削除
  if(isset($_POST['delete']) == true) {

    if(isset($_POST['staffcode']) == false) {
      header('Location:staff_ng.php');
      exit();
    }

    $staff_code = $_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();

  }

?>