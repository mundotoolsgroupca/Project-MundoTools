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
    <link rel="icon" href="../assets/img/logo-white.png" />
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
    <script src="../assets/js/index.js"></script>
    <!---------Generador de PDF-------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
    <!---------sweetalert-------->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : 0; ?>">
    <title>Carrito</title>
</head>

<body>

    <div class="relative mx-auto w-full bg-white">
        <div class="grid min-h-screen grid-cols-10">
            <div class="col-span-full py-6 px-4 sm:py-12 lg:col-span-6 lg:py-24">
                <div class="mx-auto w-full max-w-lg">
                    <div class="flex gap-1 items-center">
                        <h1 class="relative text-2xl font-medium text-gray-700 sm:text-3xl capitalize">
                            <div class="flex items-center gap-1 ">
                                <a class="text-[#FBAA35]" href="../">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75"></path>
                                    </svg>
                                </a>
                                Datos de la Empresa
                            </div>

                            <span class="mt-2 block h-1 w-10 bg-[#FBAA35] sm:w-20"></span>
                        </h1>
                        <span id="loader" class='mt-[2rem]'>

                        </span>
                    </div>


                    <form id="pedidoform" action="" class="mt-10 flex flex-col space-y-4">

                        <div class="relative" data-te-input-wrapper-init>
                            <input type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="nombreempresa" name='nombreempresa' placeholder="Example label" data-te-input-showcounter="true" maxlength="100" />
                            <label for="nombreempresa" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Nombre de la Empresa
                            </label>
                            <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                        </div>

                        <div class="relative" data-te-input-wrapper-init>
                            <input type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name='responsable' id="responsable" placeholder="Example label" data-te-input-showcounter="true" maxlength="100" />
                            <label for="responsable" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Responsable
                            </label>
                            <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                        </div>

                        <div class="relative" data-te-input-wrapper-init>
                            <input oninput="validarTelefono(this)" type="tel" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="telefono" name='telefono' placeholder="Example label" data-te-input-showcounter="true" maxlength="11" />
                            <label for="telefono" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Telefono
                            </label>
                            <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                        </div>

                        <div class="[ flex gap-1 ]">
                            <div class="w-1/6">
                                <select name="tipo_documento" id="tipo_documento" data-te-select-init>
                                    <option value="J">
                                        J
                                    </option>
                                    <option value="G">
                                        G
                                    </option>
                                    <option value="E">
                                        E
                                    </option>
                                    <option selected value="V">
                                        V
                                    </option>
                                </select>
                            </div>


                            <div class="relative w-5/6" data-te-input-wrapper-init>
                                <input type="text" oninput="validarNumeros(this)" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="nro_documento" name='nro_documento' placeholder="Example label" data-te-input-showcounter="true" maxlength="9" />
                                <label for="nro_documento" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Documento
                                </label>
                                <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                            </div>
                        </div>
                        <div class="relative" data-te-input-wrapper-init>
                            <input oninput="validateInput(this);" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="direccion" name='direccion' placeholder="Example label" data-te-input-showcounter="true" maxlength="50" />
                            <label for="direccion" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Direccion
                            </label>
                            <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                        </div>

                        <?php

                        if (!isset($_SESSION['usuario'])) {
                            echo "
                          <div class='relative' data-te-input-wrapper-init>
                            <input oninput='validateInput(this);' type='text' class='peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0' id='token' name='token' placeholder='Example label' data-te-input-showcounter='true' maxlength='10' />
                            <label for='token' class='pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary'>Token de Un Solo Uso
                            </label>
                            <div class='absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary' data-te-input-helper-ref></div>
                          </div>
                          ";
                        }

                        ?>

                        <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                            <input class="relative peer/check float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" value="" id="check_correo" />
                            <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="check_correo">
                                Default checkbox
                            </label>

                            <div class=" hidden peer-checked/check:block relative mb-3" data-te-input-wrapper-init>
                                <input name="correo" type="mail" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="correo" placeholder="Example label" />
                                <label for="correo" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Correo
                                </label>

                            </div>




                        </div>


                        <div class="[ w-full flex justify-center  ] [ lg:justify-end ]">
                            <button id="btn_CargarPedido" type="submit" data-te-ripple-init data-te-ripple-color="light" class="flex items-center gap-1 rounded bg-[#FBAA35] disabled:opacity-50 mt-3 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out   hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]  focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0   active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                Procesar Pedido
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="relative col-span-full flex flex-col py-6 pl-8 pr-4 sm:py-12 lg:col-span-4 lg:py-24">
                <h2 class="sr-only">Order summary</h2>
                <div>

                    <div class="absolute inset-0 h-full w-full bg-gradient-to-t from-[#A37313] to-[#FBAA35] opacity-95"></div>
                </div>
                <h1 class="relative text-white text-xl font-medium text-gray-700 p-0 m-0  ">
                    Detalle Del Pedido

                </h1>
                <div class="mt-3 relative max-h-96 overflow-y-scroll">
                    <ul id="products" class="space-y-5">
                    </ul>
                </div>

                <div class="relative mt-10 text-white">
                    <div class="my-5 h-0.5 w-full bg-white bg-opacity-30"></div>
                    <div class="space-y-2">
                        <p class="flex justify-between text-lg font-bold text-white"><span>Precio Total:</span><span id="preciototal">0.00</span></p>
                    </div>
                    <!--------
                    <h3 class="mb-5 text-lg font-bold">Support</h3>
                    <p class="text-sm font-semibold">+01 653 235 211 <span class="font-light">(International)</span></p>
                    <p class="mt-1 text-sm font-semibold">support@nanohair.com <span class="font-light">(Email)</span></p>
                    <p class="mt-2 text-xs font-medium">Call us now for payment related issues</p>

                    --->
                </div>
                <!--------
                <div class="relative mt-10 flex">
                    <p class="flex flex-col"><span class="text-sm font-bold text-white">Money Back Guarantee</span><span class="text-xs font-medium text-white">within 30 days of purchase</span></p>
                </div>
                --->
            </div>
        </div>



    </div>



    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>


    <script>
        let carritostorage = typeof localStorage.CARRITO == "undefined" ? [] : JSON.parse(localStorage.CARRITO);
        if (carritostorage.length != 0) {

            pdfpdroductcontent = [];
            pdfpdroductcontent.push(['Producto', 'Cantidad', 'Precio Unitario', 'Total']);
            carritostorage.map((item) => {

                $('#products').append(`
                        <li class="flex justify-between">
                            <div class="inline-flex">
                                <div class='max-h-16 w-32 flex justify-center'>
                                    <img src="..${item.imagen}" alt="${item.nombre}" title='${item.nombre}' class="h-full " />
                                </div>
                                
                                <div class="ml-3">
                                    <p class="text-base font-semibold text-white">${item.nombre}</p>
                                    <!-----<p class="text-sm font-medium text-white text-opacity-80">Hair Dryer</p>---->
                                </div>
                            </div>
                            <div class='[ flex gap-1 ]'>
                                <p class="text-base font-semibold text-white">${item.precio}${item.simbolo}</p>
                                <label class="text-sm font-semibold text-gray-200">(${item.cantidad}x)</label>
                            </div>
                        </li>
                `);
                pdfpdroductcontent.push([
                    item.nombre,
                    item.cantidad,
                    item.precio + "" + item.simbolo,
                    item.precio * item.cantidad + "" + item.simbolo
                ]);
            });
            pdfpdroductcontent.push([{
                text: 'Total:',
                colSpan: 3,
                alignment: 'right'
            }, {}, {}, `$${sumtotal(carritostorage)}`]);

            $('#preciototal').text(sumtotal(carritostorage));


        }
        $(document).ready(function() {

            if (carritostorage.length == 0) {
                window.location.href = '../tienda.php'
            }
        });


        function sumtotal(arr = []) {
            let total = 0;

            for (let i = 0; i < arr.length; i++) {
                let producto = arr[i];
                let subtotal = arr[i].precio * arr[i].cantidad;
                total += subtotal;
            }
            return total.toFixed(4);
        }



        function validateInput(input) {
            const regex = /^[a-zA-Z0-9\. ]*$/;
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\. ]/g, '');
            }
        }

        function validarTelefono(input) {
            const regexTelefono = /^\d{0,3}-?\d{0,3}-?\d{0,6}$/;

            const esValido = regexTelefono.test(input.value);
            if (!esValido) {
                input.value = input.value.slice(0, -1);
            }

        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validarNumeros(input) {
            const regexNumeros = /^[0-9]+$/;

            const esValido = regexNumeros.test(input.value);
            if (!esValido) {
                input.value = input.value.replace(/\D/g, '');
            }
        }



        const form = document.querySelector('form');
        form.addEventListener('submit', async function() {
            event.preventDefault();

            let nombreempresa = $('#nombreempresa').val();
            let responsable = $('#responsable').val();
            let telefono = $('#telefono').val();
            let tipo_documento = $('#tipo_documento').val();
            let nro_documento = $('#nro_documento').val();
            let direccion = $('#direccion').val();
            let correo = $('#correo').val();
            let check_correo = $('#check_correo').prop('checked');

            if (!nombreempresa.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Por favor ingrese el nombre de la empresa'
                })
                $('#nombreempresa').focus();
                return false;
            }

            // verifica si el nombre del responsable es válido (no está vacío)
            if (!responsable.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Por favor ingrese el responsable'
                })
                $('#responsable').focus();
                return false;
            }
            if (!tipo_documento.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Seleccione el Tipo de Documento'
                })
                $('#nombreempresa').focus();
                return false;
            }
            // verifica si el nombre del responsable es válido (no está vacío)
            if (!nro_documento.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Ingrese el Numero de Documento'
                })
                $('#rif').focus();
                return false;
            }
            // verifica si el nombre del responsable es válido (no está vacío)
            if (!direccion.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Por favor ingrese la direccion'
                })
                $('#direccion').focus();
                return false;
            }

            if (!correo.trim()) {
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
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Correo no Valido'
                })
                $('#direccion').focus();
                return false;
            }

            const formData = $('#pedidoform').serialize();
            const result = await $.ajax({
                url: "../api/orden/index.php",
                type: 'POST',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    formData,
                    carritostorage
                },
                beforeSend: () => {
                    $('#btn_CargarPedido').prop('disabled', true);
                    $('#btn_CargarPedido').html(`<div class="flex gap-1 items-center h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div><label>Procesando Revise su Correo</label>`);

                },
                success: (response) => {

                    if (response.result) {
                        $('#btn_ingresar').html(`Realizado`);
                        $('#loader').html(` `);
                        $('#nombreempresa').val('');
                        $('#responsable').val('');
                        $('#telefono').val('');
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
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.mensaje
                        })
                        Carrito.clear(); //si guardo los datos limpamos el carrito
                        setInterval(() => {
                            window.location.href = '../tienda.php';
                        }, 3000);


                        return;

                    } else {

                        $('#btn_CargarPedido').html(`PROCESAR PEDIDO`);
                        $('#btn_CargarPedido').prop('disabled', false);
                        $('#loader').html(` `);
                        $('#nombreempresa').val('');
                        $('#responsable').val('');
                        $('#telefono').val('');
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
                            title: response.mensaje
                        });

                        return;
                    }

                },
                error: function(xhr, status) {
                    $('#btn_CargarPedido').html(`PROCESAR PEDIDO`);
                    $('#btn_CargarPedido').prop('disabled', false);
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

            })





        });
    </script>
</body>

</html>