<?php
require_once("../../db.php");
require_once("../../library/PHPMailer/mail.php");
session_start();
$crud = new CRUD();
$userData = $crud->selectuser($_GET['tabela'], $_SESSION["email"]);
$email = $userData['email'];
$nome = $userData['nome'];
$code = $userData['verify_cod'];
/* sendEmail($email, $nome, $code); */

if (isset($_POST['submit'])) {
    $novasenha = $_POST['psw'];
    $verify_code = $_POST['code'];
    $crud->updatesenha("{$_GET['tabela']}", $novasenha, $verify_code);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <svg class="absolute top-0" id="wave" style="transform: rotate(180deg); transition: 0.3s" viewBox="0 0 1440 120"
    version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(14, 165, 233, 1)" offset="0%"></stop>
        <stop stop-color="rgba(37, 99, 235, 1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform: translate(0, 0px); opacity: 1" fill="url(#sw-gradient-0)"
      d="M0,48L30,40C60,32,120,16,180,22C240,28,300,56,360,60C420,64,480,44,540,46C600,48,660,72,720,80C780,88,840,80,900,80C960,80,1020,88,1080,80C1140,72,1200,48,1260,42C1320,36,1380,48,1440,60C1500,72,1560,84,1620,74C1680,64,1740,32,1800,18C1860,4,1920,8,1980,16C2040,24,2100,36,2160,42C2220,48,2280,48,2340,42C2400,36,2460,24,2520,22C2580,20,2640,28,2700,38C2760,48,2820,60,2880,56C2940,52,3000,32,3060,32C3120,32,3180,52,3240,60C3300,68,3360,64,3420,54C3480,44,3540,28,3600,24C3660,20,3720,28,3780,44C3840,60,3900,84,3960,86C4020,88,4080,68,4140,62C4200,56,4260,64,4290,68L4320,72L4320,120L4290,120C4260,120,4200,120,4140,120C4080,120,4020,120,3960,120C3900,120,3840,120,3780,120C3720,120,3660,120,3600,120C3540,120,3480,120,3420,120C3360,120,3300,120,3240,120C3180,120,3120,120,3060,120C3000,120,2940,120,2880,120C2820,120,2760,120,2700,120C2640,120,2580,120,2520,120C2460,120,2400,120,2340,120C2280,120,2220,120,2160,120C2100,120,2040,120,1980,120C1920,120,1860,120,1800,120C1740,120,1680,120,1620,120C1560,120,1500,120,1440,120C1380,120,1320,120,1260,120C1200,120,1140,120,1080,120C1020,120,960,120,900,120C840,120,780,120,720,120C660,120,600,120,540,120C480,120,420,120,360,120C300,120,240,120,180,120C120,120,60,120,30,120L0,120Z">
    </path>
  </svg>
  <form method="POST" class="container min-w-full min-h-screen grid">
    <div
      class="login p-4 h-96 w-80 self-center justify-self-center shadow-lg shadow-gray-400/40 rounded-lg grid grid-cols-1 gap-3 grid-rows-4">
      <div class="Code">
        <label for="code">Código recebido por email</label> <br />
        <div class="relative">
          <input id="security_code"
            class="border border-sky-500 rounded-full h-12 min-w-full focus:outline-none focus:ring focus:ring-sky-500 p-2"
            type="text" name="code" required />
        </div>
      </div>
      <div class="psw">
        <label for="psw">Senha</label> <br />
        <div class="relative">
          <input id="senha"
            class="border border-sky-500 rounded-full h-12 min-w-full focus:outline-none focus:ring focus:ring-sky-500 p-2"
            type="password" name="psw"  required />
          <i class="absolute top-0 right-0 h-full w-5 flex items-center justify-center mr-4 cursor-pointer"
            onclick="viewPSW(document.getElementById('senha'), document.getElementById('eye'))">
            <img id="eye" src="../../assets/eye-closed-svgrepo-com.svg"></img>
          </i>
        </div>
      </div>
      <div class="Rpsw">
        <label for="Rpsw">Repetir Senha</label> <br />
        <div class="relative">
          <input id="repetSenha"
            class="border border-sky-500 rounded-full h-12 min-w-full focus:outline-none focus:ring focus:ring-sky-500 p-2"
            type="password" name="Rpsw" oninput="password()" required />
          <i class="absolute top-0 right-0 h-full w-5 flex items-center justify-center mr-4 cursor-pointer"
            onclick="viewPSW(document.getElementById('repetSenha'), document.getElementById('Reye'))">
            <img id="Reye" src="../../assets/eye-closed-svgrepo-com.svg"></img>
          </i>
        </div>
      </div>
      <input type="submit" name="submit" class="cursor-pointer text-xl rounded-lg bg-sky-500 transition duration-700 ease-in-out hover:bg-sky-400" value="Alterar Senha" id="changePsw">
      </input>
    </div>
  </form>
  <svg class="absolute bottom-0" id="wave" style="transform: rotate(0deg); transition: 0.3s" viewBox="0 0 1440 120"
    version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(124, 58, 237, 1)" offset="0%"></stop>
        <stop stop-color="rgba(99, 102, 241, 1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform: translate(0, 0px); opacity: 1" fill="url(#sw-gradient-0)"
      d="M0,48L30,40C60,32,120,16,180,22C240,28,300,56,360,60C420,64,480,44,540,46C600,48,660,72,720,80C780,88,840,80,900,80C960,80,1020,88,1080,80C1140,72,1200,48,1260,42C1320,36,1380,48,1440,60C1500,72,1560,84,1620,74C1680,64,1740,32,1800,18C1860,4,1920,8,1980,16C2040,24,2100,36,2160,42C2220,48,2280,48,2340,42C2400,36,2460,24,2520,22C2580,20,2640,28,2700,38C2760,48,2820,60,2880,56C2940,52,3000,32,3060,32C3120,32,3180,52,3240,60C3300,68,3360,64,3420,54C3480,44,3540,28,3600,24C3660,20,3720,28,3780,44C3840,60,3900,84,3960,86C4020,88,4080,68,4140,62C4200,56,4260,64,4290,68L4320,72L4320,120L4290,120C4260,120,4200,120,4140,120C4080,120,4020,120,3960,120C3900,120,3840,120,3780,120C3720,120,3660,120,3600,120C3540,120,3480,120,3420,120C3360,120,3300,120,3240,120C3180,120,3120,120,3060,120C3000,120,2940,120,2880,120C2820,120,2760,120,2700,120C2640,120,2580,120,2520,120C2460,120,2400,120,2340,120C2280,120,2220,120,2160,120C2100,120,2040,120,1980,120C1920,120,1860,120,1800,120C1740,120,1680,120,1620,120C1560,120,1500,120,1440,120C1380,120,1320,120,1260,120C1200,120,1140,120,1080,120C1020,120,960,120,900,120C840,120,780,120,720,120C660,120,600,120,540,120C480,120,420,120,360,120C300,120,240,120,180,120C120,120,60,120,30,120L0,120Z">
    </path>
  </svg>
  <script src="../../src/cadastro.js"></script>


</body>