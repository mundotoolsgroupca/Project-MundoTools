<?php
session_name("ecomercer_admin_data");
session_start();
if (!isset($_SESSION['Usuario'])) { //si no existe una session sale del sistema
    header("Location: ../../page/404.html"); //validar el estado de la session al momento de ingresar al modulo 
    exit;
}
?>

<div class="[ flex gap-3 flex-col ] lg:flex-row">

    <div class="[  rounded-lg bg-white p-6 shadow-lg w-full ] [  ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Tokens</p>
            <span id="TokensLoader"> </span>
        </div>

        <div class="[ flex gap-1 flex-col items-center justify-center   ] [ lg:flex-row lg:justify-between ]">
            <div>
                <input id="TokenOrdenes" type="date" value="2023-05-22" class="w-full p-2 my-2 text-center border border-gray-300 rounded-md lg:w-auto focus:outline-none focus:ring-2 ring-blue-200">
            </div>

            <button onclick="tabla_tokens_consultar()" type="button" data-te-ripple-init="" data-te-ripple-color="light" class="flex gap-1 inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                </svg>

                Actualizar
            </button>

        </div>

        <div class="flex flex-col overflow-x-auto">
            <div class="sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table id="TokensTabla" class="min-w-full text-left text-sm font-light">
                            <thead class="bg-neutral-800 text-white border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th data-name="name" class="name" data-type="text" scope="col" class="px-6 py-4">Id</th>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th scope="col" class="px-6 py-4">Fecha_Creacion</th>
                                    <th scope="col" class="px-6 py-4">Fecha_Vencimiento</th>
                                    <th scope="col" class="px-6 py-4">Token</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    tabla_tokens_consultar();

    function tabla_tokens_consultar() {
        $.ajax({
            // la URL para la petición
            url: "./api-v1/tokens/index.php",

            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },


            // especifica si será una petición POST o GET
            type: 'GET',

            // el tipo de información que se espera de respuesta
            dataType: 'json',
            beforeSend: () => {
                $('#TokensLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                        <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                        </div>`);
            },

            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success: function(response) {
                $('#TokensLoader').html(``);
                if (response.result) {

                    $('#TokensTabla').DataTable({
                        "bDestroy": true,
                        order: [
                            [0, 'desc']
                        ],
                        paging: true,
                        select: true,
                        targets: 20,
                        scrollY: '40vh',
                        "processing": true,
                        "autoWidth": false,
                        language: {
                            //?dataTable en Español
                            url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json',
                            //? input de buscar tengo un texto
                            searchPlaceholder: "Filtrar"

                        },
                        "data": response.data,
                        "columns": [{
                                "data": "id"
                            }, {
                                "data": "nombre_usuario"
                            },
                            {
                                "data": "fecha_creacion"
                            },
                            {
                                "data": "fecha_vencimiento"
                            },
                            {
                                "data": "token"
                            },
                            {
                                "data": null,
                                "bSortable": false,
                                "mRender": function(data, type, value) {

                                    if (data.status == 0) {
                                        return `
                                        <td class="py-3 px-6 text-center">
                                        <span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-danger-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-danger-700">
                                        Usado 
                                        </span>
                                        </td>`;
                                    } else if (data.status == 1) {
                                        return `
                                        <td class="py-3 px-6 text-center">
                                        <span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-success-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-success-700"> 
                                            Disponible 
                                        </span>
                                        </td>`;
                                    } else if (data.status == 2) {
                                        return `
                                        <td class="py-3 px-6 text-center">
                                        <span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-secondary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-secondary-800">
                                        Vencido 
                                        </span>
                                        </td>`;

                                    } else if (data.status == 3) {
                                        return `
                                        <td class="py-3 px-6 text-center">
                                        <span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-secondary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-secondary-800">
                                        Cancelado 
                                        </span>
                                        </td>`;

                                    }
                                }
                            },


                        ],
                        responsive: true,
                    });

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
                        title: response.mensaje
                    });

                }

            },

            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error: function(xhr, status) {
                $('#TokensLoader').html(``);
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
        });

    }
</script>