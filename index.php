<?php
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';




// DBから引っ張ってくる
//DBに接続
try {

  $db = db_connect();
  $sql = 'SELECT id,title,date FROM info ORDER BY date DESC';
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
      <a href="info_add.php">お知らせ新規登録</a>
      <ul class="list-group my-3">
        <?php foreach ($result as $row): ?>
          <li class="list-group-item py-3">
            <a href="info.php?id=<?php echo $row["id"] ?>">
              <time datetime="<?php echo $row["date"] ?>" class="post-date"><?php echo $row["date"] ?></time>
              <span class="post-title"><?php echo $row["title"] ?></span>
            </a>

          </li>
        <?php endforeach; ?>
      </ul>



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