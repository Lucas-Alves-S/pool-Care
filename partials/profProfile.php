<?php
require_once("../db.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./partials/login.php");
    exit;
}
$crud = new CRUD();
$userData = $crud->selectuser("profissional", $_SESSION["email"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen">
    <main class="w-screen h-1/2 flex flex-col items-center pt-20" style="background-image: url('../assets/backgroundPerfil.jpg'); background-size: cover; background-position: center;">
        <img
            class="rounded-full min-h-40 max-h-40 min-w-40 max-w-40 w-40 h-40"
            src=".././assets/picture.jpeg"
        alt="">
        <p class="text-xl bg-white rounded-md my-3"><?php echo $userData['nome'] ?></p>
        <div class="buttons flex w-1/2 my-3">
            <a href="./updates/user.php"
                class="edit text-center rounded-lg bg-blue-400 transition duration-700 ease-in-out hover:bg-blue-600 w-full row-span-2 flex items-center justify-center md:row-start-5 md:row-span-2 md:col-span-1 md:h-full md:bg-blue-800 md:hover:bg-indigo-600 py-3">Editar
                Perfil</a>
            <a href="./updates/senha.php?tabela=profissional"
                class="mx-3 changePsw text-center rounded-lg bg-blue-500 transition duration-700 ease-in-out hover:bg-blue-600 w-full row-span-2 flex items-center justify-center md:row-start-5 md:row-span-2 md:col-span-1 md:h-full md:bg-blue-800 md:hover:bg-indigo-700 py-3">
                Alterar Senha</a>
            <a href="../index.html"
                class="mr-3 edit rounded-lg bg-red-500 transition duration-700 ease-in-out hover:bg-red-600 w-full row-span-2 flex items-center justify-center md:row-start-7 md:row-span-2 md:col-span-1 md:h-full md:bg-red-800 md:hover:bg-red-600 py-3">
                Logout</a>
            <form method="POST"
                class="edit cursor-pointer rounded-lg bg-red-500 transition duration-700 ease-in-out hover:bg-red-600 w-full row-span-2 flex items-center justify-center md:row-start-7 md:row-span-2 md:col-span-1 md:h-full md:bg-red-700 md:hover:bg-red-500 py-3">
                <input type="submit" name="deleteUser" id="deleteProfile" value="Excluir Perfil"
                    class="h-full w-full cursor-pointer">
            </form>
        </div>
        <div class="coisas shadow-lg shadow-slate-500/50 w-4/5 bg-slate-100 h-1/3 rounded-lg p-5 flex justify-between mt-12">
            <div class="nota flex flex-col items-center w-1/3 justify-center">
                <div class="value text-5xl">Valor Simbolico</div>
                <div class="desc text-slate-500 bold mt-6">Nota Média</div>
            </div>
            <div class="tempo flex flex-col items-center w-1/3 justify-center border-x-2 border-color-slate-600">
                <div class="value text-5xl">Valor Simbolico</div>
                <div class="desc text-slate-500 bold mt-6">Cadastrado na Plataforma</div>
            </div>
            <div class="servicos flex flex-col items-center w-1/3 justify-center">
                <div class="value text-5xl">Valor Simbolico</div>
                <div class="desc text-slate-500 bold mt-6">Serviços Realizados</div>
            </div>
        </div>
    </main>
</body>
</html>