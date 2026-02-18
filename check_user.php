<?php
session_start();
// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';

// POST受け取れているか
if (!empty($_POST)) {
    // 必須項目が取れているか
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];


        // DB接続　ユーザー名があるか検証
        try {
            $db = db_connect();
            $sql = 'SELECT * FROM users WHERE name =:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // debug_check_array($result);
            // $resultは、虚無のユーザー相手にはfalseになる

            // ユーザーが存在していたら認証作業続行
            if ($result) {
                // パスワードの検証(POSTで受け取ったパスワード,SELECTで取得したハッシュ化パスワードが引数)
                if (password_verify($password, $result['password'])) {
                    $_SESSION['id'] = session_id();
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['roles'] = $result['role'];


                    header('location: index.php');
                }
            }
        } catch (PDOException $e) {
            exit('エラー:' . $e->getMessage());
        }
    }
}

header('location: login.php');
