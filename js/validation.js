
const inputName = document.getElementById("name");
const inputAddr = document.getElementById("address");
const inputPass = document.getElementById("pass");

const targetName = document.getElementById("name-result");
const targetAddr = document.getElementById("address-result");
const targetPass = document.getElementById("pass-result");

const noNumPattern = /^(?!.*[0-9０-９]+).*$/;
const noSpacePattern = /^(?!.*[ |　]+).*$/;
const addrPattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/; //alp,num,
const passPattern = /^(?=.*?[a-z])(?=.*?\d)(?=.*?[A-Z])(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}$/i;

inputName.addEventListener("input", (e) => {
if (noSpacePattern.test(inputName.value) && (noNumPattern.test(inputName.value))) {
    targetName.textContent = "";
  } else {
    targetName.textContent = "don't use degits or space";
  }
})

inputAddr.addEventListener("input", (e) => {
  if (addrPattern.test(inputAddr.value)) {
    targetAddr.textContent = "";
  } else {
    targetAddr.textContent = "not email";
  }
})

inputPass.addEventListener("input", (e) => {
  if (passPattern.test(inputPass.value)) {
    targetPass.textContent = "";
  } else {
    targetPass.textContent = "unfair";
  }
})

