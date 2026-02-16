<?php

// ---------------
// TODO: CSV読み込み処理
$filename = 'info/info.csv';
$fp = fopen($filename, 'r');

$info_array = array();

if ($fp) {
  while ($row = fgetcsv($fp)) {
    // このページに必要な情報を抜粋した配列を作る
    $info_array[] = [$row[0], $row[1], $row[2]];
  }
  fclose($fp);
}
// ----------------

// TODO: ソート処理
// 投稿日の降順（新しい順）に並べ替え
if (!empty($info_array)) {

  // $info_array の日付だけ抜き出した$date配列を作る
  $date = array_column($info_array, 2);

  // $dateを目安に$info_arrayを並び替える
  // SORT_DESCで降順、SORT_ASCで昇順
  array_multisort($date, SORT_ASC, $info_array);
}
// ----------------



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
      <a href="info_add.php">お知らせ新規登録</a>
      <!-- 読み込めなかった・空の配列を読み込んだ時を想定し、中身入りの配列を読み込んだ時として記述 -->
      <?php if (count($info_array) > 0): ?>
        <ul class="list-group my-3">
          <!-- TODO: 記事一覧を表示する -->

          <!-- <li>記入例 -->
          <!-- <li class="list-group-item py-3">
            <a href="info.php?id=698d62743ac1c" class="post-link">
              <time datetime="2026-06-02" class="post-date">2026-06-02</time>
              <span class="post-title">タイトル</span>
            </a>
          </li>
          <li>を全部並べた場合 -->
          <!-- <?php
                foreach ($info_array as $data):
                ?>
            <li class="list-group-item py-3">
              <a href="info.php?id=<?php echo $data[0] ?>" class="post-link">
                <time datetime="<?php echo $data[2] ?>" class="post-date"><?php echo $data[2] ?></time>
                <span class="post-title"><?php echo $data[1] ?></span>
              </a>
            </li>
          <?php endforeach; ?> -->


          <!-- ページング対応版 -->
          <?php
          // 初期位置ページ
          $page = 1;
          // 1ページあたりの表示件数
          $num = 4;
          // 配列を分割する
          $chunks = array_chunk($info_array, $num);
          ?>

          <?php
          // GETでページ数が指定されていた場合
          if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = intval($_GET['page']);
            // もし存在しなければ↓$pageを1にする
            if (!isset($chunks[$page - 1])) {
              $page = 1;
            }
          }
          ?>

          <!-- リスト表示 -->
          <?php
          foreach ($chunks[$page - 1] as $item):
          ?>

            <li class="list-group-item py-3">
              <a href="info.php?id=<?php echo $item[0] ?>" class="post-link">
                <time datetime="<?php echo $item[2] ?>" class="post-date"><?php echo $item[2] ?></time>
                <span class="post-title"><?php echo $item[1] ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>



        <nav>
          <ul>
            <?php for ($i = 1; $i <= count($chunks); $i++): ?>
              <li>
                <a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>

      <?php else: ?>
        <p>お知らせはありません。</p>
      <?php endif; ?>
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