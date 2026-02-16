<?php
// TODO: ID取得とバリデーション
$filename = 'info/info.csv';
$fp = fopen($filename, 'r');

$target = array();

$id = $_GET['id'];

// $_GET['id']とidが一致するやつだけ使いたい～～

if ($fp) {
  while ($row = fgetcsv($fp)) {
    if ($id === $row[0]) {
      $target[] = $row;
      break;
    }
  }

  fclose($fp);
}

// echo "<pre>";
// var_dump($target);
// echo "</pre>";

// TODO: CSV読み込みと記事検索
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

      <h1 class="my-5">お知らせ</h1>
      <!-- TODO: 記事詳細を表示する -->
      <?php if (count($target) > 0): ?>
        <article class="info">
          <header class="info-header">
            <h2 class="info-title"><?php echo $target[0][1] ?></h2>
            <div class="info-data">
              <time datetime="<?php echo $target[0][2] ?>"><?php echo $target[0][2] ?></time>
              <p><?php echo $target[0][3] ?></p>
            </div>
          </header>
          <section>
            <p><?php echo nl2br($target[0][4]) ?></p>
          </section>
        </article>

      <?php else: ?>
        <p>お知らせはありません。</p>
        <p><a href="info_add.php">お知らせ新規登録</a></p>
      <?php endif; ?>







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