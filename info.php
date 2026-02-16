<?php
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';


$id = $_GET['id'];
echo $id;

// DBから引っ張ってくる
//DBに接続
try {

  $db = db_connect();
  $sql = 'SELECT * FROM info WHERE id = $id ';
  $stmt = $db->prepare($sql);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  var_dump($result);
  echo '</pre>';
} catch (PDOException $e) {
  exit("エラー:" . $e->getMessage());
}

?>
<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <!-- <?php include('navbar.php');  ?> -->

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">お知らせ</h1>
      <!-- TODO: 記事詳細を表示する -->




      <p><a href="info_add.php">お知らせ新規登録</a></p>








      <p><a href="./">トップページへ戻る</a></p>

      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
</body>

</html>