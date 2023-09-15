<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-screen h-screen flex flex-col items-center">
        <img
            class="rounded-full min-h-40 max-h-40 min-w-40 max-w-40 w-40 h-40"
            src=".././assets/picture.jpeg"
        alt="">
        <div class="coisas shadow-lg shadow-slate-500/50 w-4/5 bg-slate-100 h-1/5 rounded-lg p-5 flex justify-between">
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