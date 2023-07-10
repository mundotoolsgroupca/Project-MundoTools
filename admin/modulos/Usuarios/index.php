<script>
    $('#principal').off();
</script>
<div>
    <div class="[  rounded-lg bg-white p-6 shadow-lg   ]   [ lg:w-1/4 ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Nuevo Usuario</p>
            <span id="crear_usuarioLoader"></span>
        </div>

        <form id='form_crear_usuario'>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group" data-te-input-wrapper-init>
                    <input maxlength="30" data-te-input-showcounter="true" name="Nombre" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="Nombre" placeholder="Name" required />
                    <label for="Nombre" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Nombre
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>

                </div>
                <div class="relative z-0 w-full mb-6 group" data-te-input-wrapper-init>
                    <input maxlength="30" data-te-input-showcounter="true" name="apellido" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="apellido" placeholder="Name" required />
                    <label for="apellido" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Apellido
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>

                </div>
            </div>
            <div class="relative z-0 w-full mb-6 group" data-te-input-wrapper-init>
                <input maxlength="30" data-te-input-showcounter="true" name="nombre_usuario" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="nombre_usuario" placeholder="Name" required />
                <label for="nombre_usuario" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Nombre Usuario
                </label>
                <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
            </div>
            <div class="relative z-0 w-full mb-6 group" data-te-input-wrapper-init>
                <input maxlength="30" data-te-input-showcounter="true" name="clave" type="password" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="clave" placeholder="Name" required />
                <label for="clave" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Clave
                </label>
                <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
            </div>



            <button type="submit" class="inline-block w-full rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]" data-te-ripple-init data-te-ripple-color="light">
                Crear Usuario
            </button>
        </form>

        <div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table id="user_datatable" class="min-w-full text-center text-sm font-light">
                                <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                    <tr>
                                        <th scope="col" class=" px-6 py-4">Nombre de Usuario</th>
                                        <th scope="col" class=" px-6 py-4">status</th>
                                        <th scope="col" class=" px-6 py-4">Acciones</th>
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


    <!--Verically centered modal-->
    <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="modal_editar_usuario" tabindex="-1" aria-labelledby="modal_editar_usuarioTitle" aria-modal="true" role="dialog">
        <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200" id="exampleModalScrollableLabel">
                        Editar Usuario
                    </h5>
                    <!--Close button-->
                    <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!--Modal body-->

                <div class="[ flex items-center gap-1 flex-nowrap mb-3 pl-4 ]">
                    <p id="modal_editar_titulo" class="[ text-lg font-bold ]"></p>
                    <span id="modal_editarLoader"></span>
                </div>
               
                <form id="modal_editar_formulario" method="post">


                    <input modal_editar="input" type="text" class="hidden" name="modal_editar_id_usuario" id="modal_editar_id_usuario" />
                    <input modal_editar="input" type="text" class="hidden" name="modal_editar_activo" id="modal_editar_activo" />
                    <div class="relative p-4 flex flex-col gap-3">
                        <div class="relative w-full " data-te-input-wrapper-init>
                            <input modal_editar="input" maxlength="30" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="modal_editar_usuario_nombre" id="modal_editar_usuario_nombre" placeholder="Example label" />
                            <label for="modal_editar_usuario_nombre" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Nombre
                            </label>
                        </div>
                        <div class="relative w-full" data-te-input-wrapper-init>
                            <input modal_editar="input" maxlength="30" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="modal_editar_usuario_apellido" id="modal_editar_usuario_apellido" placeholder="Example label" />
                            <label for="modal_editar_usuario_apellido" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Apellido
                            </label>
                        </div>
                        <div class="relative w-full" data-te-input-wrapper-init>
                            <input modal_editar="input" maxlength="20" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="modal_editar_usuario_nombre_de_usuario" id="modal_editar_usuario_nombre_de_usuario" placeholder="Example label" />
                            <label for="modal_editar_usuario_nombre_de_usuario" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Nombre de Usuario
                            </label>
                        </div>
                        <div class="relative w-full" data-te-input-wrapper-init>
                        </div>

                        <!--Modal footer-->
                        <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                            <button type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                                Salir
                            </button>
                            <button type="submit" class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]" data-te-ripple-init data-te-ripple-color="light">
                                Guardar Cambios
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    <script>
        // A $( document ).ready() block.
        $(document).ready(function() {
            let user_datatable = new DataTable('#user_datatable');
            mostrar_datos_tabla();
            let modal_editar_usuario_box = document.getElementById("modal_editar_usuario");
            modal_editar_usuario = new te.Modal(modal_editar_usuario_box);
        });

        $("#modal_editar_formulario").on("submit", async function(event) {
            event.preventDefault();

            result = await $.ajax({
                url: "./api-v1/usuarios/index.php",
                type: 'POST',
                data: {
                    data: $('#modal_editar_formulario').serialize(),
                    _method: "PUT"
                },
                dataType: "json",
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: () => {
                    $('#modal_editarLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                },
                success: (response) => {
                    mostrar_datos_tabla();
                    modal_editar_usuario.hide();
                    $('#modal_editarLoader').html(``);
                    let Toast = Swal.mixin({
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
                },
                error: function(xhr, status) {
                    $('#modal_editarLoader').html(``);
                    let Toast = Swal.mixin({
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
                dataType: 'json',
                cache: false,
            });


        });

        async function Consultar_usuarios() {
            try {
                let data_usuarios = await $.ajax({
                    url: "./api-v1/usuarios/index.php",
                    type: 'GET',
                    headers: {
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                return data_usuarios
            } catch (error) {
                let Toast = Swal.mixin({
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
                    title: error.responseJSON.mensaje
                });

            }

        }

        $('#user_datatable tbody').on('click', 'tr', function() {

            let data = user_datatable.row(this).data();
            $('#modal_editar_titulo').html(data.nombre_usuario);
            $('#modal_editar_id_usuario').val(data.id);
            $('#modal_editar_activo').val(data.activo);

            $('#modal_editar_usuario_nombre').val(data.nombre);
            $("#modal_editar_usuario_apellido").val(data.apellido);
            $("#modal_editar_usuario_nombre_de_usuario").val(data.nombre_usuario);


        });

        async function mostrar_datos_tabla() {

            let data_usuarios = await Consultar_usuarios();
            user_datatable = $('#user_datatable').DataTable({
                "bDestroy": true,
                order: [
                    [0, 'desc']
                ],
                paging: true,
                targets: 20,
                "pageLength": 1000,
                scrollY: '40vh',
                "processing": true,
                "autoWidth": false,
                language: {
                    //?dataTable en Español
                    url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json',
                    //? input de buscar tengo un texto
                    searchPlaceholder: "Filtrar"

                },
                "data": data_usuarios.data,
                "columns": [{
                        "data": "nombre_usuario"
                    },

                    {
                        "data": "nombre"
                    },

                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, value) {

                            if (data.activo == 1) {
                                return `<span
                                class="inline-block whitespace-nowrap rounded-full bg-success-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-success-700">
                                Activo
                                </span>`;
                            } else {
                                return `<span
                                class="inline-block whitespace-nowrap rounded-full bg-secondary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-secondary-800">
                                Suspendido
                                </span>`;
                            }

                        }
                    },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, value) {
                            return `<button
                                    onclick='modal_editar_usuario.show();'
                                    type="button"
                                    data-te-ripple-init
                                    data-te-ripple-color="primary"
                                    class="inline-block rounded bg-blue-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-blue-700 shadow-md transition duration-150 ease-in-out hover:bg-blue-300 hover:shadow-lg focus:bg-blue-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-400 active:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                    </svg> 
                                    </button>`;
                        }
                    }

                ],
                responsive: true,
            });


        }

        $("#form_crear_usuario").on("submit", async function(event) {

            event.preventDefault();




            result = await $.ajax({
                url: "./api-v1/usuarios/index.php",
                type: 'POST',
                data: {
                    data: $('#form_crear_usuario').serialize()
                },
                dataType: "json",
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: () => {
                    $('#crear_usuarioLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                },
                success: (response) => {
                    mostrar_datos_tabla();
                    $('#crear_usuarioLoader').html(``);
                    $("#form_crear_usuario")[0].reset();
                    let Toast = Swal.mixin({
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
                },
                error: function(xhr, status) {
                    $('#crear_usuarioLoader').html(``);
                    let Toast = Swal.mixin({
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
                dataType: 'json',
                cache: false,
            });


        });
    </script>
</div>