
<script>
    $('#principal').off();
</script>
<div>
    <div class="[  rounded-lg bg-white p-6 shadow-lg   ]   [ lg:w-1/4 ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Categorias</p>
            <span id="CategoriaLoader"></span>
        </div>
        <form id="categoriaformulario">
            <div class="relative mb-3 w-full " data-te-input-wrapper-init>
                <input type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="nuevacategoria" id="nuevacategoria" placeholder="Example label" />
                <label for="nuevacategoria" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Nueva Categoria
                </label>

            </div>
            <div>
                <button type="submit" data-te-ripple-init data-te-ripple-color="light" type="button" class="inline-block w-full mb-3 rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                    Agregar
                </button>
            </div>
        </form>
        <div>
            <table id="tabla_categorias" class="w-full  text-left text-sm font-light">
                <thead class="bg-neutral-800 text-white border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class="px-6 py-4 ">Id</th>
                        <th scope="col" class="px-6 py-4 ">Nombre</th>
                        <th scope="col" class="px-6 py-4 ">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script>
        tabla_categorias = new DataTable('#tabla_categorias')
        CategoriasConsulta();
        $('#tabla_categorias tbody').on('click', 'td', async function() { // al hacer click en la tabla

            // var miTabla = $('#tabla_categorias').DataTable();
            if ($(this).hasClass('editable')) { // se valida si la columna se puede editar
                let position = $(this).index(); //se obtiene la posicion donde se cliqueo
                let title_columna = $('#tabla_categorias tr:first-child th').eq(position).text(); //obtenemos el titulo de la columna
                title_columna = title_columna.toLocaleLowerCase(); //minusculas 
                let currentCell = $(this);
                let data = tabla_categorias.row(this).data(); //obtenenmos la data completo del row donde se cliqueo 
                let currentCellValue = tabla_categorias.cell(this).data(); //obtenemos el valor en concreto donde se cliqueo

                let input = $(`<input class="p-2 border-1 border-gray-300" type="text" value="${currentCellValue}">`); //generamos un input nuevo, colocandole como valor ,lo que obtuvimos  al hacer click
                currentCell.html(input); //colocamos el input con el valor nuevo en la posicion donde se cliqueo
                input.focus(); // se hace focus en el nuevo input 
                input.on('blur', async function() { //funcion que se ejecuta cuando se deja de hacer focus en el nuevo input 
                    var newdata = {}; //array que tendra el id y el valor a editar 
                    newdata[title_columna] = input.val();
                    newdata["id"] = data.id;


                    const result = await $.ajax({ //se manda los valores obtenido a php
                        url: "./api-v1/categorias/index.php",
                        type: 'POST',
                        headers: {
                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: "PUT",
                            newdata,
                            olddata: data
                        },
                        beforeSend: () => {

                            $('#StockLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);

                        },
                        success: (response) => {
                            $('#StockLoader').html(` `);
                            if (response.result == true) {
                                currentCell.html(input.val()); //si se realizo los cambios,se queda el nuevo valor en la tabla del front
                                $('#StockLoader').html(``); //laoder se quita

                                const Toast = Swal.mixin({
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
                                    icon: "success",
                                    title: response.mensaje
                                })



                                currentCell.html(data.stock);
                                data.stock = newdata.stock;

                                currentCell.html(data.precio);
                                data.precio = newdata.precio;


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
                        error: function(xhr, status) {
                            $('#CategoriaLoader').html(``);
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
                    });

                })
            }
        });



        async function CategoriasConsulta() {


            CategoriaData = await $.ajax({
                url: "./api-v1/categorias/index.php",
                type: 'GET',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: () => {
                    $('#CategoriaLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                },
                success: (response) => {
                    $('#CategoriaLoader').html(``);
                    if (response.result == true) {
                        tabla_categorias = $('#tabla_categorias').DataTable({
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
                                "data": "nombre",
                                "className": "editable"
                            }, {
                                "data": null,
                                "bSortable": false,
                                "mRender": function(data, type, value) {
                                    return `<button  onclick="eliminarproducto(${data.id})"  type="button" data-te-ripple-init="" data-te-ripple-color="red" class="inline-block rounded bg-red-200 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-red-700 shadow-md transition duration-150 ease-in-out hover:bg-red-300 hover:shadow-lg focus:bg-red-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-400 active:shadow-lg" style="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd"></path>
                                    </svg>
                                    </button>`;
                                }
                            }, ],
                            responsive: true,
                        });
                    } else {
                        $('#CategoriaLoader').html(``);
                        const Toast = Swal.mixin({
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
                            title: response.mensaje
                        })
                    }

                },
                error: function(xhr, status) {
                    $('#CategoriaLoader').html(``);
                    const Toast = Swal.mixin({
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

                },
            });





        }

        $("#categoriaformulario").on("submit", async function(event) {
            event.preventDefault();
            const formdata = new FormData(event.currentTarget);
            let result

            result = await $.ajax({
                url: "./api-v1/categorias/index.php",
                type: 'POST',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                data: new FormData(this),
                beforeSend: () => {
                    $('#CategoriaLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                },
                success: (response) => {
                    $('#nuevacategoria').val('');
                    if (response.result == true) {
                        CategoriasConsulta();

                        const Toast = Swal.mixin({
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
                            title: response.mensaje
                        })
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
                error: function(xhr, status) {
                    $('#CategoriaLoader').html(``);
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
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
            });



        });

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


                    const DeleteData = await $.ajax({
                        url: "./api-v1/categorias/index.php",
                        type: 'GET',
                        headers: {
                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },

                        beforeSend: () => {
                            $('#CategoriaLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                        },
                        data: {
                            _method: "DELETE",
                            id: id
                        },
                        success: (response) => {
                            $('#CategoriaLoader').html(``);
                            if (response.result == true) {
                                CategoriasConsulta();
                                const Toast = Swal.mixin({
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
                                    title: response.mensaje
                                })

                            } else {
                                $('#CategoriaLoader').html(``);
                                CategoriasConsulta();
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
                        error: function(xhr, status) {
                            $('#CategoriaLoader').html(``);
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
                    });
                }
            })
        }
    </script>
</div>