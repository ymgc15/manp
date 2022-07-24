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

      // SELECT文 「mst_staffテーブルからスタッフコードと、nameカラムとのデータ(つまりスタッフ名)を全部ください」という指令
      // WHERE 「どういうふうに？」 (「1」は「全部」という意味)
      $sql = 'SELECT code,name FROM mst_staff WHERE 1';
      $stmt = $dbh -> prepare($sql);
      $stmt -> execute();

      // データベースから切断 ③
      $dbh = null;

      print 'スタッフ一覧<br><br>';

      // 修正画面に飛ぶ
      print '<form method = "post" action = "staff_edit.php">';

      while(true) {
        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($rec == false) {
          break;
        }
        // どのスタッフを選んだかを飛び先で分かるように、スタッフコードを渡している
        print '<input type = "radio" name = "staffcode" value = "'.$rec['code'].'">';
        print $rec['name'];
        print '<br>';
      }

      print '<input type = "submit" value = "修正">';
      print '</form>';
    }

    catch(Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }

  ?>

</body>
</html>