<?php
require_once("../db.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./partials/login.php");
    exit;
}
$crud = new CRUD();
$userData = $crud->selectuser("user", $_SESSION["email"]);
$link = "./partials/cadastroPool.php";

$piscinas = $crud->selectpiscina('fk_user_id', $userData['user_id']);
if ($piscinas[2] != "") {
    $link = "";
}

if (isset($_POST['sair'])) {
    session_destroy();
    session_unset();
    header("../index.html");
}

if (isset($_POST['deleteUser'])) {
    $crud->delete('user', $userData['user_id']);
}

if (isset($_POST['delete1']) && isset($piscinas[0])) {
    $crud->deletePool($piscinas[0]['piscina_id']);
    $piscinas[0] = null;
}
if (isset($_POST['delete2']) && isset($piscinas[1])) {
    $crud->deletePool($piscinas[1]['piscina_id']);
    $piscinas[1] = null;
}
if (isset($_POST['delete3']) && isset($piscinas[2])) {
    $crud->deletePool($piscinas[2]['piscina_id']);
    $piscinas[2] = null;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="../../dist/output.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/1700bbdba7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 500
    }
</style>

<body>
    <div class="all flex flex-col md:flex-row">
        <div
            class="profile container flex flex-col items-center text-2xl p-5 md:w-1/4 md:h-screen md:shadow-2xl md:shadow-black md:z-10 md:bg-slate-700 md:text-white w-screen ">
            <div class="avatar rounded-full h-1/3 md:h-auto bg-black mb-8 "><img
                    class="rounded-full min-h-40 max-h-40 min-w-40 max-w-40 w-40 h-40"
                    src=<?php
if ($userData['urlPhoto'] != "") {
    echo $userData['urlPhoto'];
}
else {
    echo ".././assets/picture.jpeg";
}
            ?>
                    alt="">
            </div>
            <div class="data w-full grid grid-rows-8 grid-cols-2 gap-3 h-fit">
                <div class="name flex w-full col-span-2">
                    <span class="material-symbols-outlined mt-1 text-sky-600 ">
                        person
                    </span>
                    <p class="text-left ml-3" id="user">
                        <?php echo $userData['nome'] ?>
                    </p>
                </div>
                <div class="mail flex w-full col-span-2" onmouseover="removeTruncate()" onmouseleave="addTruncate()">
                    <span class="material-symbols-outlined mt-1 text-sky-600 ">
                        mail
                    </span>
                    <p class="text-left ml-3 truncate hover:bg-slate-700 rounded-md pr-2 cursor-default" id="email">
                        <?php echo $userData['email'] ?>
                    </p>
                </div>
                <div class="phone flex w-full col-span-2">
                    <span class="material-symbols-outlined mt-1 text-sky-600 ">
                        call
                    </span>
                    <p class="text-left ml-3" id="phone">
                        <?php
                        if ($userData['telefone'] != '')
                            echo $userData['telefone'];
                        else
                            echo 'Você não cadastrou esses dados';
                        ?>
                    </p>
                </div>
                <div class="address flex w-full col-span-2">
                    <span class="material-symbols-outlined mt-1 text-sky-600 ">
                        home
                    </span>
                    <p class="text-left ml-3" id="address">
                        <?php
                        if ($userData['endereco'] != '')
                            echo $userData['endereco'];
                        else
                            echo 'Você não cadastrou esses dados';
                        ?>
                    </p>
                </div>
                <a href="./update.php?pagina=user"
                    class="edit text-center rounded-lg bg-blue-400 transition duration-700 ease-in-out hover:bg-blue-600 w-full row-span-2 flex items-center justify-center md:row-start-5 md:row-span-2 md:col-span-1 md:h-full md:bg-blue-800 md:hover:bg-indigo-600 py-3">Editar
                    Perfil</a>
                <a href="./updates/senha.php?tabela=user"
                    class="changePsw text-center rounded-lg bg-blue-500 transition duration-700 ease-in-out hover:bg-blue-600 w-full row-span-2 flex items-center justify-center md:row-start-5 md:row-span-2 md:col-span-1 md:h-full md:bg-blue-800 md:hover:bg-indigo-700 py-3">
                    Alterar Senha</a>
                <form method="POST"
                    class="edit rounded-lg bg-red-500 transition duration-700 ease-in-out hover:bg-red-600 w-full row-span-2 flex items-center justify-center md:row-start-7 md:row-span-2 md:col-span-1 md:h-full md:bg-red-800 md:hover:bg-red-600 py-3">
                    <input type="submit" name="sair" id="logout" value="Logout"
                    class="h-full w-full cursor-pointer">
                </form>
                <form method="POST"
                    class="edit cursor-pointer rounded-lg bg-red-500 transition duration-700 ease-in-out hover:bg-red-600 w-full row-span-2 flex items-center justify-center md:row-start-7 md:row-span-2 md:col-span-1 md:h-full md:bg-red-700 md:hover:bg-red-500 py-3">
                    <input type="submit" name="deleteUser" id="deleteProfile" value="Excluir Perfil"
                        class="h-full w-full cursor-pointer">
                </form>

            </div>
        </div>
        <div class="pools flex p-10 w-screen h-full md:h-screen bg-blue-50 md:z-0 md:p-20 flex-row flex-wrap ">
            <a href="<?php echo $link; ?>" id="btnAddPool" onclick="avisoConta()"
                class="bg-white/[0.4] h-1/4 md:flex-1 w-full mb-4 md:mx-4 shadow-2xl shadow-slate-400/50 rounded-xl cursor-pointer p-5 hover:bg-slate-400/[0.4] transition duration-700 ease-in-out hover:shadow-slate-800/50 text-3xl text-center flex flex-col md:h-1/5 md:w-auto flex-0">
                Adicionar
                <svg xmlns="http://www.w3.org/2000/svg" class="md:p-4 md:w-auto w-1/4 self-center"
                    viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                <strong class="text-sky-500">Piscina</strong>
            </a>
            <div
                class="relative bg-white/[0.4] h-1/4 md:flex-1 w-full mb-4 md:mx-4 shadow-2xl shadow-slate-400/50 rounded-xl p-5 md:h-1/5 md:w-auto flex-0"
                id="poolCard1">
                <div id="pool1" class="content h-full flex flex-col justify-between w-4/5">
                    <?php
                    if ($piscinas[0] == "") {
                    } else {
                        if($piscinas[0]['proximaLimpeza'] == '0000-00-00') {
                            $piscinas[0]['proximaLimpeza'] = "";
                        }
                        if($piscinas[0]['ultimaLimpeza'] == '0000-00-00') {
                            $piscinas[0]['ultimaLimpeza'] = "";
                        }
                        echo "<p>Apelido: " . $piscinas[0]['nome'] . "</p>";
                        echo "<p>Próxima Limpeza: " . $piscinas[0]['proximaLimpeza'] . "</p>";
                        echo "<p>Última Limpeza: " . $piscinas[0]['ultimaLimpeza'] . "</p>";
                        echo "<a href='./pool.php?id={$piscinas[0]['piscina_id']}' class='rounded-lg bg-blue-500 p-3'>Fazer Cálculos</a>";
                        $_SESSION['poolNameOne'] = $piscinas[0]['nome'];
                    }
                    ?>
                </div>
                <form id="btnPool1" method="POST"
                    class="absolute top-1 right-0 h-6 w-6 z-100 text-red-500 hover:text-red-200">
                    <i class="fa-solid fa-trash-can cursor-pointer"
                        onclick="emulateInput(document.getElementById('delete1'))"></i>
                    <input id="delete1" class="hidden" type="submit" name="delete1">
                </form>
                <a href="<?php echo "./updates/piscina.php?id={$piscinas[0]['piscina_id']}" ?>" id="editBtn1" class="absolute bottom-0 right-0 h-fit w-fit z-100 hover:text-slate-700"><span
                        class="material-symbols-outlined">
                        edit
                    </span>
                </a>
            </div>
            <div
                class="relative bg-white/[0.4] h-1/4 md:flex-1 w-full mb-4 md:mx-4 shadow-2xl shadow-slate-400/50 rounded-xl p-5 md:h-1/5 md:w-auto flex-0"
                id="poolCard2">
                <div id="pool2" class="content h-full flex flex-col justify-between w-4/5">
                    <?php
                    if ($piscinas[1] == "") {
                    } else {
                        if($piscinas[1]['proximaLimpeza'] == '0000-00-00') {
                            $piscinas[1]['proximaLimpeza'] = "";
                        }
                        if($piscinas[1]['ultimaLimpeza'] == '0000-00-00') {
                            $piscinas[1]['ultimaLimpeza'] = "";
                        }
                        echo "<p>Apelido: " . $piscinas[1]['nome'] . "</p>";
                        echo "<p>Próxima Limpeza: " . $piscinas[1]['proximaLimpeza'] . "</p>";
                        echo "<p>Última Limpeza: " . $piscinas[1]['ultimaLimpeza'] . "</p>";
                        echo "<a href='./pool.php?id={$piscinas[1]['piscina_id']}' class='rounded-lg bg-blue-500 p-3'>Fazer Cálculos</a>";
                        $_SESSION['poolNameTwo'] = $piscinas[1]['nome'];
                    }
                    ?>
                </div>
                <form id="btnPool2" method="post"
                    class="absolute top-1 right-0 h-6 w-6 z-100 text-red-500 hover:text-red-200">
                    <i class="fa-solid fa-trash-can cursor-pointer"
                        onclick="emulateInput(document.getElementById('delete2'))"></i>
                    <input id="delete2" class="hidden" type="submit" name="delete2">
                </form>
                <a href="<?php echo "./updates/piscina.php?id={$piscinas[1]['piscina_id']}" ?>" id="editBtn2" class=" absolute bottom-0 right-0 hfit5 wfit5 z-10 hover:text-slate-700"><span
                        class="material-symbols-outlined">
                        edit
                    </span>
                </a>
            </div>
            <div
                class="relative bg-white/[0.4] h-1/4 md:flex-1 w-full mb-4 md:mx-4 shadow-2xl shadow-slate-400/50 rounded-xl p-5 md:h-1/5 md:w-auto flex-0"
                id="poolCard3">
                <div id="pool3" class="content h-full flex flex-col justify-between w-4/5">
                    <?php
                    if ($piscinas[2] == "") {
                    } else {
                        if($piscinas[2]['proximaLimpeza'] == '0000-00-00') {
                            $piscinas[2]['proximaLimpeza'] = "";
                        }
                        if($piscinas[2]['ultimaLimpeza'] == '0000-00-00') {
                            $piscinas[2]['ultimaLimpeza'] = "";
                        }
                        echo "<p>Apelido: " . $piscinas[2]['nome'] . "</p>";
                        echo "<p>Próxima Limpeza: " . $piscinas[2]['proximaLimpeza'] . "</p>";
                        echo "<p>Última Limpeza: " . $piscinas[2]['ultimaLimpeza'] . "</p>";
                        echo "<a href='./pool.php?id={$piscinas[2]['piscina_id']}' class='rounded-lg bg-blue-500 p-3'>Fazer Cálculos</a>";
                        $_SESSION['poolNameThree'] = $piscinas[2]['nome'];
                    }
                    ?>
                </div>
                <form id="btnPool3" method="post"
                    class="absolute top-1 right-0 h-6 w-6 z-100 text-red-500 hover:text-red-200">
                    <i class="fa-solid fa-trash-can cursor-pointer"
                        onclick="emulateInput(document.getElementById('delete3'))"></i>
                    <input id="delete3" class="hidden" type="submit" name="delete3">
                </form>
                <a href="<?php echo "./updates/piscina.php?id={$piscinas[2]['piscina_id']}" ?>" id="editBtn3" class=" absolute bottom-0 right-0 hfit5 wfit5 z-10 hover:text-slate-700"><span
                        class="material-symbols-outlined">
                        edit
                    </span>
                </a>
            </div>
        </div>
        <script src="../src/profile.js"></script>
</body>

</html>