<?php

  // isset関数 与えられた変数に値がセットされているか(=nullでないか)を判定する
  // isset(判断したい変数); 変数がnullなら「false」 変数に値がセットされていれば「true」 空っぽを意味する「''」がセットされていれば「true」
  // 「参照画面」
  if(isset($_POST['disp']) == true) {

    // もし商品が選択れてていない状態で、参照ボタンをクリックした場合
    if(isset($_POST['procode']) == false) {
      // header関数 任意の画面へ飛ばす  header('Location:飛ばしたい画面のURL');
      // headerの前に何かを表示(例:print)してしまうとエラーが出るため前後に注意
      header('Location:pro_ng.php');
      // 強制終了の命令
      exit();
    }

  // URLパラメータで商品コードを渡せるようにする
  $pro_code = $_POST['procode'];
  // 飛び元のプログラム
  // Location内の?以降が「URLパラメータ」と呼ばれるもの。GET方式で読み取ることが出来る
  header('Location:pro_disp.php?procode='.$pro_code);
  // 強制終了の命令
  exit();

  }

  // 商品を選択していなくても追加は出来なければいけない(商品一覧から誰かを選択する必要が無い)ため、商品が選択されているかチェックしているif命令の前に追加する
  if(isset($_POST['add']) == true) {
    header('Location:pro_add.php');
    // 強制終了の命令
    exit();
  }

  // もしditだったら修正
  if(isset($_POST['edit']) == true) {

    // もし商品コードが選ばれていたら、$pro_codeに商品コードをコピー
    // もし商品コードが選ばれていなかったら、pro_ng.phpに飛ぶ
    // もし商品を選択しないまま修正ボタンをクリックしたら、pro_ng.phpに飛ぶ
    if(isset($_POST['procode']) == false) {
      header('Location:pro_ng.php');
      // 強制終了の命令
      exit();
    }

    // URLパラメータで商品コードを渡せるようにする
    $staff_code = $_POST['procode'];
    // 飛び元のプログラム
    // Location内の?以降が「URLパラメータ」と呼ばれるもの。GET方式で読み取ることが出来る
    header('Location:pro_edit.php?procode='.$pro_code);
    // 強制終了の命令
    exit();

  }

  // もしdeleteだったら削除
  if(isset($_POST['delete']) == true) {

    // もし商品コードが選ばれていたら、$pro_codeにスタッフコードをコピー
    // もし商品コードが選ばれていなかったら、pro_ng.phpに飛ぶ
    // もし商品を選択しないまま修正ボタンをクリックしたら、pro_ng.phpに飛ぶ
    if(isset($_POST['procode']) == false) {
      header('Location:pro_ng.php');
      // 強制終了の命令
      exit();
    }

    $staff_code = $_POST['procode'];
    header('Location:pro_delete.php?procode='.$pro_code);
    // 強制終了の命令
    exit();

  }

?>