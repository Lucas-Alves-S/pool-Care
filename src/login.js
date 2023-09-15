var pswInput = document.getElementById("senha");
var svg = document.getElementById("eye");

function viewPSW() {
  if (pswInput.type === "password") {
    pswInput.type = "text";
    svg.src = "../../assets/eye-open-svgrepo-com.svg";
  } else if (pswInput.type === "text") {
    pswInput.type = "password";
    svg.src = "../../assets/eye-closed-svgrepo-com.svg";
  }
  console.log(pswInput.type);
}