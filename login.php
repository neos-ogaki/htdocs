<link rel="stylesheet" href="./css/login.CSS">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
 $name = $_POST['name'];
// $dsn = "mysql:host=localhost; 3306; charset=utf8";
// $username = "root";
// $password = "root";
// try {
//     $dbh = new PDO($dsn, $username, $password);
// } catch (PDOException $e) {
//     $msg = $e->getMessage();
// }

$dsn = "mysql:host=localhost;dbname=mysql; charset=utf8";
$username = "root";
$password = "root";
try {
    // echo "接続成功\n";
    $pdo = new PDO($dsn, $username, $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo "接続失敗です" . $msg;
}

$sql = "SELECT * FROM users WHERE name = :name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->execute();
$member = $stmt->fetch();

if (password_verify($_POST['pass'], $member['pass'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $_SESSION['adress'] = $member['address'];
    $msg = 'ログインしました。';
    $link = '<a href="/test_reserve.php">ホーム</a>';
} else {
    $msg = '名前もしくはパスワードが間違っています。';
    $link = '<a href="login_form.php">戻る</a>';
}
?>
<div class="message">
  <h2><?php echo $msg; ?></h2>
</div>
<div class="return">
  <?php echo $link; ?>
</div>