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
     <title>Preview</title>
 </head>

 <body class="bg-gray-100">


     <!-- component -->
     <!-- Create By Joker Banny -->


     <!-- Header Navbar -->
     <nav class="fixed top-0 left-0 z-20 w-full border-b border-gray-200 bg-white py-2.5 px-6 sm:px-4">
         <div class="container mx-auto flex max-w-6xl flex-wrap items-center justify-between">
             <a class="flex items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-3 h-6 text-warning sm:h-9">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                 </svg>

                 <span class="self-center whitespace-nowrap text-xl font-semibold">Example</span>
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
                         <label class="[ lg:text-md ]">
                             No Tienes Cuenta? <a class="text-warning" href="#">Registrate</a>
                         </label>

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
                         <a rel="noopener noreferrer">
                             <span>Privacy policy</span>
                         </a>
                         <a rel="noopener noreferrer">
                             <span>Terms of service</span>
                         </a>
                     </div>
                     <div class="flex hidden justify-center pt-4 space-x-4 lg:pt-0 lg:col-end-13">
                         <a rel="noopener noreferrer" title="Email" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                 <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                 <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                             </svg>
                         </a>
                         <a rel="noopener noreferrer" title="Twitter" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" fill="currentColor" class="w-5 h-5">
                                 <path d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z">
                                 </path>
                             </svg>
                         </a>
                         <a rel="noopener noreferrer" title="GitHub" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                 <path d="M10.9,2.1c-4.6,0.5-8.3,4.2-8.8,8.7c-0.5,4.7,2.2,8.9,6.3,10.5C8.7,21.4,9,21.2,9,20.8v-1.6c0,0-0.4,0.1-0.9,0.1 c-1.4,0-2-1.2-2.1-1.9c-0.1-0.4-0.3-0.7-0.6-1C5.1,16.3,5,16.3,5,16.2C5,16,5.3,16,5.4,16c0.6,0,1.1,0.7,1.3,1c0.5,0.8,1.1,1,1.4,1 c0.4,0,0.7-0.1,0.9-0.2c0.1-0.7,0.4-1.4,1-1.8c-2.3-0.5-4-1.8-4-4c0-1.1,0.5-2.2,1.2-3C7.1,8.8,7,8.3,7,7.6C7,7.2,7,6.6,7.3,6 c0,0,1.4,0,2.8,1.3C10.6,7.1,11.3,7,12,7s1.4,0.1,2,0.3C15.3,6,16.8,6,16.8,6C17,6.6,17,7.2,17,7.6c0,0.8-0.1,1.2-0.2,1.4 c0.7,0.8,1.2,1.8,1.2,3c0,2.2-1.7,3.5-4,4c0.6,0.5,1,1.4,1,2.3v2.6c0,0.3,0.3,0.6,0.7,0.5c3.7-1.5,6.3-5.1,6.3-9.3 C22,6.1,16.9,1.4,10.9,2.1z">
                                 </path>
                             </svg>
                         </a>
                     </div>
                 </div>
             </div>
         </footer>

     </div>





     <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

 </body>

 </html>