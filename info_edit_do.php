<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
// ちゃんと受け取ったか
if (!empty($_POST)) {
    // 必須項目入ってるか
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['body'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $date = empty($_POST['date']) ? date('Y-m-d') : $_POST['date'];
        $id = (int)$_POST['id'];
        // $id = uniqid(); //データベースで主キー設定したので不要


        //DBに接続
        try {
            $db = db_connect();
            $sql = 'UPDATE info SET author = :author, title = :title, body = :body, date = :date WHERE id =:id';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // 登録が終わったので、トップへ遷移
            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            exit("エラー:" . $e->getMessage());
        }
    }
}
