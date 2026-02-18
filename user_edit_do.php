<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
// ちゃんと受け取ったか

// POST送信されているか
if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['role']) && !empty($_POST['id'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $id = (int)$_POST['id'];
        // 必須項目が入力されているか
        if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['role'])) {
            debug_check_array($_POST);

            // $_POSTから値を取り出す
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // ユーザー名の書式チェック（半角英数　4文字以上)
            if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
                header('location: user_add.php');
                exit();
            }
            // ユーザー名はユニーク制約なので、重複してないかも確認する
            // DB接続(取り出して、比較したい)
            try {
                $db = db_connect();
                // 重複名が存在するかカウント
                $sql = 'SELECT COUNT(name) FROM users WHERE name = :name AND id !=:id';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // // キーが連番の配列で取り出す
                // $result = $stmt->fetch(PDO::FETCH_NUM);
                // debug_check_array($result);

                // $resultが空なら重複なしだが...あるときは弾きたい
                if ($result[0] !== 0) {
                    header('location: user_edit.php');
                }
                // パスワードが入力されていれば、パスワードをハッシュ化する（password_hash）
                if (!empty($password)) {
                    $password_h = password_hash($password, PASSWORD_DEFAULT);
                }

                // DBのusersに登録
                // SQLを再度書く（パスワードの有無で2パターンに分けたい）
                if (!empty($password)) {
                    $sql_2 = 'UPDATE users SET name = :name,password = :password,role = :role WHERE id = :id';
                } else {
                    $sql_2 = 'UPDATE users SET name = :name,role = :role WHERE id = :id';
                }


                $stmt = $db->prepare($sql_2);

                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                if (!empty($password)) {
                    $stmt->bindParam(':password', $password_h, PDO::PARAM_STR);
                }
                $stmt->bindParam(':role', $role, PDO::PARAM_INT);
                $stme->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt->execute();
            } catch (PDOException $e) {
                exit('エラー' . $e->getMessage());
            }
        }
    }
}

header('location: user.php');
