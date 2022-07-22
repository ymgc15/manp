<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>オンラインストア</title>
</head>
<body>

  <?php

    // 前の画面(staff/staff_add.php)で入力されたデータを$_POSTから取り出して変数にコピーする。
    $staff_name = $_POST['name'];
    $staff_pass = $_POST['pass'];
    $staff_pass2 = $_POST['pass2'];

    // 以下の変数に安全対策(エスケープ処理)を施す
    // 以下の変数の中にある危険な文字を、安全な文字に置き換えて、同じ変数自身にコピーする。
    $staff_name = htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
    $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
    $staff_pass2 = htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');

    // もしスタッフ名が空欄だったら「スタッフ名が入力されていません。」と表示する。
    if ($staff_name == '') {
      print 'スタッフ名が入力されていません。<br>';
    // スタッフ名が入力されていたら、その名前を表示する。
    } else {
      print 'スタッフ名：';
      print $staff_name;
      print '<br>';
    }

    // もしパスワードが空欄だったら「パスワードが入力されていません。」と表示する。
    if ($staff_pass == '') {
      print 'パスワードが入力されていません。<br>';
    }

    // もし確認用に入力した2回目のパスワードと、最初のパスワードが違っていたら「パスワードが一致しません。」と表示する。
    if ($staff_pass != $staff_pass2) {
      print 'パスワードが一致しません。<br>';
    }

    // もし上記の1つでも入力ミスがあれば、画面には「戻る」ボタンを表示し。スタッフ入力画面に戻ってもらう。
    if ($staff_name == ''|| $staff_pass == ''|| $staff_pass != $staff_pass2) {
      print '<form>';
      // history.back()はJavaScript言語で、入力したデータを消さずに前の画面に戻ることができ、かつボタンとして表示することが可能。
      // <a>タグでも前の画面に戻ることはできるが、入力したデータが画面から全て消えてしまうため打ち直しになる。
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '</form>';
    // もし1つもミスがなければ、「戻る」ボタンと「ＯＫ」ボタンを両方表示する。
    } else {
      // md5で$staff_passの内容を暗号化し、同じ変数自身にコピーする。
      $staff_pass = md5($staff_pass);
      // submitボタン(ＯＫ)をクリックしたときstaff_add_done.phpに飛ぶ。
      print '<form method="post" action="staff_add_done.php">';
      print '<input type="hidden" name="name" value="'.$staff_name.'">';
      print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
      print '<br>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '<input type="submit" value="ＯＫ">';
      print '</form>';
    }

  ?>

</body>
</html>