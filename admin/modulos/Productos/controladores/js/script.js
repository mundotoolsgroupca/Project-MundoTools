

function toggle(id) {

    $(`#${id}`).slideToggle("slow");


}




function agrupados_view(id) {

    let status_view = $("#tabla_productos_agrupados").attr("view"); //obtenemos la propiedad personalizada para saber si el modulo esta a la vista

    if (status_view == 0) {
        $(`#tabla_productos_agrupados`).slideToggle("slow", () => {
            toggle('producto_modulo');
            toggle('nuevo_producto_modulo');
            window.location.href = '#tabla_productos_agrupados'; //foco en el nuevo modulo
            tabla_productos_agrupados_consultar(id);
        }); // mostramos la caja
        $("#tabla_productos_agrupados").attr("view", '1'); //actualizamos el estado

    }
}

function toggle_agrupados() {
    let status_view = $("#tabla_productos_agrupados").attr("view"); //obtenemos la propiedad personalizada para saber si el modulo esta a la vista
    status_view = status_view == 1 ? 0 : 1
    $("#tabla_productos_agrupados").attr("view", status_view);
    $(`#tabla_productos_agrupados`).slideToggle("slow");
}

async function Producto_consulta() {


    $.ajax({
        url: "./api-v1/productos/index.php",
        type: 'GET',
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
            $('#ProductosLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

        },
        success: (response) => {
            $('#ProductosLoader').html(``);
            if (response.result == true) {

                tabla_producto = $('#tabla_producto').DataTable({
                    "bDestroy": true,
                    order: [
                        [0, 'desc']
                    ],
                    paging: true,
                    select: true,
                    targets: 20,
                    scrollY: '50vh',
                    //scrollY: '50%',
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
                        "mRender": function (data, type, value) {
                            return `<button
                                                onclick='agrupados_view("${data.id_grupo}")'
                                                type="button"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                                class="rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:bg-neutral-100 hover:text-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 dark:hover:bg-neutral-700">
                                                ${data.id_grupo}
                                                </button>`;
                        }
                    }, {
                        "data": "nombre"
                    },
                    {
                        "data": "categoria"
                    },
                    {
                        "data": "descripcion"
                    },

                    {
                        "data": "precio"
                    },
                    {
                        "data": "simbolo"
                    },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function (data, type, value) {
                            return `
                                    <div class="[ flex gap-1 ]">
                                    <button
                                    onclick='modal.show()'
                                    type="button"
                                    data-te-ripple-init
                                    data-te-ripple-color="primary"
                                    class="inline-block rounded bg-blue-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-blue-700 shadow-md transition duration-150 ease-in-out hover:bg-blue-300 hover:shadow-lg focus:bg-blue-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-400 active:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                    </svg>

                                    </svg>
                                    </button> 

                                    <button
                                    onclick='eliminarproducto("${data.id}")'
                                    type="button"
                                    data-te-ripple-init
                                    data-te-ripple-color="red"
                                    class="inline-block rounded bg-red-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-red-700 shadow-md transition duration-150 ease-in-out hover:bg-red-300 hover:shadow-lg focus:bg-red-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-400 active:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                    </svg>
                                    </button> 
                                    </div>
                                    `;
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
        error: function (xhr, status) {
            $('#ProductosLoader').html(``);
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
                title: 'Error al Consultar'
            });
        },
    });




}

function tabla_productos_agrupados_consultar(id) {
    $.ajax({
        url: "./api-v1/productos/agrupados.php",
        type: 'GET',
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id_agrupado: id
        },
        beforeSend: () => {
            $('#titulo_tabla_agrupadosLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

        },
        success: (response) => {
            $('#titulo_tabla_agrupadosLoader').html(``);
            if (response.result == true) {


                tabla_agrupados_data = $('#tabla_agrupados_producto').DataTable({
                    "bDestroy": true,
                    order: [
                        [0, 'desc']
                    ],
                    paging: true,
                    select: true,
                    targets: 20,
                    scrollY: '50vh',
                    //scrollY: '50%',
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
                        "data": 'id'
                    }, {
                        "data": "nombre"
                    },
                    {
                        "data": "categoria"
                    },
                    {
                        "data": "caracteristica"
                    },
                    {
                        "data": "caracteristica2"
                    },
                    {
                        "data": "caracteristica3"
                    },
                    {
                        "data": "caracteristica4"
                    },
                    {
                        "data": "caracteristica5"
                    },
                    {
                        "data": "precio"
                    },
                    {
                        "data": "simbolo"
                    },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function (data, type, value) {
                            return `
                                                        <div class="[ flex gap-1 ]">
                                                        <button
                                                        onclick='modal_editar_agrupados.show()'
                                                        type="button"
                                                        data-te-ripple-init
                                                        data-te-ripple-color="primary"
                                                        class="inline-block rounded bg-blue-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-blue-700 shadow-md transition duration-150 ease-in-out hover:bg-blue-300 hover:shadow-lg focus:bg-blue-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-400 active:shadow-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                        <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                        </svg>

                                                        </svg>
                                                        </button> 

                                                        <button
                                                        onclick='eliminarproducto("${data.id}")'
                                                        type="button"
                                                        data-te-ripple-init
                                                        data-te-ripple-color="red"
                                                        class="inline-block rounded bg-red-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-red-700 shadow-md transition duration-150 ease-in-out hover:bg-red-300 hover:shadow-lg focus:bg-red-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-400 active:shadow-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                        </svg>
                                                        </button> 
                                                        </div>
                                                        `;
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
        error: function (xhr, status) {
            $('#titulo_tabla_agrupadosLoader').html(``);
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


function editar_producto_agrupado() {

    $.ajax({
        url: "./api-v1/productos/agrupados.php",
        type: 'POST',
        data: {
            _method: "PUT",
            data: $("#ModalEditar_agrupados").serialize()
        },
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: () => {
            $('#ModalEditar_agrupadosLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

        },
        success: (response) => {
            $('#ModalEditar_agrupadosLoader').html(``);
            if (response.result == true) {
                let id_grupo_producto = $('#ModalEditar_agrupadosID').val();
                tabla_productos_agrupados_consultar(id_grupo_producto);
                modal_editar_agrupados.hide();
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
        error: function (xhr, status) {
            $('#ModalEditar_agrupadosLoader').html(``);
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

function renderimage(formData) {

    let file = formData.get('imagen');
    let img = URL.createObjectURL(file)
    document.getElementById('imgpreview').setAttribute('src', img);
}

async function eliminarproducto(id = 0) {
    Swal.fire({
        title: 'Estas Seguro de Eliminar?',
        text: "Los Datos Seran Eliminado Permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then(async (result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./api-v1/productos/index.php",
                type: 'GET',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: () => {
                    $('#titulo_tabla_agrupadosLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                },
                data: {
                    _method: "DELETE",
                    id: id
                },
                success: (response) => {

                    $('#titulo_tabla_agrupadosLoader').html(``);

                    if (response.result == true) {
                        id_grupo = $('#ModalEditar_agrupadosID').val();
                        tabla_productos_agrupados_consultar(id_grupo);
                        if (response.data.status == 1) {
                            let Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: response.data.msg
                            })

                            Producto_consulta();

                        }
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
                error: function (xhr, status) {

                    $('#titulo_tabla_agrupadosLoader').html(` `);
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
                    if (typeof xhr.responseJSON.mensaje !== 'undefined') {
                        let Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.mensaje
                        })
                    } else {
                        let Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: "Error"
                        })
                    }
                    Producto_consulta();
                },
            });




        }
    })
}


function validarTamanoImagen(inputFile) {
    var maxTamano = 5242880; // tamaño máximo en bytes (5 MB)
    var archivo = inputFile.files[0];

    if (archivo.size > maxTamano) {
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: "tamaño maximo de la imagen es 5 MB"
        })
        document.getElementById('imgpreview').setAttribute('src', "");
        document.getElementById('formFile').value = "";
        return;
    } else {
        let formData = new FormData(form);
        renderimage(formData);
    }
}
