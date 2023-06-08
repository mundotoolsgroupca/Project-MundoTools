 <?php
    session_name("ecomercer_admin_data");
    session_start();
    if (isset($_SESSION['Usuario'])) { //ya ya existe una session ingresa automaticamente
        header("Location: index.php");
    }

    if (isset($_SESSION['token'])) {
        // la variable si esta definida

        if (empty($_SESSION['token']) || is_null($_SESSION['token'])) {
            // la variable esta vacia o es null
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
    } else {
        // la variable no esta definida
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    ?>

 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="./assets/img/logo-white.png" />
     <!--------Jquery------->
     <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
     <!---------Tailwind-------->
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
     <script src="https://cdn.tailwindcss.com/3.3.0"></script>
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
     <!---------Color Thief Obtener color predominante de una imagen-------->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
     <!---------sweetalert-------->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="./assets/js/index.js"></script>
     <title>Entrar</title>
 </head>

 <body class="bg-gray-100">


     <!-- component -->
     <!-- Create By Joker Banny -->


     <!-- Header Navbar -->
     <nav class="fixed top-0 left-0 z-20 w-full border-b border-gray-200 bg-white py-2.5 px-6 sm:px-4">
         <div class="container mx-auto flex max-w-6xl flex-wrap items-center justify-between">
             <!-- Hamburger button for mobile view -->
             <a class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]" href="#">
                 <img src="./assets/img/logo.png" alt="" srcset="" />
             </a>
             <div class="mt-2 sm:mt-0  md:order-2 hidden">
                 <!-- Login Button -->
                 <button type="button" class="rounde mr-3 hidden border border-blue-700 py-1.5 px-6 text-center text-sm font-medium text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 md:inline-block rounded-lg">Login</button>
                 <button type="button" class="rounde mr-3 hidden bg-blue-700 py-1.5 px-6 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 md:mr-0 md:inline-block rounded-lg">Register</button>
                 <!-- Register Button -->
                 <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden" aria-controls="navbar-sticky" aria-expanded="false">
                     <span class="sr-only">Open main menu</span>
                     <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                     </svg>
                 </button>
             </div>
             <div class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto" id="navbar-sticky">
                 <ul class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:text-sm md:font-medium">
                     <li>

                     </li>

                 </ul>
             </div>
         </div>
     </nav>





     <div class="[ relative  h-[91vh] ]">
         <!-- Tab Menu -->
         <div id="categorias" class="flex justify-center h-full flex-wrap items-center  overflow-x-auto overflow-y-hidden py-10 justify-center     text-gray-800">

             <form action="./api-v1/login/index.php" method="post">
                 <div class="[ rounded-xl bg-white p-3 shadow-lg flex flex-col gap-5 ]">
                     <H2 class="text-center font-bold">Administrador</H2>
                     <div>
                         <label>
                             Usuario
                         </label>
                         <input name="usuario" class="[ relative m-0 block w-full min-w-0 flex-auto rounded-l border   border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out   focus:border-warning-600 focus:text-neutral-700 focus:shadow-te-warning focus:outline-none  ]" type="text">
                     </div>
                     <div>
                         <label>
                             Clave
                         </label>
                         <input name="clave" class="[ relative m-0 block w-full min-w-0 flex-auto rounded-l border   border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out   focus:border-warning-600 focus:text-neutral-700 focus:shadow-te-warning focus:outline-none  ]" type="password">
                     </div>

                     <div>
                         <?php if (isset($_GET['error1'])) {
                                echo "<label class='[ text-danger ] [ lg:text-md ]'>" . $_GET['error1'] . "</label>";
                            }
                            ?>
                         <hr class="h-px my-3 bg-gray-200 border-0  ">


                     </div>
                     <div>
                         <button type="submit" data-te-ripple-init="" data-te-ripple-color="warning" class="[ lg:text-xs ] w-full   rounded-r bg-warning px-6 py-2.5   font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-warning-700 hover:shadow-lg   focus:bg-warning-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-warning-800 active:shadow-lg" id="button-addon2">
                             Iniciar Session
                         </button>
                     </div>
                 </div>
             </form>


         </div>
         <!-- Footer -->
         <footer class="py-6  bg-gray-100 text-gray-900">
             <div class="container px-6 mx-auto space-y-6 divide-y divide-gray-400 md:space-y-12 divide-opacity-50">
                 <div class="grid justify-center  lg:justify-between">
                     <div class="flex flex-col self-center text-sm text-center md:block lg:col-start-1 md:space-x-6">
                         <span>Copy right © 2023 </span>
                     </div>

                 </div>
             </div>
         </footer>

     </div>





     <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

 </body>

 </html>