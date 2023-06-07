<?php
session_name("ecomercer_user_data");
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--------Jquery------->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!---------Tailwind-------->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <link rel="icon" href="./assets/img/logo-white.png" />
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
    <!---------Color Thief Obtener color predominante de una imagen-------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
    <script src="./assets/js/index.js?v=<?php echo rand(); ?>"></script>
    <!------google font ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <title>Tienda</title>
</head>

<body class="bg-white">


    <!-- component -->
    <!-- Create By Joker Banny -->

    <div id="box_navbar" class="z-[999]  w-full ">
        <div id="social_bar" class="[ w-full p-3 bg-black flex gap-5 justify-betweend items-center text-white ]">
            <!-- Behance -->
            <div class='w-1/2 flex gap-1'>
                <a href="./">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 cursor-pointer hover:scale-125 transition-all">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                </a>
                <a href="./tienda.php">
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

        <nav class="z-20 w-full    bg-[#FBAA35]  shadow-lg p-3 sm:px-4">
            <div class="max-w-screen-xl flex   items-center justify-between gap-3 mx-auto 4 ">
                <div class="[ lg:w-2/4 ]">
                    <a class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]" href="#">
                        <img src="./assets/img/logo.png" alt="" srcset="">
                    </a>
                </div>
                <div class="[ lg:w-3/4 ]">
                    <form action="./search/" method="get">
                        <div class="flex gap-1 items-center flex-col [ md:flex-row ] [ lg:flex-row ]">
                            <div class="[    items-center justify-between w-full  ] [ lg:w-full ]" id="navbar-sticky">
                                <div class="relative   flex w-full flex-wrap items-stretch">
                                    <input type="Buscar" value="" placeholder="Buscar Productos" class="placeholder-gray-700  relative m-0 -mr-0.5 block w-32 min-w-0 flex-auto  border-b border-black   bg-transparent bg-clip-padding px-3 py-[0.25rem] text-sm font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out " name="query" aria-label="Search" aria-describedby="button-addon1" />
                                    <!--Search button-->

                                </div>
                            </div>
                            <div class="[ hidden items-center justify-center gap-3 mx-auto 4  mt-3 ] [ md:flex ] [ lg:flex ] ">
                                <div class="flex items-center">
                                    <a href="./tienda.php" class=" whitespace-nowrap rounded   px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white  transition duration-150 ease-in-out    focus:outline-none focus:ring-0   active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">
                                        Categorias
                                    </a>
                                    <button class="text-white" type="button" id="dropdownMenuButton3" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">

                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                    <ul id="navcategoria" class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton3" data-te-dropdown-menu-ref>

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="[ lg:w-2/4 flex justify-end ]">
                    <div class="relative" data-te-dropdown-ref>
                        <!-- Second dropdown trigger -->
                        <a class="hidden-arrow flex  gap-2  items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none" href="#" id="dropdownMenuButton2" role="button" data-te-dropdown-toggle-ref aria-expanded="false">
                            <!-- User avatar -->
                            <?php
                            echo
                            isset($_SESSION['usuario']['nombre']) ?
                                " <span class='text-white'>" . $_SESSION['usuario']['nombre'] . "</span> <img src='https://unavatar.io/midudev' class='rounded-full' style='height: 25px; width: 25px' alt='' loading='lazy' />"
                                :
                                " <a class='text-white text-[15px]  [ lg:text-lg ]' href='./login'>" . "Inicia Sesion" . "</a>";
                            ?>
                        </a>
                        <!-- Second dropdown menu -->
                        <ul class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                            <!-- Second dropdown menu items -->
                            <li>
                                <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="./perfil/" data-te-dropdown-item-ref>Perfil</a>
                            </li>
                            <li>
                                <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="#" data-te-dropdown-item-ref>Opciones</a>
                            </li>
                            <li>
                                <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="./php/logout.php" data-te-dropdown-item-ref>Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="[ flex w-full justify-center ] [ md:hidden ] [ lg:hidden ]">
                <div class="flex items-center">
                    <a href="./tienda.php" class=" whitespace-nowrap rounded   px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white  transition duration-150 ease-in-out    focus:outline-none focus:ring-0   active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">
                        Categorias
                    </a>
                    <button class="text-white" type="button" id="dropdownMenuButton3_mobile" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">

                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <ul id="navcategoria_mobile" class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton3_mobile" data-te-dropdown-menu-ref>

                    </ul>
                </div>
            </div>




        </nav>


    </div>


    <!----
    <div id="carouselExampleIndicators" class="relative mt-3" data-te-carousel-init data-te-carousel-slide>
        <div class="absolute right-0 bottom-0 left-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0" data-te-carousel-indicators>
            <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="0" data-te-carousel-active class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="1" class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none" aria-label="Slide 2"></button>
            <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="2" class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none" aria-label="Slide 3"></button>
            <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="3" class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none" aria-label="Slide 4"></button>
        </div>
        <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
            <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none" data-te-carousel-item data-te-carousel-active>
                <picture>
                    <source media="(min-width: 100px) and (max-width: 600px)" srcset="./assets/img/publicidad1_mobile.png">

                    <img loading="lazy" src="./assets/img/publicidad1.png" class="block w-full   object-cover object-center" alt="Publicidad" />

                </picture>

            </div>
            <div class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none" data-te-carousel-item>
                <picture>
                    <source media="(min-width: 100px) and (max-width: 600px)" srcset="./assets/img/publicidad2_mobile.png">

                    <img loading="lazy" src="./assets/img/publicidad2.png" class="block w-full   object-cover object-center" alt="Publicidad" />

                </picture>

            </div>
        </div>
        <button class="absolute top-0 bottom-0 left-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none" type="button" data-te-target="#carouselExampleIndicators" data-te-slide="prev">
            <span class="inline-block h-8 w-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </span>
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Previous</span>
        </button>
        <button class="absolute top-0 bottom-0 right-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none" type="button" data-te-target="#carouselExampleIndicators" data-te-slide="next">
            <span class="inline-block h-8 w-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </span>
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Next</span>
        </button>
    </div>
----->

    <div id="contenido" class="[ static  ]">



        <!-- Product List -->

        <section class="[ py-10 bg-gray-200  ]">

            <div id="ColeccionesBox">

            </div>

            <div id="item_list" class="[  grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ] [ lg:mx-auto ]">
            </div>

            <div class="[ fixed flex justify-end bottom-0 right-0 text-sm  ]" id="BtnTicket">
                <div class="border  border-gray-300  rounded-lg   bg-white ">
                    <h2 class="mb-0" id="headingTwo">
                        <button class="group relative flex w-full items-center   border-0 bg-white py-2 px-3 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none  [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-warning [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] " type="button" data-te-collapse-init data-te-collapse-collapsed data-te-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="[ flex gap-1 items-center relative ]">

                                <div id="newitemadd_status" class="[ hidden absolute w-full  ]">
                                    <span class="animate-ping  absolute inline-flex h-2 w-2 bottom-2 left-3 rounded-full bg-warning-400 "></span>
                                    <span class="absolute inline-flex h-2 w-2 bottom-2 left-3 rounded-full bg-[#FBAA35] "></span>

                                </div>



                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                                    </path>
                                </svg>
                                Carrito
                                <label id="Cantidad_produtos">(0)</label>
                            </div>

                            <span class="ml-2 -mr-1 h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none ">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="!visible hidden" data-te-collapse-item aria-labelledby="headingTwo" data-te-parent="#BtnTicket">

                        <div class="[ h-full  w-72     py-4  ]">
                            <div class="[ h-72 overflow-y-auto   ]">
                                <div id="Carrito" class=" flex flex-col gap-3">

                                </div>
                            </div>
                        </div>
                        <div class="[ w-full  flex justify-between p-2 ]">
                            <div class="[ w-full flex justify-start p-3 ]">
                                <div>
                                    Total:&nbsp
                                </div>
                                <div id="CarritoTotales" class="text-warning font-bold ">
                                    0
                                </div>
                            </div>
                            <div class="flex justify-center gap-3 ">

                                <button onclick="Carrito.clear();" type="button" class="inline-block rounded bg-danger-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-danger-700 transition duration-150 ease-in-out hover:bg-danger-200 focus:bg-danger-100 focus:outline-none focus:ring-0 active:bg-danger-200">
                                    Borrar
                                </button>
                                <button id="btncarritodetalle" type="button" class="inline-block rounded bg-success-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                    Detalle
                                </button>





                            </div>

                        </div>



                    </div>
                </div>
            </div>

        </section>



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
                                Galpo #8, del centro industrial Barcelona, ubicado en la av.
                                Fuerzas armadas.</span>
                        </p>
                        <p class="mb-4 flex items-center justify-center md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                            <a class="[ text-[13px] ] [ md:text-base ] [ lg:text-base ]" href="mailto:contacto@mundotoolsgroup.com">contacto@mundotoolsgroup.com</a>
                        </p>
                        <p class="mb-4 flex items-center justify-center md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                            </svg>
                            <a href="https://wa.me/+0">0</a>
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

    <div id="btn_subir" class=" fixed  bottom-3 left-3">
        <a href="#social_bar">
            <div class="rounded-full bg-[#FBAA35] hover:bg-[#FBAA15] cursor-pointer transition-colors p-3 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-white h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                </svg>
            </div>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script>
        $(document).ready(async function() {
            //Productos();

            colecciones_consultar();
            localreaddata();
            categorias();
        });
        let carritostorage = typeof localStorage.CARRITO == "undefined" ? [] : JSON.parse(localStorage.CARRITO);
        //Script para el modal
        const ticket_modal_el = document.getElementById("collapseTwo");
        const ticket_modal = new te.Offcanvas(ticket_modal_el);




        function localreaddata() {

            if (carritostorage.length != 0) {
                carritostorage.map((item, index) => {
                    Carrito.add(item.id, item.cantidad, carritostorage[index]);
                });
            }


        }
        const btncarritodetalle = document.querySelector('#btncarritodetalle');
        btncarritodetalle.addEventListener('click', function() {
            if (Carrito.list.length > 0) {
                window.location.href = './carrito/'
            }
        });

        async function categorias() {

            const data = await $.ajax({
                url: "./api/categorias/index.php",
                type: 'GET',
            });

            data.map((item) => {
                $('#navcategoria').append(`
                <li>
                    <a href='./search/?categoria=${item.id}' class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>${item.nombre}</a>
                </li>
                `);
                $('#navcategoria_mobile').append(`
                <li>
                    <a href='./search/?categoria=${item.id}' class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>${item.nombre}</a>
                </li>
                `);
            });

        }



        async function Productos() {
            Poductos = await $.ajax({
                url: "./api/productos/index.php",
                type: 'GET',
            });
            Poductos.map((item) => {

                $('#item_list').append(
                    ` <article  class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                            <a  >
                            <a data-te-ripple-init class="relative flex justify-center items-end overflow-hidden rounded-xl">
                                <img loading="lazy"   src="./${item.imagen}"    class="h-52   objecto-cover" />
                            </a>

                                <div class="mt-1 p-2">
                                    <h2 class="text-slate-700">${item.nombre.length >= 10 ? item.nombre.substring(0, 25) + "..." : item.nombre}
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-400">${item.descripcion.length >= 10 ? item.descripcion.substring(0, 15) +
                                            "..." : item.descripcion}</p>


                                    <div class="mt-3 flex items-center justify-between">
                                        <p class="text-lg font-bold text-warning">${item.simbolo}${item.precio}</p>

                                        <!-- Required font awesome -->
                                        <div class="flex  w-32   justify-center space-x-2">
                                            <form>
                                                <div class="relative    flex w-full flex-wrap items-stretch">
                                                    <input id="${item.id}" min="0" type="number"
                                                        class="relative m-0 block w-14  min-w-0 flex-auto rounded-l border border-r-0 border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out   focus:border-warning-600 focus:text-neutral-700 focus:shadow-te-warning focus:outline-none "  
                                                        aria-label="Recipient' username" value='1'
                                                        aria-describedby="button-addon2" />
                                                    <button  type="submit"
                                                    data-te-ripple-init
                            data-te-ripple-color="warning"
                                                        class="relative   rounded-r bg-warning px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-warning-700 hover:shadow-lg   focus:bg-warning-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-warning-800 active:shadow-lg"
                                                        type="button" id="button-addon2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="h-4 w-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>

                            </a>
                            </article>  
                            `)
            });

            var forms = document.querySelectorAll('form'); // seleccionar todos los formularios
            for (var i = 0; i < forms.length; i++) {
                forms[i].addEventListener('submit', e => {

                    e.preventDefault();

                    if (e.target[0].value != 0) {
                        Carrito.add(e.target[0].id, e.target[0].value);
                        e.target[0].value = 1;
                    }

                    // console.log(e.target[0].id);
                });
            }

        }

        async function colecciones_consultar() {

            colecciones = await $.ajax({
                url: "./api/promociones/index.php",
                type: 'GET',
                data: {
                    categoria: 1,
                    coleccion: 1
                },
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {

                    if (response.result == true) {

                        if (response.data.length > 0) {

                            response.data.map((item, index) => {
                                let html = "";
                                let datajson = JSON.parse(item.datos_categoria);
                                let iddiv = idrandom(4);
                                $('#ColeccionesBox').append(`
        
                                <div class="[ mx-auto gap-6 p-6 ] [ lg:w-3/4 ]">
                                    <h2 class="p-3 text-xl font-semibold text-slate-700">Categoria <span class="text-warning">${ item.categoria }</span> </h2>
                                        <div class="[ flex flex-col w-full gap-3  h-full ] [ lg:flex-row lg:h-[300px] ]">
                                            <div class="[ w-full ] [ lg:w-2/4 ]">
                                                <article class="rounded-xl h-full bg-white p-3 shadow-lg duration-300 hover:scale-105 hover:transform hover:shadow-xl">
                                                    <a href='./search/?categoria=${item.id}'  data-te-ripple-init="" class="relative flex items-end justify-center overflow-hidden rounded-xl">
                                                        <img loading="lazy" onerror="this.onerror=null;this.src='./assets/img/imgerror.png'" src=".${datajson.productos[0].imagen}" title="${item.nombre}" class="objecto-cover h-52">
                                                    </a>
                                                    <h2 class="text-sm font-semibold text-slate-700">Descubre</h2>
                                                    <h2 class="text-xl font-semibold text-slate-700">${ item.categoria }</h2>


                                                </article>
                                            </div>
                                            <div id="${iddiv}" class="[ grid grid-cols-4 grid-rows-2  grid-flow-col  items-center gap-3  w-full ] [ lg:w-3/4 ] ">
                                        
                                            </div>
                                        </div>
                                    </div> `);

                                datajson.productos.map((child, index) => {
                                    if (index > 0) {
                                        $(`#${iddiv}`).append(`
                                        <a  href='./search/?query=${child.id}' class="rounded-xl   h-full bg-white p-3 shadow-lg duration-300 hover:scale-105 hover:transform hover:shadow-xl">
                                        <div data-te-ripple-init  class="relative flex items-end justify-center h-full w-full   rounded-xl">
                                            <img loading="lazy" onerror="this.onerror=null;this.src='./assets/img/imgerror.png'" src=".${child.imagen}" 
                                                class="objecto-cover h-full">
                                        </div>
                                        </a> `);
                                    }

                                });


                                //$('#ColeccionesBox').append(html);

                                // console.log(html);

                            });


                        }

                    } else {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.mensaje
                        });

                    }

                },
                error: function(xhr, status) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: xhr.responseJSON.mensaje
                    });
                },

            });




        }
        $(window).scroll(function() {
            debugger
            if ($(this).scrollTop() > 0) {
                $('#btn_subir').fadeOut(); //ocultar con animación
            } else {
                $('#btn_subir').fadeIn(); //mostrar con animación
            }
        });

        $("#btn_subir > a ").on("click", function(event) {

            var target = $(this.getAttribute("href"));

            if (target.length) {
                event.preventDefault();

                $("html, body").animate({
                        scrollTop: target.offset().top -
                            ($(window).height() - target.outerHeight()) / 2,
                    },
                    1000
                );
            }
        });
    </script>
</body>

</html>