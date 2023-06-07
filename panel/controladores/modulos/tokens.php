<?php

session_name("ecomercer_user_data");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../../../");
}
?>
<div class='[ flex gap-1  flex-col w-full ]'>
    <h1 class="[ m-0 flex items-center gap-3 [ text-sm ] [ md:text-md ] [ lg:text-lg ]  ]">
        Tokens de Un Solo Uso
        <span id='loaderstatus' class='my-auto flex justify-center'>

        </span>
    </h1>

    <div class="[ flex gap-1 flex-col flex-nowrap overflow-x-auto  rounded-lg ] [ md:flex-row ] [ lg:flex-row ]">
        <div class='[  bg-white p-3 rounded-lg shadow-lg ] [ md:w-full ] [ lg:w-1/4 ]'>
            <div class='w-full'>

                <div class="mb-4 rounded-md border-l-[6px] border-solid border-primary-600 bg-primary-100 p-2.5 dark:border-white dark:bg-primary-900 ">
                    <strong>Nota:</strong>
                    <label>Le informamos que el token generado sera unicamente válido durante un plazo de 24 horas desde su generación. Después de ese periodo de tiempo, el token ya no será funcional y tendría que generar uno nuevo para poder acceder al servicio correspondiente. </label>
                </div>

                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="nombre_del_responsable" placeholder="Nombre del Responsable" data-te-input-showcounter="true" maxlength="20" />
                    <label for="exampleFormControlInputCounter" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Nombre del Responsable
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 peer-focus:text-primary dark:text-neutral-200 dark:peer-focus:text-primary" data-te-input-helper-ref></div>
                </div>



                <div class="[ w-full flex flex-nowrap justify-center mt-10 ]">
                    <button id="btn_token" onclick="tokens_generar()" type="button" data-te-ripple-init data-te-ripple-color="light" class="[  text-xs ] disabled:opacity-50 flex gap-1 items-center justify-center w-full rounded-r bg-[#e4a11b] px-6 py-2.5 font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-[#e4a11b] hover:shadow-lg focus:bg-[#e4a11b]focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#e4a11b] active:shadow-lg">
                        Generar Token
                    </button>
                </div>
            </div>
        </div>

        <div class=" [  bg-white p-3 rounded-lg shadow-lg overflow-scroll ]  [ md:w-full ] [ lg:w-3/4 ]">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table id="tabla_tokens" class="min-w-full   text-sm font-light">
                        <thead class="bg-neutral-800 text-white   border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Id</th>
                                <th scope="col" class="px-6 py-4">Responsable</th>
                                <th scope="col" class="px-6 py-4">Creacion</th>
                                <th scope="col" class="px-6 py-4">Vencimiento</th>
                                <th scope="col" class="px-6 py-4">Token</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            tabla_tokens = new DataTable('#tabla_tokens', {
                language: {
                    //?dataTable en Español
                    url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json',
                    //? input de buscar tengo un texto
                    searchPlaceholder: "Filtrar"

                },
            });
            //   tabla_ordenes_cosultar();

        });
        tabla_tokens_consultar();

        function tabla_tokens_consultar() {

            $.ajax({
                // la URL para la petición
                url: "../api/token/index.php",

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
                    $('#btn_ingresar').prop('disabled', true);
                    $('#btn_ingresar').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
                },

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function(response) {
                    $('#loaderstatus').html(``);
                    if (response.result) {

                        tabla_tokens = $('#tabla_tokens').DataTable({
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
                                },
                                {
                                    "data": "responsable"
                                }, {
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
                                {
                                    "data": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, value) {

                                        if (data.status == 1) {
                                            return `
                                            <td   class="py-3 px-6 text-center">
                                            <div  onclick='Cancelar_token("${data.token}",this)' class="flex item-center group justify-start">
                                                <div class="w-6 mr-2 transition-all transform hover:text-bold hover:scale-110"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="group-hover:text-red-600 cursor-pointer transition-all w-6 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />  </svg>

                                                </div>
                                              
                                            </div>
                                        </td>  `;
                                        } else {
                                            return ``;
                                        }


                                    }
                                }



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
                    $('#loaderstatus').html(``);
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

        function tokens_generar() {

            let nombre_del_responsable = $('#nombre_del_responsable').val();
            $.ajax({
                // la URL para la petición
                url: "../api/token/index.php",

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    nombre_del_responsable: nombre_del_responsable
                },
                // especifica si será una petición POST o GET
                type: 'POST',

                // el tipo de información que se espera de respuesta
                dataType: 'json',
                beforeSend: () => {
                    $('#btn_token').prop('disabled', true);
                    $('#btn_token').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
                },

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function(response) {
                    $('#btn_token').prop('disabled', false);
                    $('#btn_token').html(`GENERAR TOKEN`);

                    if (response.result) {
                        $('#nombre_del_responsable').val('');
                        tabla_tokens_consultar();
                        navigator.clipboard.writeText(response.data)
                            .then(() => {
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
                                    icon: 'success',
                                    title: 'Token Copiado!'
                                });
                            })
                            .catch((err) => {
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
                                    title: 'Error Al Copiar'
                                });
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
                    $('#btn_token').prop('disabled', false);
                    $('#btn_token').html(`GENERAR TOKEN`);
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

        function Cancelar_token(token, btn_html) {

            let html_original = btn_html.innerHTML;
            $.ajax({
                // la URL para la petición
                url: "../api/token/index.php",

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                // especifica si será una petición POST o GET
                type: 'POST',
                data: {
                    _method: "PUT",
                    token
                },
                // el tipo de información que se espera de respuesta
                dataType: 'json',
                beforeSend: () => {
                    btn_html.innerHTML = `<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"><span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`;
                    //  button.removeAttribute('onclick');
                },

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function(response) {


                    if (response.result) {
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
                            icon: 'success',
                            title: response.mensaje
                        });

                        tabla_tokens_consultar();
                    } else {
                        btn_html.innerHTML = html_original;
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

                    btn_html.innerHTML = html_original;
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
</div>