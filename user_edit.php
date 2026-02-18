<?php
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';

$id = (int)$_POST["id"];
$roles = get_roles_list();
try {
  $db = db_connect();
  $sql = "SELECT id,name,role FROM users WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);
  $stmt->execute();

  $target = $stmt->fetch(PDO::FETCH_ASSOC);
  // debug_check_array($target);
} catch (PDOException $e) {
  exit("エラー: " . $e->getMessage());
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
      <h1 class="my-5">ユーザー - 変更</h1>
      <!-- ここから「本文」-->
      <form action="user_edit_do.php" method="post">


        <div class="row">
          <!-- ユーザー名 -->
          <div class="mb-3 col">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $target['name'] ?>">
          </div>
          <!-- パスワード -->
          <div class="mb-3 col">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="パスワード">
          </div>

        </div>

        <!-- 役割ラジオボタン -->

        <p class="form-label">役割</p>
        <!-- 役割配列を使用してラジオボタンを表示 -->
        <?php foreach ($roles as $id => $rolename): ?>
          <div class="mb-3 form-check form-check-inline">
            <label for="role<?php echo $id ?>" class="form-check-label"><?php echo $rolename ?></label>
            <input type="radio" name="role" id="role<?php echo $id ?>" value="<?php echo $id ?>" class="form-check-input"
              <?php echo $id === $target['role'] ? 'checked' : ''; ?>>
          </div>

        <?php endforeach; ?>


        <!-- btn -->
        <div class="mb-3">
          <input type="hidden" name="id" value="<?php echo $target['id'] ?>">
          <input type="submit" value="変更する" class="btn btn-primary">
        </div>

      </form>
      <!-- 本文ここまで -->
    </div>
    <a href="./user.php" class="btn">ユーザー一覧に戻る</a>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>