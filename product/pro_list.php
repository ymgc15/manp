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

      // SQL文で指令 ②
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // SELECT文 「mst_productテーブルから商品コードと商品名、価格カラムのデータを全部ください」という指令
      // WHERE 「どういうふうに？」 (「1」は「全部」という意味)
      $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
      $stmt = $dbh -> prepare($sql);
      // この命令が終わった時点で、$stmtの中には全てのデータが入っている
      $stmt -> execute();

      // データベースから切断 ③
      $dbh = null;

      print '商品一覧<br><br>';

      // 分岐画面に飛ぶ
      print '<form method = "post" action = "pro_branch.php">';

      // 商品の名前を$stmtから1レコードずつ取り出しながら表示。レコードがなくなったらループから脱出
      while(true) {
        // $stmtから1レコード取り出している
        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        // もし、もうデータがなければループから脱出
        if($rec == false) {
          break;
        }
        // ラジオボタンで商品を選べるようにした
        // どの商品を選んだかを飛び先で分かるように、商品コードを渡している
        print '<input type = "radio" name = "procode" value = "'.$rec['code'].'">';
        // 名前を表示
        print $rec['name'].'---';
        // 価格を表示
        print $rec['price'].'円';
        print '<br>';
      }

      // 参照ボタン、追加ボタン、修正ボタン、削除ボタンを表示
      // nameに「disp」「add」「edit」」「delete」を追加することで、飛び先(staff_branch.php)で、どのボタンが押された区別出来るようになる
      print '<input type = "submit" name = "disp" value = "参照">';
      print '<input type = "submit" name = "add" value = "追加">';
      print '<input type = "submit" name = "edit" value = "修正">';
      print '<input type = "submit" name = "delete" value = "削除">';
      print '</form>';
    }

    catch(Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }

  ?>

</body>
</html>