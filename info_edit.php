<?php
include_once __DIR__ . "/func/functions.php";

$id = (int)$_POST["id"];

try {
    $db = db_connect();
    $sql = "SELECT * FROM info WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id, PDO::PARAM_INT);
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
</head>

<body>

    <?php
    include('navbar.php');
    ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <div>
            <!-- ここから「本文」-->
            <h1 class="my-5">お知らせ - 編集</h1>
            <form action="info_edit_do.php" method="post" class="needs-validation mb-3" novalidate>
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" required value="<?php echo $target["title"]; ?>">
                    <div class="invalid-feedback">

                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="date" class="form-label">投稿日</label>
                        <input type="date" name="date" id="date" class="form-control" value="<?php echo $target["date"]; ?>">
                    </div>
                    <div class="col">
                        <label for="author" class="form-label">投稿者</label>
                        <input type="text" name="author" id="author" class="form-control" required value="<?php echo $target["author"]; ?>">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">本文</label>
                    <textarea name="body" id="body" class="form-control" required><?php echo $target["body"]; ?></textarea>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $target["id"]; ?>">
                    <input type="submit" value="編集する" class="btn btn-primary">
                </div>
            </form>


        </div>
    </main>

</body>

</html>