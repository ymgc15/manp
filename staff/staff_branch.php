<?php

  // もしditだったら修
  if(isset($_POST['edit']) == true) {
    header('Location:staff_edit.php');
    exit();
  }

  // もしdeleteだったら削除
  if(isset($_POST['delete']) == true) {
    header('Location:staff_delete.php');
    exit();
  }

?>