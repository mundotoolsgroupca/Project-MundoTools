<?php

session_name("ecomercer_user_data");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../../../");
}
?>
<div class='[  mx-auto w-full p-3  ] [ md:w-2/5 ] [ lg:w-2/5 ]'>
    <h1 class="[ m-0 flex items-center gap-3 [ text-sm ] [ md:text-md ] [ lg:text-lg ]  ]">
        Perfil
        <span id='loaderstatus' class='my-auto flex justify-center'>

        </span>
    </h1>
    <div class="[ mt-3 bg-white  p-3 rounded-xl shadow-xl flex items-center justify-between mt-4] ">
        <div class="flex space-x-6 items-center">
            <img src="https://i.pinimg.com/originals/25/0c/a0/250ca0295215879bd0d53e3a58fa1289.png" class="w-auto h-24 rounded-lg">
            <div>
                <p class="font-semibold text-base"><?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'] ?></p>
                <p class="font-semibold text-sm text-gray-400">Vendedor</p>
            </div>
        </div>

    </div>
</div>