<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (is_string($id) && strlen($id) <= 11) {
        include_once '../php/conexion.php';
        $consulta = "
            SELECT
            c1.id,
            c1.nombre,
            c1.descripcion,
            c1.categoria,
            c1.imagen,
            c1.precio,
            c2.simbolo,
            c3.nombre as nombrecategoria 
            FROM
            productos as c1
            INNER JOIN moneda_ref as c2 ON c2.cod_moneda = c1.moneda
            INNER JOIN categorias as c3 ON c3.id = c1.categoria
            WHERE
            c1.id = '$id'"; //consulta para obtener los resultados segun la pagina 
        $resultado = mysqli_query($conexion, $consulta);
        $data = [];
        $row = mysqli_fetch_assoc($resultado);

        $data =  [
            "id" => $row['id'],
            "nombre" => $row['nombre'],
            "descripcion" => $row['descripcion'],
            "nombrecategoria" => $row['nombrecategoria'],
            "categoriaid" => $row['categoria'],
            "imagen" => $row['imagen'],
            "precio" => str_replace(',', '.', number_format((float)$row['precio'], 2, ',', '')),
            "simbolo" => $row['simbolo'],
        ];

        $precio = $data['precio'];
        $simbolo = $data['simbolo'];
        $nombrecategoria = $data['nombrecategoria'];
    } else {
        // manejar el caso en que la variable no es válida
    }
} else {
    // manejar el caso en que la variable no existe
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
    <title><?php echo $data['nombre'] ?></title>
</head>

<body>
    <!-- Header Navbar -->
    <nav class="fixed top-0 left-0 z-20 w-full border-b border-gray-200 bg-white py-2.5 px-6 sm:px-4">
        <div class="max-w-screen-xl flex   items-center justify-center gap-3 mx-auto 4">
            <a href="#" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white hidden [ lg:block ]">Test</span>
            </a>

            <form action="../search/" method="get">
                <div class="[ items-center flex gap-3 justify-between w-full md:order-1 ] [ lg:w-[600px] ]" id="navbar-sticky">

                    <div class="relative   flex w-full flex-wrap items-stretch">
                        <input value="<?php if (isset($_GET['query'])) {
                                            echo $_GET['query'];
                                        } else {
                                            echo "";
                                        } ?>" type="Buscar" class="relative m-0 -mr-0.5 block w-full min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-warning focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-warning" name="query" placeholder="Buscar Producto" aria-label="Search" aria-describedby="button-addon1" />

                        <!--Search button-->
                        <button type="submit" class="relative z-[2] flex items-center rounded-r bg-warning px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-warning-700 hover:shadow-lg focus:bg-warning-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-warning-800 active:shadow-lg" type="button" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </button>



                    </div>

                    <span class="relative flex cursor-pointer">
                        <div class="absolute w-full flex ml-1 justify-end ">
                            <span class=" h-3 w-3 rounded-full bg-warning"></span>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </span>




                </div>
            </form>
        </div>
    </nav>



    <section class="py-12 sm:py-16 [ lg:w-4/5 lg:mx-auto ]   ">
        <div class="container mx-auto px-4">
            <nav class="flex">
                <ol role="list" class="flex items-center">
                    <li class="text-left">
                        <div class="-m-1">
                            <a href="../" class="rounded-md p-1 text-sm font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800"> Casa </a>
                        </div>
                    </li>

                    <?php

                    echo "
                    <li class='text-left'>
                        <div class='flex items-center'>
                            <span class='mx-2 text-gray-400'>/</span>
                            <div class='-m-1'>
                                <a href='#' class='rounded-md p-1 text-sm font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800' aria-current='page'>$nombrecategoria</a>
                            </div>
                        </div>
                    </li>
                   
                    ";
                    echo "
                    <li class='text-left'>
                        <div class='flex items-center'>
                            <span class='mx-2 text-gray-400'>/</span>
                            <div class='-m-1'>
                                <a href='#' class='rounded-md p-1 text-sm font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800' aria-current='page'>" . $data['nombre'] . "</a>
                            </div>
                        </div>
                    </li>
                    
                    ";



                    ?>


                </ol>
            </nav>

            <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
                <div class="lg:col-span-3 lg:row-end-1">
                    <div class="lg:flex lg:justify-center lg:items-center">
                        <div class="lg:order-2 lg:ml-5">
                            <div class="max-w-xl overflow-hidden rounded-lg">
                                <img class="h-[600px] w-full max-w-full object-cover" src="../<?php echo $data['imagen']; ?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                    <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl capitalize"><?php echo $data['nombre']; ?></h1>





                    <div class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
                        <div class="flex items-end">
                            <h1 class="text-3xl m-0 font-bold"><?php echo "$precio $simbolo"; ?></h1>
                        </div>
                        <!-- Required font awesome -->
                        <form>
                            <button id="<?php echo $data['id'];   ?>" onclick="agregacarrito(this)" type="button" data-te-ripple-init data-te-ripple-color="light" class="flex items-center rounded bg-warning  px-12 py-5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 h-6 w-6 font-bold ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <label class="[ font-bold ]">Agregar al Carrito</label>

                            </button>
                        </form>
                    </div>

                    <div class="lg:col-span-3">
                        <div class="border-b border-gray-300">
                            <nav class="flex gap-4">
                                <a href="#" title="" class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800"> Descripccion </a>
                            </nav>
                        </div>

                        <div class="mt-8 flow-root sm:mt-12">
                            <?php echo $row['descripcion']; ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script>
        $(document).ready(() => {
            let carrito = typeof localStorage.CARRITO == "undefined" ? [] : JSON.parse(localStorage.CARRITO);
            const validarbtn = carrito.some((p) => {
                return p.id == "<?php echo $data['id'];   ?>";
            });
            if (validarbtn) {
                $(`#<?php echo $data['id'];   ?>`).prop("disabled", true);
                $(`#<?php echo $data['id'];   ?>`).addClass("disabled:opacity-70");
            }


        })
        let productos = [];
        let carrito = typeof localStorage.CARRITO == "undefined" ? [] : JSON.parse(localStorage.CARRITO);

        function agregacarrito(data) {
            // obtener id del boton presionado
            const productoID = data.id;

            // verificar si el producto ya está en el carrito
            const existeEnCarrito = carrito.some((p) => {

                return p.id == productoID
            });
            if (existeEnCarrito) {
                // si el producto ya está en el carrito, mostrar un mensaje de error
                alert('Este producto ya está en el carrito.');
            } else {
                // si el producto no está en el carrito, agregarlo
                carrito.push({
                    id: productoID
                });
                // GUARDAR EN STORAGE
                localStorage.setItem("CARRITO", JSON.stringify(carrito));
                $(`#<?php echo $data['id'];   ?>`).prop("disabled", true);
                // GENERAR SALIDA DEL PRODUCTO
                //carritoUI(carrito);
            }
        }
    </script>
</body>

</html>