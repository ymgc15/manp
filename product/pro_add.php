<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>オンラインストア</title>
</head>
<body>

  商品追加<br>
    <br>
    <!-- enctype="multipart/form-data"を忘れると、次の画面で画像の情報を受け取ることが出来なくなる -->
    <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
  商品名を入力してください。<br>
    <input type="text" name="name" style="width:200px"><br>
  価格を入力してください。<br>
    <input type="text" name="price" style="width:50px"><br>
  画像を選んでください。<br>
  <!-- typeをfileにすると、画像に限らずファイルを取り込めるようになる -->
  <input type="file" name="gazou" style="width:400px"><br>
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="ＯＫ">
    </form>

</body>
</html>