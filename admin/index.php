<?php
session_name("ecomercer_admin_data");
session_start();
if (!isset($_SESSION['Usuario'])) { //si no existe una session sale del sistema
    header("Location: ./php/logout.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--------Jquery------->
    <script src="./assets/js/jquery-3.6.4.js"></script>
    <!---------Tailwind-------->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tw-elements.min.css" />
    <script src="./assets/js/tailwind.js"></script>
    <link rel="icon" href="./assets/img/logo.png" />

    <!---------Datatable-------->
    <link rel="stylesheet" href="./assets/css/datatable.css" />
    <script src="./assets/js/datatable.js"></script>
    <!---------PDFMAKER-------->
    <script src="./assets/js/pdfmake.min.js"></script>
    <script src="./assets/js/vfs_fonts.js"></script>



    <meta name="csrf-token" content="<?php echo $_SESSION['token']; ?>">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    <!---------sweetalert-------->
    <script src="./assets/js/sweetalert2@11.js"></script>
    <script src="../admin/assets/js/index.js?v=<?php echo rand(); ?>"></script>
    <title>Administrador</title>
</head>

<body onload="" class="bg-gray-600">
    <!--Main Navigation-->
    <header>
        <!-- Sidenav -->
        <nav id="sidenav-1" class="fixed left-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)]  xl:data-[te-sidenav-hidden='false']:translate-x-0" data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-mode-breakpoint-over="0" data-te-sidenav-mode-breakpoint-side="xl" data-te-sidenav-slim="true" data-te-sidenav-slim-collapsed="true" data-te-sidenav-content="#content" data-te-sidenav-accordion="true">
            <a class="mb-3 flex items-center justify-center py-6 outline-none" href="#!" data-te-ripple-init data-te-ripple-color="primary">
                <a class="flex items-center justify-center" href="#">
                    <img src="./assets/img/logo.png" class="[ w-24 h-10 ] [ md:w-24 md:h-32 ] [ lg:w-24 lg:h-20 ]" alt="" srcset="" />
                </a>

            </a>

            <ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref>
                <li class="relative">
                    <a class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " data-te-sidenav-link-ref>
                        <span class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] motion-reduce:[&>svg]:transition-none   ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>

                        </span>
                        <span data-te-sidenav-slim="false">Productos</span>
                        <span class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 motion-reduce:transition-none [&>svg]:h-3 [&>svg]:w-3 [&>svg]:fill-gray-600 group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] " data-te-sidenav-rotate-icon-ref>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                        </span>
                    </a>
                    <ul class="show !visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block" data-te-sidenav-collapse-ref>
                        <?php
                        if (isset($_SESSION['Permisos']['agregarproducto']) == true && $_SESSION['Permisos']['agregarproducto'] == '1') {
                            echo "
                                <li class='relative' onclick='modulo_productos()'>
                                    <a class='flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[0.78rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    ' data-te-sidenav-link-ref>Agregar | Eliminar | Editar</a>
                                </li>";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['Permisos']['agregarproducto']) == true) {
                            echo "
                                <li class='relative' onclick='modulo_stock()'>
                                    <a  class='flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[0.78rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none' data-te-sidenav-link-ref>Modificar Stock | Precio</a>
                                </li>";
                        }
                        ?>
                    </ul>
                </li>
                <li class="relative">
                    <a class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " data-te-sidenav-link-ref>
                        <span class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] motion-reduce:[&>svg]:transition-none   ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>

                        </span>
                        <span data-te-sidenav-slim="false">Categoria</span>
                        <span class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 motion-reduce:transition-none [&>svg]:h-3 [&>svg]:w-3 [&>svg]:fill-gray-600 group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] " data-te-sidenav-rotate-icon-ref>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                        </span>
                    </a>
                    <ul class="show !visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block" data-te-sidenav-collapse-ref>
                        <li onclick="modulo_categoria()" class="relative">
                            <a class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[0.78rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " data-te-sidenav-link-ref>Agregar | Modificar | Eliminar</a>
                        </li>
                    </ul>
                </li>
                <li class="relative">
                    <a onclick="modulo_ordenes()" class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " href="#!" data-te-sidenav-link-ref>
                        <span class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] motion-reduce:[&>svg]:transition-none   ">
                            <svg class="w-8 h-8" viewBox="0 0 24 24">
                                <path class="fill-current  " d="M5 3h2v2H5zM17 3h2v2h-2zM5 9h14v2H5zM5 15h14v2H5zM5 21h14v2H5z" />
                                <circle class="fill-current " cx="19" cy="14" r="4" />
                            </svg>
                        </span>
                        <span data-te-sidenav-slim="false">Ordenes</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " data-te-sidenav-link-ref>
                        <span class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] motion-reduce:[&>svg]:transition-none   ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>

                        </span>
                        <span data-te-sidenav-slim="false">Tokens</span>
                        <span class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 motion-reduce:transition-none [&>svg]:h-3 [&>svg]:w-3 [&>svg]:fill-gray-600 group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] " data-te-sidenav-rotate-icon-ref>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                        </span>
                    </a>
                    <ul class="show !visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block" data-te-sidenav-collapse-ref>

                        <li class='relative' onclick='modulo_tokens()'>
                            <a class='flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[0.78rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    ' data-te-sidenav-link-ref>Ver</a>
                        </li>

                    </ul>
                </li>

                <li class="relative">
                    <a href="./php/logout.php" class="group flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-700 outline-none transition duration-300 ease-linear hover:bg-blue-400/10 hover:text-[#E4A11B] hover:outline-none focus:bg-blue-400/10 focus:text-[#E4A11B] focus:outline-none active:bg-blue-400/10 active:text-[#E4A11B] active:outline-none data-[te-sidenav-state-active]:text-[#E4A11B] data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none    " href="#!" data-te-sidenav-link-ref>
                        <span class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5 [&>svg]:fill-gray-700 [&>svg]:transition [&>svg]:duration-300 [&>svg]:ease-linear group-hover:[&>svg]:fill-[#E4A11B] group-focus:[&>svg]:fill-[#E4A11B] group-active:[&>svg]:fill-[#E4A11B] group-[te-sidenav-state-active]:[&>svg]:fill-[#E4A11B] motion-reduce:[&>svg]:transition-none   ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>

                        </span>
                        <span data-te-sidenav-slim="false">Salir</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- Sidenav -->

        <!-- Navbar -->
        <nav id="main-navbar" class="[ lg:fixed ] left-0 right-0 top-0 flex w-full flex-nowrap items-center justify-between bg-white py-[0.6rem] text-gray-500 shadow-lg hover:text-gray-700 focus:text-gray-700  lg:flex-wrap lg:justify-start xl:pl-60" data-te-navbar-ref>
            <!-- Container wrapper -->
            <div class="flex w-full flex-wrap items-center justify-between px-4 [ md:justify-end ] [ lg:justify-end ]">
                <!-- Toggler -->
                <button id='mobiletoggleaside' type="button" data-te-ripple-init data-te-ripple-color="light" class="[ inline-block rounded-full p-1   font-medium uppercase leading-normal text-white  transition duration-150 ease-in-out   focus:outline-none focus:ring-0 ] [ md:hidden ] [ lg:hidden ] ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>




            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="[ lg:ml-[75px] lg:mt-[58px] ]  [ pt-5 px-5 h-[90vh] ] ">
        <!------
        <iframe id="principal" style="height:100%;width:100%">
        </iframe>
---->


        <div id="principal">
            <div class="w-full h-screen flex justify-center items-center bg-gray-600">

                <img src="./assets/img/logo-white.png" alt="" class="w-72 rounded-lg">

            </div>
        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer></footer>
    <!--Footer-->
    <!-- Content -->
    <script id="tailwindelements_script" src="./assets/js/tw-elements.umd.min.js"></script>
    <script>
        const sidenavInstance = te.Sidenav.getInstance(
            document.getElementById("sidenav-1")
        );
        $("#sidenav-1").hover(function() {

            sidenavInstance.toggleSlim();
        });
        $("#mobiletoggleaside").click(function() {
            sidenavInstance.show();
        });
    </script>
</body>

</html>