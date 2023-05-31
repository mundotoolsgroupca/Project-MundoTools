<?php

session_name("ecomercer_user_data");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../../../");
}
?>
<h1 class="[ m-0 flex items-center gap-3 [ text-sm ] [ md:text-md ] [ lg:text-lg ]  ]">
    Ordenes
    <span id='loaderstatus' class='my-auto flex justify-center'>

    </span>
</h1>
<div class='[ flex gap-1 flex-col w-full ]'>

    <div class="flex flex-col overflow-x-auto p-3 bg-white rounded-lg  ">
        <div>
            <input id="fechaOrdenes" type="date" value="<?php echo date('Y-m-d') ?>" class="w-full p-2 my-2 text-center border border-gray-300 rounded-md lg:w-auto focus:outline-none focus:ring-2 ring-blue-200">
        </div>
        <div class="sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table id="tabla_ordenes" class="min-w-full   text-sm font-light">
                        <thead class="bg-neutral-800 text-white   border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Id</th>
                                <th scope="col" class="px-6 py-4">Empresa</th>
                                <th scope="col" class="px-6 py-4">Responsable</th>
                                <th scope="col" class="px-6 py-4">Telefono</th>
                                <th scope="col" class="px-6 py-4">Rif</th>
                                <th scope="col" class="px-6 py-4">Direccion</th>
                                <th scope="col" class="px-6 py-4">Fecha</th>
                                <th scope="col" class="px-6 py-4">Moneda</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Accion</th>
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

<div class="flex space-x-2">
    <div>



    </div>
</div>



<!-- Modal -->
<div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="ModalOrdenDetalle" tabindex="-1" aria-labelledby="ModalOrdenDetalleLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative h-[calc(100%-1rem)] w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div class="pointer-events-auto relative flex max-h-[100%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <!--Modal title-->
                <h5 class="text-xl flex gap-1 flex-nowrap font-medium leading-normal text-neutral-800 dark:text-neutral-200" id="ModalOrdenDetalleLabel">
                    Detalle de la Orden
                    <span id="ModalLoaderDetalleOrden"> </span>
                </h5>
                <!--Close button-->
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!--Modal body-->
            <div class="relative overflow-y-auto p-4">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table id="tabla_orden_detalle" class="min-w-full   text-sm font-light">
                                <thead class="bg-neutral-800 text-white   border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Nombre</th>
                                        <th scope="col" class="px-6 py-4">Cantidad</th>
                                        <th scope="col" class="px-6 py-4">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal footer-->
            <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <button type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                    Cerrar
                </button>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

<script>
    $(document).ready(function() {
        table = new DataTable('#tabla_ordenes', {
            language: {
                //?dataTable en Español
                url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json',
                //? input de buscar tengo un texto
                searchPlaceholder: "Filtrar"

            },
        });
        roden_detalle = new DataTable('#tabla_orden_detalle', {
            language: {
                //?dataTable en Español
                url: '//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json',
                //? input de buscar tengo un texto
                searchPlaceholder: "Filtrar"

            },
        });
        tabla_ordenes_cosultar();

    });

    function cancelar_orden(id, button) {

        let html_original = button.innerHTML;
        $.ajax({
            url: "../api/orden/index.php",
            type: 'POST',
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _method: 'PUT',
                id_orden: id
            },
            beforeSend: () => {

                button.innerHTML = `<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"><span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`;
                button.removeAttribute('onclick');
            },
            success: (response) => {

                if (response.result == true) {
                    tabla_ordenes_cosultar();
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
                } else {
                    button.innerHTML = html_original;
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
                        title: response.mensaje
                    });
                }

            },
            error: function(xhr, status) {
                button.innerHTML = html_original;
                // $('#NuevoProductoLoader').html(``);
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
        });

    }



    function tabla_ordenes_cosultar() {

        $.ajax({
            url: "../api/orden/index.php",
            type: 'GET',
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                fecha: $('#fechaOrdenes').val()
            },


            beforeSend: () => {

                $('#loaderstatus').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
            },
            success: (response) => {
                $('#loaderstatus').html(``);
                // $('#NuevoProductoLoader').html(``);
                if (response.result == true) {

                    tabla_ordenes = $('#tabla_ordenes').DataTable({
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
                                "data": null,
                                "bSortable": false,
                                "mRender": function(data, type, value) {

                                    return `<a href="javascript:detalle_orden(${data.id})" class="text-primary hover:underline p-3 flex gap-1 flex-nowrap items-center transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600" >${data.id} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg></a >`;

                                }
                            }, {
                                "data": "nombreempresa"
                            },
                            {
                                "data": "responsable"
                            },
                            {
                                "data": "numerotelefono"
                            },

                            {
                                "data": "rif"
                            },
                            {
                                "data": "direccion"
                            },
                            {
                                "data": "fecha"
                            },
                            {
                                "data": "moneda_simbolo"
                            },
                            {
                                "data": null,
                                "bSortable": false,
                                "mRender": function(data, type, value) {

                                    if (data.status == 0) {
                                        return `<span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-danger-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-sm font-bold leading-none text-danger-700">Cancelado</span>`;
                                    } else {
                                        return `<span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-success-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-sm font-bold leading-none text-success-700">Enviado</span>`;
                                    }

                                }
                            },
                            {
                                "data": null,
                                "bSortable": false,
                                "mRender": function(data, type, value) {

                                    if (data.status == 0) {
                                        return ``;
                                    } else {
                                        return `
                                            
                                        <td   class="py-3 px-6 text-center">
                                            <div onclick='cancelar_orden(${data.id},this)' class="flex item-center group justify-start">
                                                <div class="w-6 mr-2 transition-all transform hover:text-bold hover:scale-110"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="group-hover:text-red-600 cursor-pointer transition-all w-6 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />  </svg>

                                                </div>
                                              
                                            </div>
                                        </td>`;
                                    }





                                }
                            },


                        ],
                        responsive: true,
                    });
                } else {

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
                        title: response.mensaje
                    });
                }

            },
            error: function(xhr, status) {
                $('#loaderstatus').html(``);
                // $('#NuevoProductoLoader').html(``);
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
        });

    }

    $('#fechaOrdenes').change(function() {
        tabla_ordenes_cosultar();
    });

    function detalle_orden(orden_id) {

        $.ajax({
            url: "../api/orden_det/index.php",
            type: 'GET',
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                orden_id: orden_id
            },


            beforeSend: () => {
                
                if (typeof tabla_orden_Detalle != 'undefined') { //la variable debe estar iniciada para poder limpiar la tabla
                    tabla_orden_Detalle.clear().draw();
                }
                const myModal = new te.Modal(document.getElementById("ModalOrdenDetalle"));
                myModal.show();
                $('#ModalLoaderDetalleOrden').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);

            },
            success: (response) => {
                $('#ModalLoaderDetalleOrden').html(``);

                // $('#NuevoProductoLoader').html(``);
                if (response.result == true) {

                    tabla_orden_Detalle = $('#tabla_orden_detalle').DataTable({
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
                                "data": "nombre"
                            },
                            {
                                "data": "cantidad"
                            },
                            {
                                "data": "precio"
                            }


                        ],
                        responsive: true,
                    });
                } else {

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
                        title: response.mensaje
                    });
                }

            },
            error: function(xhr, status) {
                $('#ModalLoaderDetalleOrden').html(``);
                // $('#NuevoProductoLoader').html(``);
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
        });

    }
</script>