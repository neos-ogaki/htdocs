<link rel="stylesheet" href="./css/login.css">
<!-- お目目 -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script>
  function pushHideButton() {
      var txtPass = document.getElementById("pass");
      var btnEye = document.getElementById("buttonEye");
      if (txtPass.type === "text") {
        txtPass.type = "password";
        btnEye.className = "fa fa-eye";
      } else {
        txtPass.type = "text";
        btnEye.className = "fa fa-eye-slash";
      }
    }
</script>
<div class="main">
  <h2>ログインページ</h2>
  <div class="form-box">
  <form action="./login.php" method="post">
  <div class="form-list">
      <label>名前</label>
      <input type="text" name="name" required>
  </div>
  <div class="form-list">
      <label>パスワード：</label><span id="pass-result"></span>
      <div class="box">
        <input id="pass" type="password" name="pass" required>
        <p id="buttonEye" class="fa fa-eye" onclick="pushHideButton()"></p>
      </div>
  </div>
  <input type="submit" value="ログイン">
  </form>
</div>
<div class="coment">
  <p>新規登録は<a href="./signup.php">こちら</a></p>
</div>
</div>