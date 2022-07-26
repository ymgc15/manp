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
      // 商品名と価格データを受け取る
      $pro_name = $_POST['name'];
      $pro_price = $_POST['price'];
      // 画像のファイル名を$_POSTで受け取る
      $pro_gazou_name = $_POST['gazou_name'];

      // 以下の変数に安全対策(エスケープ処理)を施す
      $pro_name = htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
      $pro_price = htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

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

      // SQL文を使ってレコード(テーブルの横方向の行のこと)を追加 ②
      // 以下は「プリペアードステートメント」と呼ばれる方式
      // (＊エラーメモ＊ gazouカラムのデフォルト値が無い →　gazouカラム削除したら解決した)
      // VALUES(?,?) を (?,?,?) に変更。画像ファイル名もデータベースに格納するようにした (データベースのgazouカラムに、画像のファイル名を格納するプログラムを追加)
      // データベースには”画像そのもの”ではなくて、画像のファイル名だけを格納しておく。(画像ファイル本体は、[gazou]フォルダの中にあるため)
      $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
      $stmt = $dbh -> prepare($sql);
      // 「?」にセットしたいデータが入っている変数を順番に入力
      $data[] = $pro_name;
      $data[] = $pro_price;
      $data[] = $pro_gazou_name;
      $stmt -> execute($data);

      // データベースから切断 ③
      $dbh = null;

      // データベースサーバーが正常に動いていれば以下のコードが実行される
      print $pro_name;
      print 'を追加しました。<br>';
    }

    // catch (例外が発生するかもしれない例外の種類 例外を受け取る変数名)
    catch (Exception $e) {
      // データベースサーバーに障害が発生したら以下のコードが実行される
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      // 強制終了の命令
      exit();
    }

  ?>

  <!-- この先に作る商品一覧画面(product/pro_list.php)のリンク先 -->
  <a href="pro_list.php">戻る</a>

</body>
</html>