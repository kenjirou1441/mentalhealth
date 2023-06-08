<?php session_start();
$_SESSION['student_num'] = $_POST["student_num"];
$student_num = $_SESSION['student_num'];
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.css">

    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <title>メンタルヘルス向上アプリ</title>
</head>

<body class="has-background-info is-variable is-6">
    <div style="text-align:center">
        <br>
        <br>
        <h1 class="has-text-black is-size-2 has-text-weight-bold">メンタルヘルス向上アプリ</h1>
        <br>
        <br>
        <br>
        <br>
        <h2 class="has-text-white has-text-weight-bold is-size-4">
            <?php
            $flag = 0;
            try {
                $pdo = new PDO(
                    'mysql:host=hostname;dbname=DB_name;charset=utf8',
                    'table_name',
                    'password'
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $Exception) {
                die('接続エラー：' . $Exception->getMessage());
            }

            try {
                $sql = "SELECT * FROM table1";
                $stmh = $pdo->prepare($sql);
                $stmh->execute();
            } catch (PDOException $Exception) {
                die('接続エラー：' . $Exception->getMessage());
            }
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                if ($student_num == $row['student_num']) {
                    echo $row['name'] . "さんですね？";
                    $_SESSION['name'] = $row['name'];
                    $name = $_SESSION['name'];
                    $flag = 1;
                }
            }
            ?>
        </h2>
        <br>
        <?php if ($flag == 1) { ?>
            <p>
                <input type="button" class="button is-Large is-rounded is-link" onclick="location.href='home.php'" value="はい">
            </p>
            <br>
            <p>
                <input type="button" class="button is-Large is-rounded is-danger" onclick="location.href='top.php'" value="いいえ">
            </p>
        <?php } else {  ?>
            <h2 class="has-text-primary-light has-text-weight-bold is-size-4">
                学籍番号に合うユーザが見つかりませんでした。
            </h2>
            <br>
            <h2 class="has-text-black has-text-weight-bold is-size-4">
                入力間違いか新規登録を行っていない可能性があります。
            </h2>
            <br>
            <br>
            <p>
                <input type="button" class="button is-Large is-rounded is-warning" onclick="location.href='reg.php'" value="新規登録">
            </p>
            <br>
            <br>
            <p>
                <input type="button" class="button is-Large is-rounded is-danger" onclick="location.href='top.php'" value="トップに戻る">
            </p>
        <?php } ?>
    </div>
</body>

</html>
