<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
// ちゃんと受け取ったか
if (!empty($_POST)) {
    // 必須項目入ってるか
    if (!empty($_POST['id'])) {

        $id = $_POST['id'];
        // $id = uniqid(); //データベースで主キー設定したので不要


        //DBに接続
        try {
            $db = db_connect();
            $sql = 'DELETE FROM users WHERE id = :id';
            $stmt = $db->prepare($sql);


            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // 登録が終わったので、トップへ遷移
            header('Location: user.php');
            exit();
        } catch (PDOException $e) {
            exit("エラー:" . $e->getMessage());
        }
    }
}
