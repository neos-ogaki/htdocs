var inputName = document.getElementById("name");
var inputAddr = document.getElementById("address");
var inputPass = document.getElementById("pass");
var inputSubmit = document.getElementById("submit");

var targetName = document.getElementById("name-result");
var targetAddr = document.getElementById("address-result");
var targetPass = document.getElementById("pass-result");

var noNumPattern   = /^(?!.*[0-9０-９]+).*$/;
var noSpacePattern = /^(?!.*[ |　]+).*$/;
var addrPattern    = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
var passPattern    = /^(?=.*?[a-z])(?=.*?\d)(?=.*?[A-Z])(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}$/i;

function total_validate() {
  if (targetName.textContent == "" && targetAddr.textContent == "" && targetPass.textContent == "") {
    return true;
  }
}

inputName.addEventListener("blur", (e) => {
  if (!(noSpacePattern.test(inputName.value) && (noNumPattern.test(inputName.value)))) {
    targetName.textContent = "名前に数字や空白を使用しないでください";
    inputSubmit.disabled = true;
  } else if (inputName.value == "") {
    targetName.textContent = "必ず入力してください"
    inputSubmit.disabled = true;
  } else {
    targetName.textContent = "";
    inputSubmit.disabled = false;
  }
});

inputAddr.addEventListener("input", (e) => {
  if (!(addrPattern.test(inputAddr.value))) {
    targetAddr.textContent = "Eメールアドレスの形式ではありません";
    inputSubmit.disabled = true;
  } else {
    targetAddr.textContent = "";
    inputSubmit.disabled = false;
  }
});

inputPass.addEventListener("input", (e) => {
  if (!(passPattern.test(inputPass.value))) {
    targetPass.textContent = "パスワードには大文字、数字、記号をひとつ以上含めてください";
    inputSubmit.disabled = true;
  } else {
    targetPass.textContent = "";
    inputSubmit.disabled = false;
  }
});
