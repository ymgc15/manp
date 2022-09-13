<?php

  // isset関数 与えられた変数に値がセットされているか(=nullでないか)を判定する
  // isset(判断したい変数); 変数がnullなら「false」 変数に値がセットされていれば「true」 空っぽを意味する「''」がセットされていれば「true」
  if(isset($_POST['disp']) == true) {

    if(isset($_POST['staffcode']) == false) {
      // header関数 任意の画面へ飛ばす  header('Location:飛ばしたい画面のURL');
      // headerの前に何かを表示(例:print)してしまうとエラーが出るため前後に注意
      header('Location:staff_ng.php');
      // 強制終了の命令
      exit();
    }

  // URLパラメータでスタッフコードを渡せるようにする
  $staff_code = $_POST['staffcode'];
  // 飛び元のプログラム
  // Location内の?以降が「URLパラメータ」と呼ばれるもの。GET方式で読み取ることが出来る
  header('Location:staff_disp.php?staffcode='.$staff_code);
  // 強制終了の命令
  exit();

  }

  // スタッフを選択していなくても追加は出来なければいけない(スタッフ一覧から誰かを選択する必要が無い)ため、スタッフが選択されているかチェックしているif命令の前に追加する
  if(isset($_POST['add']) == true) {
    header('Location:staff_add.php');
    // 強制終了の命令
    exit();
  }

  // もしditだったら修正
  if(isset($_POST['edit']) == true) {

    // もしスタッフコードが選ばれていたら、$staff_codeにスタッフコードをコピー
    // もしスタッフコードが選ばれていなかったら、staff_ng.phpに飛ぶ
    // もしスタッフを選択しないまま修正ボタンをクリックしたら、staff_ng.phpに飛ぶ
    if(isset($_POST['staffcode']) == false) {
      header('Location:staff_ng.php');
      // 強制終了の命令
      exit();
    }

    // URLパラメータでスタッフコードを渡せるようにする
    $staff_code = $_POST['staffcode'];
    // 飛び元のプログラム
    // Location内の?以降が「URLパラメータ」と呼ばれるもの。GET方式で読み取ることが出来る
    header('Location:staff_edit.php?staffcode='.$staff_code);
    // 強制終了の命令
    exit();

  }

  // もしdeleteだったら削除
  if(isset($_POST['delete']) == true) {

    // もしスタッフコードが選ばれていたら、$staff_codeにスタッフコードをコピー
    // もしスタッフコードが選ばれていなかったら、staff_ng.phpに飛ぶ
    // もしスタッフを選択しないまま修正ボタンをクリックしたら、staff_ng.phpに飛ぶ
    if(isset($_POST['staffcode']) == false) {
      header('Location:staff_ng.php');
      // 強制終了の命令
      exit();
    }

    $staff_code = $_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    // 強制終了の命令
    exit();

  }

?>