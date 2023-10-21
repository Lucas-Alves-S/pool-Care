<?php
require_once(".././db.php");
session_start();
if (!isset($_SESSION['email'])) {
    $piscinas[0]['nome'] = "Piscina de Convidado";
    $piscinas[0]['largura'] = 4;
    $piscinas[0]['comprimento'] = 3.5;
    $piscinas[0]['altura'] = 1.7;
} else {
$crud = new CRUD();
$piscinas = $crud->selectpiscina('piscina_id', $_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <title>My Pool</title>
</head>
<style>
    body {
        font-family: 'Work Sans', sans-serif;
    }
</style>
<body class="p-0 m-0 text-xl">
    <div class="md:h-screen flex flex-col md:flex-row md:bg-[#0b131e]">
        <svg class="absolute top-0 md:hidden bg-[#202c3c]" id="wave" style="transform: rotate(180deg); transition: 0.3s" viewBox="0 0 1440 120"
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

        <div class="scene w-full md:w-1/2 mt-8 rounded-lg flex justify-center items-center md:m-3 md:rounded-[2rem] p-0 md:bg-[#202c3c]"
            id="canvas-container">
        </div>
        <main class="flex flex-col items-center md:justify-center md:text-white md:h-full md:w-1/2">
            <h1 class="text-7xl">P.H. & Cloro</h1>
            <p>Medidas de <?php echo "{$piscinas[0]['nome']}: {$piscinas[0]['largura']}m X {$piscinas[0]['comprimento']}m X {$piscinas[0]['altura']}m"?></p>
            <p>Lítros: <?php echo $piscinas[0]['largura'] * $piscinas[0]['comprimento'] * $piscinas[0]['altura'] * 1000?></p>
            <form method="POST" class="flex flex-col md:my-5" id="formulario">
                <label for="ph">Informe o valor do P.H.</label>
                <input type="number" step="0.01" required name="ph" id="ph" class="border border-sky-500 rounded-full focus:outline-none focus:ring focus:ring-sky-500 p-1 md:bg-[#0b131e]">

                <label for="cloro">Informe o nível de Cloro</label>
                <input type="number" step="0.01" required name="cloro" id="cloro" class="border border-sky-500 rounded-full focus:outline-none focus:ring focus:ring-sky-500 p-1 md:bg-[#0b131e]">
                <a href="./oquefazer.php">Não sei calcular valor do P.H. e nível do cloro</a>
                <input type="submit" id="calc" value="Realizar Cálculos" class="cursor-pointer p-3 bg-sky-500 rounded-full hover:bg-sky-600 transition duration-700 ease-in-out mt-6">
                </input>
            </form>

            <p id="alert" class="text-center"></p>
            <p id="alertCloro" class="text-center mb-10"></p>
        </main>

        <svg class="absolute -bottom-16 md:hidden" id="wave" style="transform: rotate(0deg); transition: 0.3s" viewBox="0 0 1440 120"
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
    </div>
    <script>
        var height = <?php echo $piscinas[0]['altura']?>;
        var width = <?php echo $piscinas[0]['largura']?>;
        var length = <?php echo $piscinas[0]['comprimento']?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="..\src\pool.js"></script>
</body>
</html>