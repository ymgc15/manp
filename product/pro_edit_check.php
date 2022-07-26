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

    // 前の画面(product/pro_add.php)で入力されたデータを$_POSTから取り出して変数にコピーする。
    $pro_code = $_POST['code'];
    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];

    // 以下の変数に安全対策(エスケープ処理)を施す
    // 以下の変数の中にある危険な文字を、安全な文字に置き換えて、同じ変数自身にコピーする。
    $pro_code = htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
    $pro_name = htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_price = htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

    // もし商品名が空欄だったら「商品名が入力されていません。」と表示する。
    if ($pro_name == '') {
      print '商品名が入力されていません。<br>';
    // 商品名が入力されていたら、その商品名を表示する。
    } else {
      print '商品名：';
      print $pro_name;
      print '<br>';
    }

    // もし半角英数字じゃなかったら「価格をきちんと入力してください。」と表示する。
    // ①preg_match 「正しいか間違っているかを、正規表現でチェックしなさい」という命令
    // ②preg_match もしデータがあるべき形になっていないと「0」を返し、あるべき形になっていれば「1」を返す。
    // ①②をif命令で判断するのが、「正規表現」と呼ばれる仕組み。
    if (preg_match('/^[0-9]+$/',$pro_price) == 0) {
      print '価格をきちんと入力してください。<br>';
    } else {
      print '価格：';
      print $pro_price;
      print '円<br>';
    }

    // もし上記の1つでも入力ミスがあれば、画面には「戻る」ボタンを表示し。商品追加入力画面に戻ってもらう。
    if ($pro_name == ''|| preg_match('/^[0-9]+$/',$pro_price) == 0) {
      print '<form>';
      // history.back()はJavaScript言語で、入力したデータを消さずに前の画面に戻ることができ、かつボタンとして表示することが可能。
      // <a>タグでも前の画面に戻ることはできるが、入力したデータが画面から全て消えてしまうため打ち直しになる。
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '</form>';
    // もし1つもミスがなければ、「戻る」ボタンと「ＯＫ」ボタンを両方表示する。
    } else {
      print '上記のように変更します。<br>';
      // submitボタン(ＯＫ)をクリックしたときpro_add_done.phpに飛ぶ。
      print '<form method="post" action="pro_edit_done.php">';
      print '<input type="hidden" name="code" value="'.$pro_code.'">';
      print '<input type="hidden" name="name" value="'.$pro_name.'">';
      print '<input type="hidden" name="price" value="'.$pro_price.'">';
      print '<br>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '<input type="submit" value="ＯＫ">';
      print '</form>';
    }

  ?>

</body>
</html>