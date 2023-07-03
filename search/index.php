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
    <!------google font ----->
    <link href="../assets/fuentes/VisbyRoundCF-DemiBold.ttf">
    <!------SweetAlert ----->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!------google font ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <!--------Jquery------->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!---------Tailwind-------->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="icon" href="../assets/img/logo-white.png" />
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
    <!---------Color Thief Obtener color predominante de una imagen-------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
    <script src="../assets/js/index.js?v=<?php echo rand(); ?>"></script>
    <script src="../assets/js/FuncionesGenerales.js?v=<?php echo rand(); ?>"></script>
    <title><?php if (isset($_GET['query'])) {
                echo $_GET['query'];
            } else {
                echo "MundoTools";
            } ?> - Buscar</title>
</head>

<style>
    @font-face {
        font-family: Raleway;
        src: url("../assets/fuentes/VisbyRoundCF-Regular.ttf");
    }
</style>

<body class="[ bg-gray-200 ]">

    <!-- Header Navbar -->
    <div id="social_bar" class="[ w-full p-3 bg-black flex gap-5 justify-betweend items-center text-white ]">
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
    <nav class="z-20 w-full    bg-[#FBAA35]  shadow-lg p-3 sm:px-4">
        <div class="max-w-screen-xl flex   items-center justify-between gap-3 mx-auto 4 ">
            <div class="[ lg:w-2/4 ]">
                <a class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]" href="../tienda.php">
                    <img src="../assets/img/logo.png" alt="" srcset="">
                </a>
            </div>
            <div class="[ lg:w-3/4 ]">
                <form action="./" method="get">
                    <div class="flex gap-1 items-center flex-col [ md:flex-row ] [ lg:flex-row ]">
                        <div class="[    items-center justify-between w-full  ] [ lg:w-full ]" id="navbar-sticky">
                            <div class="relative   flex w-full flex-wrap items-stretch">
                                <input type="Buscar" value="<?php
                                                            include_once '../php/conexion.php';
                                                            include_once '../php/FuncionesGenerales.php';
                                                            if (isset($_GET['query'])) {
                                                                $query = htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8');
                                                                // $query = mysqli_real_escape_string($conexion, $_GET['query']);
                                                                echo $query;
                                                            } else {
                                                                echo "";
                                                            } ?>" placeholder="Buscar Productos" class="placeholder-gray-700  relative m-0 -mr-0.5 block w-32 min-w-0 flex-auto  border-b border-black   bg-transparent bg-clip-padding px-3 py-[0.25rem] text-sm font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out " name="query" aria-label="Search" aria-describedby="button-addon1" />
                                <!--Search button-->

                            </div>
                        </div>
                        <div class="[ hidden items-center justify-center gap-3 mx-auto 4  mt-3 ] [ md:flex ] [ lg:flex ] ">
                            <div class="flex items-center">
                                <a href="../tienda.php" class=" whitespace-nowrap rounded   px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white  transition duration-150 ease-in-out    focus:outline-none focus:ring-0   active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">
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
                            " <a class='text-white text-[15px]  [ lg:text-lg ]' href='../login'>" . "Inicia Sesion" . "</a>";
                        ?>
                    </a>
                    <!-- Second dropdown menu -->
                    <ul class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                        <!-- Second dropdown menu items -->
                        <li>
                            <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="../panel/" data-te-dropdown-item-ref>Panel</a>
                        </li>

                        <li>
                            <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="../php/logout.php" data-te-dropdown-item-ref>Cerrar Sesion</a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="[ flex w-full justify-end ] [ md:hidden ] [ lg:hidden ]">
            <div class="flex items-center">
                <a href="../tienda.php" class=" whitespace-nowrap rounded   px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white  transition duration-150 ease-in-out    focus:outline-none focus:ring-0   active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">
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


    <div class="[ relative    ] [ md:mt-32 ] [ lg:mt-32 ]">
        <div class="[  lg:w-5/5   ] [ mx-auto ]">
            <div class="[ mx-auto p-3  ] [ lg:flex lg:h-full lg:justify-center    lg:w-4/5 lg:gap-3  ]">

                <div class="[ flex gap-5 justify-center pt-3 pb-3  ][ md:flex ][ lg:hidden ]">
                    <a class=" flex justify-end gap-1 items-center inline-block rounded px-2 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary hover:text-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 " data-te-collapse-init data-te-ripple-init data-te-ripple-color="light" href="#ordenarmobile" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                            </svg>

                        </label>
                        Ordenar
                    </a>
                    <div class="   w-px self-stretch bg-gradient-to-tr from-transparent via-neutral-500 to-transparent  "></div>
                    <a class=" flex justify-end gap-1 items-center inline-block rounded px-2 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary hover:text-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 " data-te-collapse-init data-te-ripple-init data-te-ripple-color="light" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                            </svg>
                        </label>
                        Categoria
                    </a>
                </div>

                <div class="[ lg:w-[300px] lg:h-full lg:p-3 lg:rounded-lg hidden ] [ md:hidden ] [ lg:block ]">

                    <?php
                    $categoria = "";
                    if (isset($_GET['query'])) {

                        if (strlen(trim($_GET['query'])) != 0) {


                            $query = mysqli_real_escape_string($conexion, $query);
                            $categoriaselected = isset($_GET['categoria']) ? htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'UTF-8')  : "";
                            $consulta = "
                            SELECT
                                c4.categoria, 
                                c3.nombre, 
                                COUNT(*) as total_count
                            FROM
                                productos AS c1
                                INNER JOIN
                                moneda_ref AS c2
                                ON 
                                    c2.cod_moneda = c1.moneda
                                INNER JOIN
                                categorias AS c3
                                INNER JOIN
                                productos_agrupados AS c4
                                ON 
                                    c3.id = c4.categoria AND
                                    c1.id_grupo = c4.id_grupo
                            WHERE
                                c4.nombre LIKE '%$query%'
                            GROUP BY
                                c4.categoria
                            ORDER BY
                                c1.precio ASC; ";

                            $resultado = mysqli_query($conexion, $consulta);

                            echo "
                                <p class='[ text-lg font-bold ]'>Categorías Encontradas con el Termino <label class='text-[#FBAA35]'>'$query'</label></p>
                                <div class='w-full ml-2 mt-2'>";



                            while ($row = mysqli_fetch_assoc($resultado)) {

                                $id = $row['categoria'];

                                $nombre = $row['nombre'];
                                $total_count = $row['total_count'];

                                if ($id == $categoriaselected) {
                                    $categoria .= " 
                                        <a href='javascript:CategoriaFilter($id)' class='text-[#FBAA35] font-bold transition duration-150 ease-in-out hover:text-[#FBAA35] focus:text-[#FBAA35] active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-[#FBAA35]'>
                                            $nombre ($total_count)
                                        </a> 
                                        <br>
                                        ";
                                } else {
                                    $categoria .= "
                                         <a href='javascript:CategoriaFilter($id)' class='group text-black text-sm transition duration-150 ease-in-out hover:text-[#FBAA35] focus:text-[#FBAA35] active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-[#FBAA35]'>
                                           <label class='text-gray-400 group-hover:text-[#FBAA35]'> $nombre</label> ($total_count)
                                        </a> 
                                        <br>
                                        ";
                                }
                            }
                            echo $categoria;
                            echo "  </div>
                            
                           
                            
                            
                            ";
                        }
                    } elseif (isset($_GET['categoria']) && validar_int($_GET['categoria'])) {
                        $categoria = htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'UTF-8');
                        $categoriaselected = isset($_GET['categoria']) ? $categoria : "";
                        $consulta = "
                        SELECT * FROM `categorias` WHERE  id = '$categoriaselected' ";
                        $resultado = mysqli_query($conexion, $consulta);

                        $row = mysqli_fetch_assoc($resultado);


                        $consulta_cantidad_productos = "SELECT count(*) as cantidad FROM `productos_agrupados` WHERE categoria = '$categoriaselected' ";
                        $resultado_cantidad_productos = mysqli_query($conexion, $consulta_cantidad_productos);
                        $cantidad_productos = mysqli_fetch_assoc($resultado_cantidad_productos);
                        $cantidad_productos =  $cantidad_productos['cantidad'];

                        echo "<p class='[ text-lg font-bold ]'>Categoria <label class='text-[#FBAA35]'>'" . $row['nombre'] . " ($cantidad_productos)'</label></p>";
                        $categoria = "<p class='text-[#FBAA35] font-bold transition duration-150 ease-in-out hover:text-[#FBAA35] focus:text-[#FBAA35] active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-[#FBAA35]'>" . $row['nombre'] . " ($cantidad_productos)</p>";
                    }
                    ?>




                </div>

                <div class='!visible hidden mb-2' id='collapseExample' style="font-family: Raleway;" data-te-collapse-item> <!--contenido de modo telefono de categoria---->
                    <div class='block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 dark:text-neutral-50'>
                        <?php
                        echo "<p class='[ text-lg font-bold mb-3 ]'>Categorías </p>
                        " . $categoria;
                        ?>
                    </div>
                </div>
                <div class='!visible hidden mb-2' id='ordenarmobile' style="font-family: Raleway;" data-te-collapse-item> <!--contenido de modo telefono de ordenar---->
                    <div class='block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 dark:text-neutral-50'>

                        <select class="w-full" onchange="handlePriceFilter(this)" data-te-select-init>
                            <?php
                            $order = isset($_GET['order']) ? $_GET['order'] : "ASC";
                            $optionsorder = "";
                            if ($order == "DESC") {
                                $optionsorder = "
                                <option  value='ASC'>Menor Precio</option>
                                 <option selected value='DESC'>Mayor Precio</option>
                               ";
                            } elseif ($order == "ASC") {
                                $optionsorder = "
                                 <option selected value='ASC'>Menor Precio</option>
                                 <option value='DESC'>Mayor Precio</option>
                               ";
                            } else {
                                $order == "ASC";
                                $optionsorder = "
                                 <option selected value='ASC'>Menor Precio</option>
                                 <option value='DESC'>Mayor Precio</option>
                               ";
                            }
                            echo $optionsorder;
                            ?>
                        </select>
                        <label data-te-select-label-ref>Ordenar Por</label>

                    </div>
                </div>


                <div class="[ bg-white shadow-lg ] [ lg:w-4/5   lg:p-3 lg:rounded-lg ] [ p-3 ]" style="font-family: Raleway;">


                    <div class="[ w-full hidden justify-between items-center ] [ md:flex ] [ lg:flex ]">
                        <p class="[ text-xl ]">Resultados</p>
                        <select onchange="handlePriceFilter(this)" data-te-select-init>
                            <?php
                            echo $optionsorder;
                            ?>
                        </select>
                        <label data-te-select-label-ref>Ordenar Por</label>
                    </div>
                    <div class="space-y-2">


                        <!-- Modal -->
                        <div data-te-modal-init class="fixed left-0 top-0 z-[1055] p-5 hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="modalinfo" tabindex="-1" aria-labelledby="modalinfoLabel" aria-hidden="true">
                            <div data-te-modal-dialog-ref class="pointer-events-none relative h-[calc(100%-1rem)] w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:h-[calc(100%-3.5rem)] min-[576px]:max-w-[700px]">
                                <div class="pointer-events-auto relative flex max-h-[100%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                                    <div class="flex  shadow-lg  flex-shrink-0items-center bg-[#FBAA35] text-white justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                        <!--Modal title-->
                                        <h5 class="text-xl font-medium leading-normal text-white " id="modalinfoLabel">
                                            Info del Producto
                                        </h5>
                                        <!--Close button-->
                                        <button type="button" class="box-content text-black rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!--Modal body-->
                                    <div class="relative overflow-y-auto p-4">
                                        <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
                                            <div class="lg:col-span-3 lg:row-end-1">
                                                <div class="lg:flex lg:justify-center lg:items-center">
                                                    <div class="lg:order-2 lg:ml-5">
                                                        <div class="max-w-xl overflow-hidden rounded-lg">
                                                            <img id="imgmodal" onerror="this.onerror=null;this.src='../assets/img/imgerror.png'" class="h-[400px] w-full max-w-full object-cover" src="" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                                                <h1 id="nombreproductomodal" class="sm: text-2xl font-bold text-gray-900 sm:text-3xl capitalize"> </h1>
                                                <div class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4   sm:space-y-0">
                                                    <!-- Required font awesome   
                                                <div class="flex items-end">
                                                        <h1 id="preciomodal" class="text-3xl m-0 font-bold">0 $</h1>
                                                    </div>
                                                    -->
                                                </div>

                                                <div class="lg:col-span-3">
                                                    <div class="border-b border-gray-300">
                                                        <nav class="flex gap-4">
                                                            <a href="#modaldescripcion" title="" class="border-b-2 border-[#FBAA35] py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800"> Descripcion </a>
                                                        </nav>
                                                    </div>

                                                    <div id="modaldescripcion" class=" flow-root sm:mt-12 break-words">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex flex-col h-40">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                    <div class="overflow-hidden">
                                                        <table id="modal_tabla" class="min-w-full text-left text-sm font-light capitalize ">
                                                            <thead class="text-white">

                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal footer-->
                                    <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                        <button type="button" class="inline-block rounded bg-[#FBAA35] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                                            Cerrar
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="[ flex gap-1 items-center justify-end ] [ md:hidden  ] [ lg:hidden ]">
                            <label>Modo</label>
                            <div id="2x2" onclick="toggleView('2x2') ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>

                            </div>
                            <div id="1x1" onclick="toggleView('1x1')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
                                </svg>
                            </div>


                        </div>
                        <script>
                            function toggleView(view) {
                                if (view === '2x2') {
                                    $('#result').removeClass('grid-cols-1');
                                    $('#result').addClass('grid-cols-2');
                                    $('#1x1').removeClass('text-[#FBAA35]');
                                    $('#2x2').addClass('text-[#FBAA35]');
                                } else if (view === '1x1') {
                                    $('#result').removeClass('grid-cols-2');
                                    $('#result').addClass('grid-cols-1');
                                    $('#2x2').removeClass('text-[#FBAA35]');
                                    $('#1x1').addClass('text-[#FBAA35]');
                                }
                            }
                        </script>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                        <div id="result" class="[ mt-6 grid gap-x-2 gap-y-10   xl:gap-x-8 ] [ sm:grid-cols-2 ] [ lg:grid-cols-3 ] [ xl:grid-cols-4 ] [ 2xl:grid-cols-4 ]" style="font-family: Raleway;">


                            <?php




                            if (isset($_GET['query']) || isset($_GET['categoria'])) {


                                // obtenemos la pagina por GET, en caso que esta variable no este declarada  por default seria 1
                                $current_page =  1;
                                if (isset($_GET['page'])) {
                                    if (is_int($_GET['page'])) {
                                        $current_page = $_GET['page'];
                                    }
                                }

                                // contidad de Resultados por pagina
                                $results_per_page = 50;
                                //formula para calcular los resultados de la tabla segun la pagina en que se esta
                                $offset = ($current_page - 1) * $results_per_page;

                                $query = isset($_GET['query']) ? mysqli_real_escape_string($conexion, $_GET['query']) : "";
                                $categoria =  isset($_GET['categoria']) ?   "and c4.categoria = " . htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'UTF-8') : "";



                                include_once '../php/conexion.php';

                                if ($query != "") {
                                    $consulta = "
                                    SELECT
                                    c1.id,
                                    c4.nombre,
                                    c4.categoria,
                                    c4.imagen,
                                    c1.precio,
                                    c2.simbolo,
                                    c2.cod_moneda,
                                    c4.id_grupo,
                                    c5.cantidad 
                                FROM
                                    productos AS c1
                                    INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo
                                    INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda 
                                    left JOIN stock AS c5 ON c5.idProducto = c1.id 
                                WHERE
                                    c4.nombre LIKE '%$query%' 
                                    OR c1.id LIKE '%$query%'
                                group by c4.nombre
                                ORDER BY
                                    c1.precio $order  
                                    LIMIT $results_per_page OFFSET $offset"; //consulta para obtener los resultados segun la pagina 
                                } elseif ($categoria != "") {
                                    $consulta = "
                                    SELECT
                                    c1.id,
                                    c4.nombre,
                                    c4.categoria,
                                    c4.imagen,
                                    c1.precio,
                                    c2.simbolo,
                                    c2.cod_moneda,
                                    c4.id_grupo,
                                    c5.cantidad 
                                FROM
                                    productos AS c1
                                    INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo
                                    INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda $categoria
                                    left JOIN stock AS c5 ON c5.idProducto = c1.id 
                                group by c4.nombre
                                ORDER BY
                                    c1.precio $order  
                                    LIMIT $results_per_page OFFSET $offset"; //consulta para obtener los resultados segun la pagina 
                                }

 
                                $data = []; //variable que almacenara los resultados de la consulta
                                $data['result'] = []; //cantida de paginas que tiene la consulta
                                $data['num_pages'] = 0; //cantida de paginas que tiene la consulta
                                $resultado = mysqli_query($conexion, $consulta);
                                while ($row = mysqli_fetch_assoc($resultado)) {


                                    array_push($data['result'], [
                                        "id" => $row['id'],
                                        "id_grupo" => $row['id_grupo'],
                                        "nombre" => $row['nombre'],
                                        "categoria" => $row['categoria'],
                                        "imagen" => $row['imagen'],
                                        "precio" =>  floatval($row['precio']),
                                        "simbolo" => $row['simbolo'],
                                        "cod_moneda" => intval($row['cod_moneda']),
                                        "stock" => intval($row['cantidad']),
                                    ]);
                                }


                                //*********** consulta pra obtener la data para cuando muestre el modal ****************************************

                                if ($query != "") {
                                    $consulta2 = "   
                                    SELECT
                                    t1.*,
                                    t3.nombre,
                                    t3.descripcion ,
                                    t2.simbolo,
                                    t2.imagen
                                          FROM
                                              productos t1
                                              INNER JOIN (
                                              SELECT
                                                  c4.id_grupo,
                                                  c2.simbolo,
                                                  c4.imagen
                                              FROM
                                                  productos AS c1
                                                  INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo 
                                                  INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda
                                                  INNER JOIN stock AS c3 ON c1.id = c3.idProducto
                                                  
                                              WHERE
                                                  c4.nombre LIKE '%$query%' 
                                                  OR c1.id LIKE '%$query%' 
                                                
                                              GROUP BY
                                                  c4.nombre 
                                              ORDER BY
                                                  c1.precio $order  
                                                  LIMIT $results_per_page OFFSET $offset
                                              ) t2 ON t2.id_grupo = t1.id_grupo
                                              INNER JOIN productos_agrupados t3 ON t3.id_grupo = t1.id_grupo 
                                          ORDER BY
                                              t1.id ASC
                            
                                ";
                                } elseif ($categoria != "") {

                                    $consulta2 = "   
                                    SELECT
                                    t1.*,
                                    t3.nombre,
                                    t3.descripcion ,
                                    t2.simbolo,
                                    t2.imagen
                                          FROM
                                              productos t1
                                              INNER JOIN (
                                              SELECT
                                                  c4.id_grupo,
                                                  c2.simbolo,
                                                  c4.imagen
                                              FROM
                                                  productos AS c1
                                                  INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo 
                                                  INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda   $categoria
                                                  INNER JOIN stock AS c3 ON c1.id = c3.idProducto
                                                  
                                              WHERE
                                                  nombre LIKE '%$query%' 
                                                  OR id LIKE '%$query%' 
                                                  $categoria
                                              GROUP BY
                                                  c4.nombre 
                                              ORDER BY
                                                  c1.precio $order  
                                                  LIMIT $results_per_page OFFSET $offset
                                              ) t2 ON t2.id_grupo = t1.id_grupo
                                              INNER JOIN productos_agrupados t3 ON t3.id_grupo = t1.id_grupo 
                                          ORDER BY
                                              t1.id ASC
                            
                                ";
                                }



                                $resultado2 = mysqli_query($conexion, $consulta2);
                                $modaldata = [];
                                while ($row2 = mysqli_fetch_assoc($resultado2)) {
                                    $precio2 = number_format($row2['precio2'], 2);
                                    $precio = number_format($row2['precio'], 2);
                                    $row2['precio'] = $precio;
                                    $row2['precio2'] = $precio2;
                                    $row2['descripcion'] = str_replace('•', '<br>', $row2['descripcion']);
                                    array_push($modaldata, $row2);
                                }

                                //**************************************************************************** */


                                if ($query != "") {
                                    $sql_count = "SELECT COUNT(*) as count FROM productos_agrupados WHERE nombre LIKE '%$query%'";
                                } elseif ($categoria != "") {
                                    $sql_count = "SELECT COUNT(*) as count FROM productos_agrupados WHERE  categoria ='" . htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'UTF-8') . "' ";
                                }

                                //consutla para obtener la cantida de paginas que tiene la consulta
                                $count = mysqli_fetch_assoc(mysqli_query($conexion, $sql_count))['count'];
                                $data['num_pages'] = ceil($count / $results_per_page); //agregarmos la cantidad de paginas que tiene al array principal 

                                // http_response_code(200); //Success
                                // echo json_encode($data); //retornamos los datos



                                if (count($data['result']) != 0) {

                                    for ($i = 0; $i < count($data['result']); $i++) {

                                        $imagen = $data['result'][$i]['imagen'];
                                        $id = $data['result'][$i]['id'];
                                        $id_grupo = $data['result'][$i]['id_grupo'];
                                        $nombre = (strlen($data['result'][$i]['nombre']) > 30) ? substr($data['result'][$i]['nombre'], 0, 30) . '...' : $data['result'][$i]['nombre'];
                                        $precio = $data['result'][$i]['precio'];
                                        $simbolo = $data['result'][$i]['simbolo'];
                                        $stock = $data['result'][$i]['stock'];

                                        $count = 0;
                                        foreach ($modaldata as $object) {
                                            if ($object["id_grupo"] == $id_grupo) {
                                                // Object found, increment count
                                                $count++;
                                            }
                                        }

                                        echo "
                                            <div class='border border-2 hover:border-gray-400 rounded-lg p-3 '>
                                            <div onclick='modalinfoview(`$id`)' class='group relative cursor-pointer transition-all mx-auto   w-full ' >
                                                <div class='absolute  font-bold text-lg   w-full flex justify-end right-3 text-[#FBAA35]'>
                                                    $id
                                                </div>

                                                <div class='absolute w-full  flex justify-start z-[999] '>
                                                    <div class='bg-gray-300 hover:bg-[#FBAA35] rounded-lg group/eyes transition-colors px-1 rounded-full'>
                                                        $count+
                                                    </div>
                                                    
                                                </div>

                                                    <div class=' m-auto aspect-h-1 aspect-w-1 h-auto lg:aspect-none  overflow-hidden rounded-md    '>
                                                        <img data-te-animation-init
                                                        data-te-animation-start='onLoad'
                                                        data-te-animation='[fade-in_1s_ease-in-out]'
                                            
                                                        src='../$imagen' onerror=\"this.onerror=null;this.src='../assets/img/imgerror.png'\"\"  title='$nombre' loading='lazy' alt='$nombre' class='mx-auto  hover:scale-150 transition-all   w-full object-cover object-center [ lg:w-44 lg:h-44 ]  ' />
                                                    </div>
                                                    <div class='[ cursor-pointer  ]' >
                                                        <div class='mt-4 flex justify-between'>
                                                            <div class='w-full'>
                                                            <h3 class='text-sm text-gray-700'>
                                                                
                                                                <p class=' [ text-[15px] w-full text-center text-black bg-[#FBAA35] uppercase font-bold ] [ md:text-md ] [ lg:text-lg ]' style='font-family: `Montserrat`, cursive;' >$nombre</p>
                                                            </h3>
                                                            <hr class='h-px my-3 bg-gray-200 border-0 dark:bg-gray-700'>
                                                            <label class='font-bold'>Ref: $precio$simbolo</label>
                                                            <p class='mt-1 text-[12px] font-bold text-gray-500 break-words'>Disponibles: $stock</p>
                                                            </div>
                                                            <p class='text-sm font-medium text-gray-900'></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form>
                                                <div class='relative    flex w-full flex-wrap items-stretch flex-nowrap'>
                                                        <input min='0' id='$id' type='number'
                                                        class='relative m-0 block z-20 w-14 text-center  min-w-0 flex-auto rounded-l border border-r-0 border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out   focus:border-warning-600 focus:text-neutral-700 focus:shadow-te-warning focus:outline-none '
                                                        aria-label='Recipient' username value='1' aria-describedby='button-addon2' />
                                                        <button   data-te-ripple-init data-te-ripple-color='light' type='submit' data-te-ripple-init data-te-ripple-color='warning'
                                                        class='relative   rounded-r bg-[#FBAA35] opa px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-warning-700 hover:shadow-lg   focus:bg-warning-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-warning-800 active:shadow-lg'
                                                        type='button' id='button-addon2'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'
                                                            class='h-4 w-4'>
                                                            <path stroke-linecap='round' stroke-linejoin='round'
                                                            d='M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z' />
                                                        </svg>
                                                        </button>
                                                    </div>
                                                    </form>
                                                
                                            </div> ";
                                    }
                                    echo " </div>
                                    <hr class='h-px my-8 bg-gray-200 border-0 dark:bg-gray-700'>
                                            <nav aria-label='Page navigation example'>
                                                <ul class='list-style-none flex flex-wrap w-full justify-center [ md:justify-end ] [ lg:justify-end ]'>";
                                    for ($j = 1; $j <= $data['num_pages']; $j++) {

                                        if ($j != $current_page) {
                                            echo "
                                                    <li>
                                                        <a class='relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white' href='?query=$query&page=$j&order=$order'>$j
                                                        <span class='absolute -m-px h-px w-px overflow-hidden whitespace-nowrap border-0 p-0 [clip:rect(0,0,0,0)]'>(current)</span>
                                                        </a> 
                                                    </li>
                                                ";
                                        } else {
                                            echo "
                                                    <li>
                                                <a class='relative block rounded bg-warning-100 px-3 py-1.5 text-sm font-medium text-warning-700 transition-all duration-300' href='#'>$current_page</a>
                                                    
                                                </li>
                                                    ";
                                        }
                                    }
                                    echo "
                                            </ul>
                                        </nav>
                                    </div>";


                                    //consulta pra obtener l;a data para cuando muestre el modal 
                                    $consulta = "   
                                        SELECT
                                        t1.*,
                                        t3.nombre,
                                        t3.descripcion ,
                                        t2.simbolo,
                                        t2.imagen,
                                        t2.cod_moneda
                                    FROM
                                        productos t1
                                        INNER JOIN (
                                        SELECT
                                            c4.id_grupo,
                                            c2.simbolo,
                                            c4.imagen,
                                            c1.moneda as cod_moneda
                                        FROM
                                            productos AS c1
                                            INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda
                                            INNER JOIN stock AS c3 ON c1.id = c3.idProducto
                                            INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo 
                                        WHERE
                                            nombre LIKE '%$query%' 
                                            OR id LIKE '%$query%' 
                                        GROUP BY
                                            c4.nombre 
                                        ORDER BY
                                            c1.precio $order  
                                            LIMIT $results_per_page OFFSET $offset
                                        ) t2 ON t2.id_grupo = t1.id_grupo
                                        INNER JOIN productos_agrupados t3 ON t3.id_grupo = t1.id_grupo 
                                    ORDER BY
                                        t1.id ASC
                                    
                                        ";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    $modaldata = [];
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        $precio2 = number_format($row['precio2'], 2);
                                        $precio = number_format($row['precio'], 2);
                                        $row['precio'] = $precio;
                                        $row['precio2'] = $precio2;
                                        $row['descripcion'] = str_replace('•', '<br>', $row['descripcion']);
                                        array_push($modaldata, $row);
                                    }
                                } else {
                                    http_response_code(409); //error
                                    echo "
                            
                                    <div id='search-empty' class='search-alert flex items-center justify-center space-x-4 mt-4  '>
                                        <svg class='w-6 h-6 text-gray-500' fill='currentColor' viewBox='0 0 20 20'>
                                            <path fill-rule='evenodd'
                                                d='M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zM12 7h-4a1 1 0 0 1 0-2h4a1 1 0 0 1 0 2zm-3 4a1 1 0 1 1 2 0a1 1 0 0 1-2 0z'
                                                clip-rule='evenodd' />
                                        </svg>
                                        <p class='text-gray-500'>Vaya.. no se Encontro Ningun Producto</p>
                                    </div>
                            
                                "; //retornamos los datos
                                }
                            }

                            ?>






                        </div>
                    </div>
                </div>
            </div>
            <div class="[ fixed flex z-30 justify-end bottom-0 right-0 ]" style="font-family: Raleway;" id="BtnTicket">
                <div class="border  border-gray-300  rounded-lg   bg-white ">
                    <h2 class="mb-0" id="headingTwo">
                        <button class="group relative flex w-full items-center   border-0 bg-white py-2 px-3 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none  [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-warning [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] " type="button" data-te-collapse-init data-te-collapse-collapsed data-te-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="[ flex gap-1 items-center relative ]">

                                <div id="newitemadd_status" class="[ hidden absolute w-full  ]">
                                    <span class="animate-ping  absolute inline-flex h-3 w-3 bottom-2 left-3 rounded-full bg-warning-400 "></span>
                                    <span class="absolute inline-flex h-3 w-3 bottom-2 left-3 rounded-full bg-[#FBAA35] "></span>

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
        </div>

        <footer data-aos="fade-up" id="contactanos" class="bg-[#FBAA35] text-center text-neutral-900   lg:text-left transition-all">
            <!-- Main container div: holds the entire content of the footer, including four sections (Tailwind Elements, Products, Useful links, and Contact), with responsive styling and appropriate padding/margins. -->
            <div class="mx-2 py-10 text-center md:text-left">
                <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Tailwind Elements section -->
                    <div class="[ flex items-center  justify-center ] [ md:justify-start ] [ lg:justify-start ]">
                        <a class="flex items-center [ w-24 h-10 ] [ md:w-32 md:h-32 ] [ lg:w-48 lg:h-20 ]" href="#">
                            <img src="../assets/img/logo-white.png" alt="" srcset="" />
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
                                galpón #8, del centro industrial Barcelona, ubicado en la av.
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
            $(document).ready(function() {

                localreaddata();
                toggleView('1x1'); //stilo de vista de los resultados
                categorias();
            });

            async function categorias() {

                const data = await $.ajax({
                    url: "../api/categorias/index.php",
                    type: 'GET',
                });

                data.map((item) => {
                    $('#navcategoria').append(`
                        <li>
                            <a href='../search/?categoria=${item.id}' class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>${item.nombre}</a>
                        </li>`);

                    $('#navcategoria_mobile').append(`
                        <li>
                            <a href='../search/?categoria=${item.id}' class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>${item.nombre}</a>
                        </li>  `);
                });

            }
            <?php

            if (isset($modaldata)) {
                echo "let arrresult = " . json_encode($modaldata) . "\n    ";
            }

            ?>
            const myModalEl = document.getElementById("modalinfo");
            const modal = new te.Modal(myModalEl);

            let productos = [];
            let carritostorage = typeof localStorage.CARRITO == "undefined" ? [] : JSON.parse(localStorage.CARRITO);
            let filteredArray = [];

            function modalinfoview(id) {

                debugger

                let validar = arrresult.some(item => item.id === id);

                if (validar) {
                    // Select the table body by ID or class
                    var tableBody = $('#modal_tabla  tbody'); // Replace "table-id" with the actual ID of your table

                    // Remove all rows from the table body
                    tableBody.find('tr').remove();
                    //$('#modal_tabla').html('');

                    let imgmodal = document.getElementById("imgmodal");
                    let nombreproductomodal = document.getElementById("nombreproductomodal");
                    let preciomodal = document.getElementById("preciomodal");
                    let modaldescripcion = document.getElementById("modaldescripcion");

                    let data = arrresult.filter(item => item.id === id);
                    data = data[0];
                    imgmodal.src = ".." + data.imagen;
                    nombreproductomodal.innerHTML = data.nombre;
                    //preciomodal.innerHTML = data.precio + "" + data.simbolo;
                    modaldescripcion.innerHTML = data.descripcion;



                    // Filter the array to get only the objects with id=2
                    filteredArray = arrresult.filter(function(obj) {
                        return obj.id_grupo === data.id_grupo;
                    });

                    $('#modal_tabla > thead').html(`
                        
                    `);

                    $('#modal_tabla > thead').append(`
                        <tr class='bg-black'>
                            <th scope="col" class="px-6 py-4">ID</th>
                            <th scope="col" class="px-6 py-4">caracteristica1</th>
                            <th scope="col" class="px-6 py-4">caracteristica2</th>
                            <th scope="col" class="px-6 py-4">caracteristica3</th>
                            <th scope="col" class="px-6 py-4">caracteristica4</th>
                            <th scope="col" class="px-6 py-4">caracteristica5</th>
                            <th scope="col" class="px-6 py-4">Precio</th>
                            <th scope="col" class="px-6 py-4">Precio2</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    `);

                    filteredArray.map((item) => {
                        $('#modal_tabla > tbody').append(`
                        <tr class="border-b dark:border-neutral-500 bg-[#FBAA35]">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">${item.id}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.caracteristica}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.caracteristica2}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.caracteristica3}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.caracteristica4}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.caracteristica5}</td>
                            <td class="whitespace-nowrap px-6 py-4">${item.precio+""+item.simbolo}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">${item.precio2+""+item.simbolo}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                            <div class="relative flex w-full flex-wrap flex-nowrap items-stretch">
                                <input min="0" id='modal_input_${item.id}'  type="number" class="focus:border-warning-600 focus:shadow-te-warning relative z-20 m-0 block w-14 min-w-0 flex-auto rounded-l border border-r-0 border-solid border-neutral-300 bg-transparent bg-white bg-clip-padding px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out focus:text-neutral-700 focus:outline-none" aria-label="Recipient" username="" value="1" aria-describedby="button-addon2" />
                                <button onclick='Modal_Agregar_Carrito("${item.id}","modal_input_${item.id}")' data-te-ripple-init="" data-te-ripple-color="light" type="submit" class="opa hover:bg-warning-700 focus:bg-warning-700 active:bg-warning-800 relative rounded-r bg-black hover:bg-gray-800 transition-colors px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg" id="button-addon2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            </td>
                        </tr>
                    
                    `);
                    });

                    modal.show();

                    let table = document.getElementById('modal_tabla');
                    let headers = table.querySelectorAll('thead th');
                    let rows = table.querySelectorAll('tbody tr');

                    for (let i = headers.length - 2; i >= 0; i--) { // cambiamos el límite del bucle
                        let isEmpty = true;
                        for (let j = 0; j < rows.length; j++) {
                            let cell = rows[j].querySelectorAll('td')[i];
                            if (cell.textContent.trim() !== '') {
                                isEmpty = false;
                                break;
                            }
                        }
                        if (isEmpty) {
                            headers[i].remove();
                            for (let j = 0; j < rows.length; j++) {
                                rows[j].querySelectorAll('td')[i].remove();
                            }
                        }
                    }




                }

            }

            function Modal_Agregar_Carrito(id_producto, id_input) {



                if (!validarString(id_producto, 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&')) {
                    Swal.fire({
                        icon: 'Info',
                        title: 'Id del Producto No Valido'
                    })
                    return;
                }

                let cantidad = $(`#${id_input}`).val();
                if (!validarMonto(cantidad)) {
                    Swal.fire({
                        icon: 'Info',
                        title: 'Monto No Valido'
                    })
                    return;
                }

                let arr_producto = filteredArray.find((item) => {
                    return item.id == id_producto
                });

                if (typeof arr_producto == 'undefined') {
                    Swal.fire({
                        icon: 'Info',
                        title: 'Producto No Encontrado'
                    })
                    return;
                }

                Carrito.add(id_producto, cantidad, arr_producto);
                $(`#${id_input}`).val(1);
            }



            function handlePriceFilter(selectEl) {

                // get the selected value
                var selectedValue = selectEl.value;

                // parse the URL's query parameters
                var searchParams = new URLSearchParams(window.location.search);

                // check if the 'order' parameter exists
                if (searchParams.has("order")) {
                    // update the value of the 'order' parameter
                    searchParams.set("order", selectedValue);
                } else {
                    // add the 'order' parameter to the search parameters
                    searchParams.append("order", selectedValue);
                }

                // combine the updated search parameters with the URL
                var newUrl = window.location.origin + window.location.pathname + "?" + searchParams.toString();

                // navigate to the updated URL
                window.location.href = newUrl;
            }



            function CategoriaFilter(id) {
                // get the selected value
                var selectedValue = id;

                // parse the URL's query parameters
                var searchParams = new URLSearchParams(window.location.search);

                // check if the 'order' parameter exists
                if (searchParams.has("categoria")) {
                    // update the value of the 'order' parameter
                    searchParams.set("categoria", selectedValue);
                } else {
                    // add the 'order' parameter to the search parameters
                    searchParams.append("categoria", selectedValue);
                }

                // combine the updated search parameters with the URL
                var newUrl = window.location.origin + window.location.pathname + "?" + searchParams.toString();

                // navigate to the updated URL
                window.location.href = newUrl;
            }

            var forms = document.querySelectorAll("#result form") // seleccionar todos los formularios
            for (var i = 0; i < forms.length; i++) {
                forms[i].addEventListener('submit', e => {
                    e.preventDefault();

                    let data = arrresult.filter(item => item.id === e.target[0].id);
                    data = data[0];
                    let validar = Carrito.add(e.target[0].id, e.target[0].value, data);

                });
            }

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
                    window.location.href = '../carrito/'
                }
            });

            $('#btn_subir').fadeOut(); //ocultar con animación
            $(window).scroll(function() {

                if ($(this).scrollTop() > 0) {
                    $('#btn_subir').fadeIn(); //mostrar con animación
                } else {

                    $('#btn_subir').fadeOut(); //ocultar con animación
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