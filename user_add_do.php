<?php
// めあて：ユーザー情報を登録する

// functions.phpを読み込む
require_once __DIR__ . '/func/functions.php';


// POST送信されているか
if (!empty($_POST)) {



    // 必須項目が入力されているか


    // $_POSTから値を取り出す


    // ユーザー名の書式チェック（半角英数　4文字以上。ユニーク制約なので、重複してないかも確認する）


    // パスワードをハッシュ化する（password_hash）



    // DBと接続し、usersに登録




    // 終了したらページ遷移



}

// POST送信されていない時もページ遷移
header('location: user.php');
