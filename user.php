<?php
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';



// DBから引っ張ってくる
//DBに接続
try {

  $db = db_connect();
  $sql = 'SELECT id,name,role FROM users';
  $stmt = $db->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
  exit("エラー:" . $e->getMessage());
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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



      <!-- ユーザー一覧  -->
      <?php if (count($result) == 0): ?>
        <p>ユーザーは登録されていません</p>

      <?php else: ?>
        <table class="table table-user">
          <thead>
            <tr>
              <th>ID</th>
              <th>ユーザー名</th>
              <th>役割</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $menber): ?>
              <tr>
                <td><?php echo $menber['id'] ?></td>
                <td><?php echo $menber['name'] ?></td>
                <td><?php echo $menber['role'] ?></td>
                <td>
                  <form action="user_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $menber['id'] ?>">
                    <input type="submit" value="編集" class="btn btn-primary">
                  </form>
                  <form action="user_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $menber['id'] ?>">
                    <input type="submit" value="削除" class="btn btn-danger">
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

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