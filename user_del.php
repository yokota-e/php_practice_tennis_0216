<?php
// セッションIDがセットされていない人はログインページに飛ばす
require_once __DIR__ . '/inc/includes-login.php';

include_once __DIR__ . "/func/functions.php";

$id = (int)$_POST["id"];

try {
    $db = db_connect();
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("エラー: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サークルサイト</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php
    include('navbar.php');
    ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->
            <h1 class="my-5">ユーザー - 削除確認</h1>
            <!-- 削除ユーザー表示 -->
            <p>ユーザー「<?php echo $target['name'] ?>」を削除してよろしいですか？</p>

            <a href="./user.php" class="btn btn-primary">ユーザー一覧に戻る</a>
            <form action="user_del_do.php" method="post">
                <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
                <input type="submit" value="削除" class="btn btn-danger">

            </form>

        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
</body>

</html>