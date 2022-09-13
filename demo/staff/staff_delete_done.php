<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>カヌレオンラインショップ</title>
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
      // スタッフコードとスタッフ名、そしてパスワードを受け取る
      $staff_code = $_POST['code'];

      // データベースに接続 ①
      // 'mysql:~utf8'のシングルクォーテーションで括った中には、一切スペースを入れないこと
      $dsn = 'mysql:dbname=onlineshop;host=localhost;charset=utf8';
      $user = 'root';
      $password = 'root';
      $dbh = new PDO($dsn,$user,$password);
      // setAttribute 接続オプション
      // PDO::ATTR_ERRMODE エラーの通知方法
      // PDO::ERRMODE_EXCEPTION 例外を発生 (PDO::ATTR_ERRMODEの既定値)
      $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // SQL文を使って指令 ②
      // DELETE文 既に存在するレコードを削除するSQL文
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // 「mst_staffテーブルの中の、スタッフコードが ?(WHERE code = ?) のレコードを削除してください」という指令
      $sql = 'DELETE FROM mst_staff WHERE code = ?';
      $stmt = $dbh -> prepare($sql);
      // 「?」にセットしたいデータが入っている変数を入力
      $data[] = $staff_code;
      $stmt -> execute($data);

      // データベースから切断 ③
      $dbh = null;

    }

    // catch (例外が発生するかもしれない例外の種類 例外を受け取る変数名)
    catch (Exception $e) {
      // データベースサーバーに障害が発生したら以下のコードが実行される
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      // 強制終了の命令
      exit();
    }

  ?>

  削除しました。<br>
  <br>
  <!-- この先に作るスタッフ一覧画面(staff/staff_list.php)のリンク先 -->
  <a href="staff_list.php">戻る</a>

</body>
</html>