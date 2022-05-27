<?php
// 変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm']) ) {
  $page_flag = 1;
} elseif( $_POST['btn_back']) {
  $page_flag =0;
}
?>
<h1>新規登録</h1>
<?php if( $page_flag === 1 ): ?>
<h2>入力内容確認画面</h2>
  <form action="?" method="post">
  <div>
      <label>名前：<label>
      <p><?php echo $_POST['name']; ?></p>
  </div>
  <div>
      <label>メールアドレス：<label>
      <p><?php echo $_POST['address']; ?></p>
  </div>
  <div>
      <label>パスワード：<label>
      <p><?php echo $_POST['pass']; ?></p>
  </div>
  <input type="submit" name="btn_confirm" value="新規登録" formaction="./register.php">
  <input type="submit" name="btn_back" value="戻る">
  <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
  <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
  <input type="hidden" name="pass" value="">
  </form>

<?php else: ?>
  
  <!-- 処理を行う宛先を指定 -->
  <form action="" method="post">
  <div>
      <label>名前：<label>
      <input type="text" name="name" required>
  </div>
  <div>
      <label>メールアドレス：<label>
      <input type="text" name="address" required>
  </div>
  <div>
      <label>パスワード：<label>
      <input type="password" name="pass" required>
  </div>
  <input type="submit" name="btn_confirm" value="入力内容を確認する">
  </form>
<?php endif; ?>
  <p>すでに登録済みの方は<a href="./login_form.php">こちら</a></p>
