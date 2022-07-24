<?php

  if(isset($_POST['disp']) == true) {

    if(isset($_POST['staffcode']) == false) {
      header('Location:staff_ng.php');
      exit();
    }

  $staff_code = $_POST['staffcode'];
  header('Location:staff_disp.php?staffcode='.$staff_code);
  exit();

  }

  // スタッフを選択していなくても追加は出来なければいけない(スタッフ一覧から誰かを選択する必要が無い)ため、スタッフが選択されているかチェックしているif命令の前に追加する
  if(isset($_POST['add']) == true) {
    header('Location:staff_add.php');
    exit();
  }

  // もしditだったら修正
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