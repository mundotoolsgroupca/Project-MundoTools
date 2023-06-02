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
            <p class="[ text-lg font-bold ]">Modificar Stock | Precio</p>
            <span id="StockLoader"></span>
        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table id="StockPoductosTabla" class="min-w-full text-left text-sm font-light">
                            <thead class="bg-neutral-800 text-white border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th data-name="name" class="name" data-type="text" scope="col" class="px-6 py-4">Id</th>
                                    <th scope="col" class="px-6 py-4">Producto</th>
                                    <th scope="col" class="px-6 py-4">stock</th>
                                    <th scope="col" class="px-6 py-4">Categoria</th>
                                    <th scope="col" class="px-6 py-4">precio</th>
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
    <script>
        Producto_consulta();



        async function Producto_consulta() {


            ProductosData = await $.ajax({
                url: "./api-v1/stock_y_precio/index.php",
                type: 'GET',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: () => {
                    $('#StockLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                        <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                        </div>`);

                },
                success: (response) => {
                    if (response.result == true) {
                        $('#StockLoader').html(``);
                        tabla_productos =
                            $('#StockPoductosTabla').DataTable({
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
                                        "data": "nombre"
                                    },
                                    {
                                        "data": "stock",
                                        "className": "editable"
                                    },
                                    {
                                        "data": "categoria"
                                    },

                                    {
                                        "data": "precio",
                                        "className": "editable"
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
                error: function(xhr, status) {
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
                        title: 'Error al Consultar'
                    });
                },
            });




        }

        $('#StockPoductosTabla tbody').on('click', 'td', async function() { // al hacer click en la tabla
            // var miTabla = $('#StockPoductosTabla').DataTable();
            if ($(this).hasClass('editable')) { // se valida si la columna se puede editar

                let position = $(this).index(); //se obtiene la posicion donde se cliqueo
                let title_columna = $('#StockPoductosTabla tr:first-child th').eq(position).text(); //obtenemos el titulo de la columna
                title_columna = title_columna.toLocaleLowerCase(); //minusculas 
                let currentCell = $(this);
                let data = tabla_productos.row(this).data(); //obtenenmos la data completo del row donde se cliqueo 
                let currentCellValue = tabla_productos.cell(this).data(); //obtenemos el valor en concreto donde se cliqueo

                let input = $(`<input class="p-2 border-1 border-gray-300" type="text" value="${currentCellValue}">`); //generamos un input nuevo, colocandole como valor ,lo que obtuvimos  al hacer click
                currentCell.html(input); //colocamos el input con el valor nuevo en la posicion donde se cliqueo
                input.focus(); // se hace focus en el nuevo input 
                input.on('blur', async function() { //funcion que se ejecuta cuando se deja de hacer focus en el nuevo input 

                    var newdata = {}; //array que tendra el id y el valor a editar 
                    newdata[title_columna] = input.val();
                    newdata["id"] = data.id;
                    $.ajax({ //se manda los valores obtenido a php
                        url: "./api-v1/productos/index.php",
                        type: 'POST',
                        headers: {
                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: "PUT",
                            newdata,
                            olddata: data,
                            validar: 1
                        },
                        beforeSend: () => {

                            $('#StockLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                             </div>`);

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
                                    title: response.data.msg
                                })
                            }

                        },
                        error: function(xhr, status) {

                            $('#StockLoader').html(` `);
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

                            try {
                                Toast.fire({
                                    icon: 'error',
                                    title: xhr.responseJSON.mensaje
                                });
                            } catch (error) {
                                Toast.fire({
                                    icon: 'error',
                                    title: "Error"
                                })
                            }

                            if (typeof newdata.stock !== 'undefined') {
                                currentCell.html(data.stock);
                                data.stock = newdata.stock;
                            } else if (typeof newdata.precio !== 'undefined') {
                                currentCell.html(data.precio);
                                data.precio = newdata.precio;
                            }


                        },
                    });



                })
            }
        });
    </script>
</div>



</html>