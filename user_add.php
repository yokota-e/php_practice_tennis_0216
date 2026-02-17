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
      <h1 class="my-5">ユーザー新規登録</h1>
      <!-- ここから「本文」-->
      <form action="user_add_do.php" method="post">


        <div class="row">
          <!-- ユーザー名 -->
          <div class="mb-3 col">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="ユーザー名">
          </div>
          <!-- パスワード -->
          <div class="mb-3 col">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="name" id="password" class="form-control" placeholder="パスワード">
          </div>
        </div>

        <!-- 役割ラジオボタン -->

        <p class="form-label">役割</p>
        <!-- 管理者 -->
        <div class="mb-3 form-check form-check-inline">
          <label for="role1" class="form-check-label">管理者</label>
          <input type="radio" name="role" id="role1" value="1" class="form-check-input">
        </div>
        <!-- 一般 -->
        <div class="mb-3 form-check form-check-inline">
          <label for="role2" class="form-check-label">一般</label>
          <input type="radio" name="role" id="role2" value="2" class="form-check-input" checked>
        </div>

        <!-- btn -->
        <div class="mb-3">
          <input type="submit" value="登録する" class="btn btn-primary">
        </div>

      </form>
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