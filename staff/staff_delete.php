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

    // try~catch データベースサーバーの障害対策(エラートラップ)
    // データーベースを扱うプログラムには、必ずエラートラップを入れる
    // データベースにアクセスするときの基本ルールとして、必ず「接続→指令→切断(以下の①②③)」のステップを踏む。
    // ①データベースに接続
    // ②データベースエンジンにSQL文で指令を出す
    // ③データベースから切断する
    try {
      // スタッフコードを受け取る (そのコードのスタッフデータを修正するため)
      // テキストボックスからの入力ではないため、あえて安全対策はしない。
      $staff_code = $_GET['staffcode'];

      // データベースに接続 ①
      // 'mysql:~utf8'のシングルクォーテーションで括った中には、一切スペースを入れないこと
      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = 'root';
      $dbh = new PDO($dsn,$user,$password);
      // setAttribute 接続オプション
      // PDO::ATTR_ERRMODE エラーの通知方法
      // PDO::ERRMODE_EXCEPTION 例外を発生 (PDO::ATTR_ERRMODEの既定値)
      $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // SQL文を使って、そのスタッフコードのデータをデータベースから取得 ②
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // スタッフコードで絞り込んでいて、1件のレコードに絞り込まれるため、この後whileループで回すようなことはしない
      $sql = 'SELECT name FROM mst_staff WHERE code = ?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $staff_code;
      $stmt -> execute($data);

      $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
      // スタッフ名を変数にコピー。この後使用する
      $staff_name = $rec['name'];

      // データベースから切断 ③
      $dbh = null;

    }

    catch(Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }

  ?>

  スタッフ削除<br>
  <br>
  スタッフコード<br>
  <?php print $staff_code; ?>
  <br>
  スタッフ名<br>
  <?php print $staff_name; ?>
  <br>
  このスタッフを削除してよろしいですか？<br>
  <br>

  <form method="post" action="staff_delete_done.php">
    <input type="hidden" name="code" value="<?php print $staff_code; ?>">
    <input type="button" onclick = "history.back()" value="戻る">
    <input type="submit" value="ＯＫ">
  </form>

</body>
</html>