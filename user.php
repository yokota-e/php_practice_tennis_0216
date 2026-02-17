<?php
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';



// DBから引っ張ってくる
//DBに接続
try {

  $db = db_connect();
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

  <?php include('navbar.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">ユーザー</h1>
      <a href="user_add.php">ユーザー新規登録</a>

      <?php

      // memo:追加後、追加した情報を出したい
      // 最後に追加した人の配列
      // 最後の人を示すkey
      // $last_array = array_key_last($result);

      ?>



      <p>ユーザーは登録されていません</p>


      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>