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
      // スタッフコードとスタッフ名、そしてパスワードを受け取る
      $staff_code = $_POST['code'];
      $staff_name = $_POST['name'];
      $staff_pass = $_POST['pass'];

      // 以下の変数に安全対策(エスケープ処理)を施す
      $staff_name = htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
      $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

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

      // SQL文を使って指令 ②
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // UPDATE文 既に存在しているレコードの内容を上書き修正するSQL文
      // 「スタッフコードが ?(WHERE code = ?) の人の名前を ?(SET name = ?) に変えてください」という指令
      $sql = 'UPDATE mst_staff SET name = ?, password = ? WHERE code = ?';
      $stmt = $dbh -> prepare($sql);
      // 「?」にセットしたいデータが入っている変数を順番に入力
      $data[] = $staff_name;
      $data[] = $staff_pass;
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

  修正しました。<br>
  <br>
  <!-- この先に作るスタッフ一覧画面(staff/staff_list.php)のリンク先 -->
  <a href="staff_list.php">戻る</a>

</body>
</html>