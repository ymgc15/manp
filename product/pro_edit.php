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
      // 商品コードを受け取る (そのコードの商品データを修正するため)
      // テキストボックスからの入力ではないため、あえて安全対策はしない。
      // 飛び先のプログラム
      // $_POSTではなく$_GETを使う
      // <form>で送って$_POSTで受け取る＝POST方式で、URLパラメータで送って$_GETで受け取る＝GET方式
      // GETの注意点として、ブラウザのURL欄にデータが丸見えになってしまうため、見られても構わないデータしか扱ってはいけない。
      $pro_code = $_GET['procode'];

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

      // SQL文を使って、その商品コードのデータをデータベースから取得 ②
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // 商品コードで絞り込んでいて、1件のレコードに絞り込まれるため、この後whileループで回すようなことはしない
      $sql = 'SELECT name,price FROM mst_product WHERE code = ?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $pro_code;
      $stmt -> execute($data);

      $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
      // 商品名を変数にコピー。この後使用する
      $pro_name = $rec['name'];
      $pro_price = $rec['price'];

      // データベースから切断 ③
      $dbh = null;

    }

    catch(Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }

  ?>

  商品修正<br>
  <br>
  商品コード<br>
  <?php print $pro_code; ?>
  <br>
  <br>

  <form method="post" action="pro_edit_check.php">
    <input type="hidden" name="code" value="<?php print $pro_code; ?>">

    商品名<br>
    <!-- ?php print $pro_name; ?"の部分で名前を既に入力済みにしている -->
    <input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br>
    価格<br>
    <input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br>
    <br>

    <input type="button" onclick = "history.back()" value="戻る">
    <input type="submit" value="ＯＫ">
  </form>

</body>
</html>