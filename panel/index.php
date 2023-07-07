<?php
session_name("ecomercer_user_data");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!--------Jquery------->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!---------Tailwind-------->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
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

    <!---------datatable-------->
    <script src="./controladores/js/datatable.js"></script>
    <link rel="stylesheet" href="./controladores/css/datatable.css">
    <!------sweeteAlert----->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!------google font ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <script src="./controladores/js/index.js?v=<?php echo rand(); ?>"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['token']; ?>">
    <link rel="icon" href="../assets/img/logo-color.png" />
    <title>Perfil</title>
</head>

<body class='bg-gray-200'>


    <div class="min-h-screen flex flex-col">
        <header class="bg-red-50 ">
            <!-- Header Navbar -->
            <div class="[ w-full p-3 bg-black flex gap-5 justify-betweend items-center text-white ]">
                <!-- Behance -->





                <div class='w-1/2 flex gap-1'>
                    <a href="../">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 cursor-pointer hover:scale-125 transition-all">
                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                    </a>
                    <a href="../tienda.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer hover:scale-125 transition-all">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                    </a>


                </div>
                <div class='w-1/2 flex justify-end gap-1'> <!-- Facebook -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 cursor-pointer hover:scale-125 transition-all" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                    </svg>

                    <!-- Messenger -->


                    <!-- Twitter -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 cursor-pointer hover:scale-125 transition-all" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>

                    <!-- Google -->


                    <!-- Instagram -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 cursor-pointer hover:scale-125 transition-all" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                    </svg>
                </div>


            </div>
            <!-- Header Navbar -->
            <nav class="  top-0 left-0 z-20 w-full    bg-[#FBAA35] shadow-lg py-2.5 px-6 sm:px-4">
                <div class="max-w-screen-xl flex   items-center justify-center gap-3 mx-auto 4 ">
                    <div class="[ lg:w-2/4 ]">
                        <a href="../" class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]">
                            <img src="../assets/img/logo.png" class="w-full h-full   " alt="">
                        </a>
                    </div>
                    <div class="[ lg:w-3/4 ]">
                        <form action="../search/" method="get">
                            <div class="flex gap-1 items-center flex-col [ md:flex-row ] [ lg:flex-row ]">
                                <div class="[    items-center justify-between w-full  ] [ lg:w-full ]" id="navbar-sticky">
                                    <div class="relative   flex w-full flex-wrap items-stretch flex-nowrap">
                                        <input type="Buscar" value="<?php if (isset($_GET['query'])) {
                                                                        echo $_GET['query'];
                                                                    } else {
                                                                        echo "";
                                                                    } ?>" placeholder="Buscar Productos" class="placeholder-gray-700  relative m-0 -mr-0.5 block w-32 min-w-0 flex-auto  border-b border-black   bg-transparent bg-clip-padding px-3 py-[0.25rem] text-sm font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out " name="query" aria-label="Search" aria-describedby="button-addon1" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="[ lg:w-2/4 flex justify-end ] [ md:invisible ] [ lg:invisible ]">
                        <button id='btn_aside_mobile' type="button" data-te-ripple-init data-te-ripple-color="light" class="inline-block rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal    transition duration-150 ease-in-out  text-black   ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>

                        </button>
                    </div>


                </div>




            </nav>


        </header>

        <div class="flex-1 flex flex-col sm:flex-row">
            <main id='box_principal' class="flex-1   p-5 overflow-hidden">Content here</main>

            <nav id="navaside" class="[ bg-white order-first  hidden p-2 ] [ md:block ] [ lg:block ] ">
                <div class="w-64 px-4">
                    <div class="px-2 pt-4 pb-8  ">
                        <ul class="space-y-2">
                            <li onclick="modulo_perfil()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <span> <?php echo $_SESSION['usuario']['nombre'] ?></span>
                                    </span>
                                </a>
                            </li>
                            <li onclick="modulo_ordenes()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    <span>Ordenes</span>
                                </a>
                            </li>
                            <li onclick="modulo_tokens()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Tokens</span>
                                </a>
                            </li>
                            <li>
                                <a href="../tienda.php" data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                    </svg>


                                    <span>Volver</span>
                                </a>
                            </li>
                            <li>
                                <a href="../php/logout.php" data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>

                                    <span>Cerrar Sesion</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

            </nav>

            <nav id="navaside_mobile" class="[ bg-white order-first  hidden  p-2  ] [ md:hidden ] [ lg:hidden ]">
                <div class="w-64 px-4">
                    <div class="px-2 pt-4 pb-8  ">
                        <ul class="space-y-2">
                            <li onclick="modulo_perfil()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <span> <?php echo $_SESSION['usuario']['nombre'] ?></span>
                                    </span>
                                </a>
                            </li>
                            <li onclick="modulo_ordenes()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    <span>Ordenes</span>
                                </a>
                            </li>
                            <li onclick="modulo_tokens()">
                                <a data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Tokens</span>
                                </a>
                            </li>
                            <li>
                                <a href="../php/logout.php" data-te-ripple-init data-te-ripple-color="light" class="hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>

                                    <span>Salir</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

            </nav>

            <aside class="sm:w-32   p-2"> </aside>
        </div>

        <footer data-aos="fade-up" id="contactanos" class="bg-[#FBAA35] text-center text-neutral-900   lg:text-left transition-all">
            <!-- Main container div: holds the entire content of the footer, including four sections (Tailwind Elements, Products, Useful links, and Contact), with responsive styling and appropriate padding/margins. -->
            <div class="mx-2 py-10 text-center md:text-left">
                <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Tailwind Elements section -->
                    <div class="[ flex items-center  justify-center ] [ md:justify-start ] [ lg:justify-start ]">
                        <a class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]" href="#">
                            <img src="./assets/img/logo-white.png" alt="" srcset="" />
                        </a>
                    </div>


                    <div class="[ hidden ] [ md:block ] [ lg:block ] "></div>

                    <div class="[ hidden ] [ md:block ] [ lg:block ] "></div>

                    <div>
                        <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                            Contacto
                        </h6>
                        <p class="mb-4 flex items-center justify-center md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                                <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                            </svg>
                            <span class="[ text-[13px] ] [ md:text-base ] [ lg:text-base ]">
                                Av. Fuerzas armadas centro industrial Barcelona. Barcelona estado anzoategui.</span>
                        </p>

                        <p class="mb-4 flex items-center justify-center md:justify-start">
                            <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 308 308" xml:space="preserve" class="mr-3 h-5 w-5">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="XMLID_468_">
                                        <path id="XMLID_469_" d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156 c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687 c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887 c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153 c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348 c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802 c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922 c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0 c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z"></path>
                                        <path id="XMLID_470_" d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716 c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396 c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188 l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677 c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z"></path>
                                    </g>
                                </g>
                            </svg>
                            <a href="https://wa.me/+5804248218587">0424-8218587</a>
                        </p>
                    </div>
                </div>
            </div>

            <!--Copyright section-->
            <div class="bg-black p-6 text-center text-white/90">
                <span>© 2023 Copyright:</span>
                <a class="font-semibold text-white" href="./">Mundotools Group C.A Rif: J503585285</a>
            </div>
        </footer>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    <script>
        modulo_perfil();

        $("#navaside_mobile > div > div > ul > li").click(function() {
            $("#navaside_mobile").slideToggle();
        });

        $("#btn_aside_mobile").click(function() {
            $("#navaside_mobile").slideToggle();
            $("p:last-child").toggle();
        });
    </script>

</body>



</html>