var pswInput = document.getElementById("senha");
var RpswInput = document.getElementById("repetSenha");

var svg = document.getElementById("eye");
var Rsvg = document.getElementById("Reye");

function viewPSW(input, SVG) {
  if (input.type === "password") {
    input.type = "text";
    SVG.src = "../../assets/eye-open-svgrepo-com.svg";
  } else if (input.type === "text") {
    input.type = "password";
    SVG.src = "../../assets/eye-closed-svgrepo-com.svg";
  }
}

var btn = document.getElementById("btnRegister")

function password() {
    if (pswInput.value == RpswInput.value) {
        console.log("AUTORIZADO")
        btn.disabled = false;
        btn.classList.remove('bg-red-600')
        btn.classList.add('bg-sky-500')
        btn.classList.add('hover:bg-sky-400')
    }
    else {
        console.log("SAI DEMONIO")
        btn.disabled = true;
        btn.classList.add('bg-red-600')
        btn.classList.remove('bg-sky-500')
        btn.classList.remove('hover:bg-sky-400')
    }
}
