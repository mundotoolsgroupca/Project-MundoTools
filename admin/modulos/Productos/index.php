<div class="[ flex gap-3 flex-col ] [ lg:flex-row ]">
    <!-- Modulo -->
    <div class="[  rounded-lg bg-white p-6 shadow-lg w-full ] [ lg:w-1/5 ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Nuevo Producto</p>
            <span id="NuevoProductoLoader"></span>
            <span onclick="toggle('nuevo_producto_modulo')" class='[ block ] [ md:hidden ] [ lg:hidden ]'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>

            </span>
        </div>
        <div id="nuevo_producto_modulo">
            <form id="nuevoproductoform">


                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input maxlength="11" data-te-input-showcounter="true" max name="idproducto" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="idproducto" placeholder="id" required />
                    <label for="idproducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Id del Prducto
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                </div>

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input maxlength="11" data-te-input-showcounter="true" max name="id_grupo" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="id_grupo" value="<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                include "../../php/conexion.php";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $consulta = ' SELECT id_grupo FROM productos_agrupados ORDER BY id_grupo DESC LIMIT 1;';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $resultado = mysqli_query($conexion, $consulta);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($resultado) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $data = [];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $row = mysqli_fetch_assoc($resultado);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $row['id_grupo'] + 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "0";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>" placeholder="id" required />
                    <label for="id_grupo" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Id del Prducto
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                </div>

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input maxlength="40" data-te-input-showcounter="true" name="nombreproducto" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleInput7" placeholder="Name" required />
                    <label for="exampleInput7" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Nombre del Producto
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                </div>

                <div class="mb-3 w-full">
                    <div class="relative  flex w-full  items-stretch">
                        <input min="0.00" max="10000.00" step="0.01" name="precio" type="number" class="relative m-0 -mr-px block w-4/5  flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary-600 focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200" placeholder="precio" aria-label="Search" aria-describedby="button-addon3" />
                        <!--Search button-->
                        <select name="moneda" class="w-[1/5]" disabled id="moneda" data-te-select-init required>
                        </select>
                        <label data-te-select-label-ref>Moneda</label>
                    </div>
                </div>



                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" name="stock" type="number" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleInput8" placeholder="Email address" required />
                    <label for="exampleInput8" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Stock
                    </label>
                </div>


                <div class="[ mb-6 w-full ]">
                    <select name="categoria" disabled id="categoria" data-te-select-init required>

                    </select>
                    <label data-te-select-label-ref>Categoria</label>
                </div>
                <div class="[ mb-6 w-full ]">
                    <label for="formFile" class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">Imagen del Producto</label>
                    <input name="imagen" class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100" accept="image/png,image/jpeg,image/webp" onchange="validarTamanoImagen(this)" type="file" id="formFile" required />
                    <div class="[ flex justify-center  ]">
                        <img id="imgpreview" class="[ transition-shadow  hover:shadow-lg hover:shadow-black/30  max-h-32 mt-3 object-cover rounded-lg ]" src="" />
                    </div>

                </div>
                <div class="relative mb-6" data-te-input-wrapper-init>
                    <textarea maxlength="300" data-te-input-showcounter="true" name="descripcion" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleFormControlTextarea13" rows="3" placeholder="Descripcion" required></textarea>
                    <label for="exampleFormControlTextarea13" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Descripcion
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                </div>




                <!--Submit button-->
                <button type="submit" class="inline-block w-full rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]" data-te-ripple-init data-te-ripple-color="light">
                    Guardar
                </button>
            </form>

        </div>

    </div>

    <!-- Modulo -->
    <div class="[ h-auto rounded-lg bg-white p-6 shadow-lg w-full ] [ lg:w-4/5 lg:h-full  ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Productos</p>
            <span id="ProductosLoader"></span>
            <span onclick="toggle('producto_modulo')" class='[ block ] [ md:hidden ] [ lg:hidden ]'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>

            </span>
        </div>
        <div id="producto_modulo">
            <div class="mb-3 w-full">

                <div class="flex flex-col overflow-x-auto">
                    <div class="sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                                <table id="tabla_producto" class="min-w-full text-left text-sm font-light">
                                    <thead class="bg-neutral-800 text-white border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">Id Grupo</th>
                                            <th scope="col" class="px-6 py-4">Producto</th>
                                            <th scope="col" class="px-6 py-4">Categoria</th>
                                            <th scope="col" class="px-6 py-4">Descripcion</th>
                                            <th scope="col" class="px-6 py-4">Precio</th>
                                            <th scope="col" class="px-6 py-4">Moneda</th>
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
            </div>
            <button onclick="Producto_consulta()" type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200">
                Actualizar
            </button>
        </div>



    </div>

    <!-- Modal -->
    <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="staticBackdrop" data-te-backdrop="static" data-te-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
            <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
                        <p class="[ text-lg font-bold ]"> Editar Producto</p>
                        <span id="ModalEditarLoader"></span>
                    </div>

                    <!--Close button-->
                    <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="ModalEditar" method="post">
                    <!-------Modal body-->
                    <div data-te-modal-body-ref class="relative p-4">
                        <div class="[ flex gap-3 flex-col ]">
                            <input class="[ hidden ]" type="text" name="ModalEditarID" id="ModalEditarID" />

                            <div class="[ flex justify-center  ]">
                                <img id="Modalimgpreview" class="[ max-h-32 mt-3 object-cover rounded-lg ]" src="">
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditarNombreProducto" id="ModalEditarNombreProducto" placeholder="Example label" />
                                <label for="ModalEditarNombreProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Nombre del Producto
                                </label>
                            </div>



                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input disabled min="0.00" max="10000.00" step="0.01" disabled type="number" class="bg-neutral-100  peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditarPrecio" id="ModalEditarPrecio" placeholder="Example label" />
                                <label for="ModalEditarPrecio" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Precio
                                </label>
                            </div>









                            <div class="relative flex w-full flex-wrap items-stretch">
                                <label class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" for="ModalEditarMoneda">Moneda</label>
                                <select class="form-select relative m-0 block w-[1px] min-w-0 flex-auto appearance-none rounded-r border border-solid border-neutral-300 bg-white bg-clip-padding bg-no-repeat px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out focus:z-[3] focus:border-primary-600 focus:bg-white focus:text-neutral-700 focus:outline-none dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" name="ModalEditarMoneda" id="ModalEditarMoneda">

                                </select>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="11" disabled type="text" class="bg-neutral-100  peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditarStock" id="ModalEditarStock" placeholder="Example label" />
                                <label for="ModalEditarStock" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Stock
                                </label>
                            </div>

                            <div class="relative flex w-full flex-wrap items-stretch">
                                <label class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" for="ModalEditarCategoria">Categoria</label>
                                <select class="form-select relative m-0 block w-[1px] min-w-0 flex-auto appearance-none rounded-r border border-solid border-neutral-300 bg-white bg-clip-padding bg-no-repeat px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out focus:z-[3] focus:border-primary-600 focus:bg-white focus:text-neutral-700 focus:outline-none dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" name="ModalEditarCategoria" id="ModalEditarCategoria">

                                </select>
                            </div>
                            <div class="relative mb-3 w-full" data-te-input-wrapper-init>
                                <textarea maxlength="300" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditarDescripcion" id="ModalEditarDescripcion" rows="4" placeholder="Descripcion"></textarea>
                                <label for="ModalEditarDescripcion" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Descripcion
                                </label>
                            </div>


                        </div>
                    </div>

                    <!--Modal footer-->
                    <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <button type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                            Cancelar
                        </button>
                        <button type="submit" class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]" data-te-ripple-init data-te-ripple-color="light">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="modal_editar_agrupados" data-te-backdrop="static" data-te-keyboard="false" tabindex="-1" aria-labelledby="modal_editar_agrupadosLabel" aria-hidden="true">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
            <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
                        <p class="[ text-lg font-bold ]"> Editar Producto Agrupado</p>
                        <span id="ModalEditar_agrupadosLoader"></span>
                    </div>

                    <!--Close button-->
                    <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="ModalEditar_agrupados" method="post">
                    <!-------Modal body-->
                    <div data-te-modal-body-ref class="relative p-4">
                        <figure>
                            <blockquote>
                                <p class="text-xl" id="ModalEditar_agrupadosTitulo">

                                </p>
                            </blockquote>
                        </figure>
                        <div class="[ flex gap-3 flex-col mt-3 ]">
                            <input class="[ hidden ]" type="text" name="ModalEditar_agrupadosID" id="ModalEditar_agrupadosID" />
                            <input class="[ hidden ]" type="text" name="ModalEditar_id_producto" id="ModalEditar_id_producto" />

                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto" id="ModalEditar_agrupadoscaracteristicaProducto" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto2" id="ModalEditar_agrupadoscaracteristicaProducto2" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica2
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto3" id="ModalEditar_agrupadoscaracteristicaProducto3" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica3
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto4" id="ModalEditar_agrupadoscaracteristicaProducto4" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica4
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto5" id="ModalEditar_agrupadoscaracteristicaProducto5" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica5
                                </label>
                            </div>


                            <div class="relative flex w-full flex-wrap items-stretch">
                                <label class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" for="ModalEditar_agrupadosMoneda">Moneda</label>
                                <select class="form-select relative m-0 block w-[1px] min-w-0 flex-auto appearance-none rounded-r border border-solid border-neutral-300 bg-white bg-clip-padding bg-no-repeat px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition ease-in-out focus:z-[3] focus:border-primary-600 focus:bg-white focus:text-neutral-700 focus:outline-none dark:border-neutral-600 dark:bg-zinc-800 dark:text-neutral-200 dark:placeholder:text-neutral-200" name="ModalEditar_agrupadosMoneda" id="ModalEditar_agrupadosMoneda">

                                </select>
                            </div>


                        </div>
                    </div>

                    <!--Modal footer-->
                    <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <button type="button" class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                            Cancelar
                        </button>
                        <button type="submit" class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]" data-te-ripple-init data-te-ripple-color="light">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>





</div>

<div id='tabla_productos_agrupados' view='0' class="[ flex gap-3 flex-col mt-3 hidden ] [ lg:flex-row ]">
    <!-- Modulo -->
    <div class="[ h-auto rounded-lg bg-white p-6 shadow-lg w-full ] [   lg:h-full  ]">

        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <span class="cursor-pointer text-[#FBAA35]" onclick="toggle_agrupados(),toggle('producto_modulo'),toggle('nuevo_producto_modulo')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                </svg>
            </span>
            <p id="titulo_tabla_agrupados" class="[ text-lg font-bold ]">Agrupados</p>
            <span id="titulo_tabla_agrupadosLoader"></span>

        </div>

        <div>
            <div class="flex flex-col overflow-x-auto">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table id="tabla_agrupados_producto" class="min-w-full text-left text-sm font-light">
                                <thead class="bg-neutral-800 text-white border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">ID</th>
                                        <th scope="col" class="px-6 py-4">Nombre</th>
                                        <th scope="col" class="px-6 py-4">Categoria</th>
                                        <th scope="col" class="px-6 py-4">Descripcion1</th>
                                        <th scope="col" class="px-6 py-4">Descripcion2</th>
                                        <th scope="col" class="px-6 py-4">Descripcion3</th>
                                        <th scope="col" class="px-6 py-4">Descripcion4</th>
                                        <th scope="col" class="px-6 py-4">Descripcion5</th>
                                        <th scope="col" class="px-6 py-4">Precio</th>
                                        <th scope="col" class="px-6 py-4">Moneda</th>
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

        </div>
    </div>
</div>
<script id="tailwindelements_script" src="./assets/js/tw-elements.umd.min.js"></script>
<script>
    let tabla_producto = new DataTable('#tabla_producto');
    let tabla_agrupados_data = new DataTable('#tabla_agrupados_producto');
    Producto_consulta();

    function toggle(id) {

        $(`#${id}`).slideToggle("slow");


    }


    $('#tabla_agrupados_producto tbody').on('click', 'tr', function() {


        data = tabla_agrupados_data.row(this).data();
        $('#ModalEditar_agrupadosID').val(data.id_grupo);
        $('#ModalEditar_id_producto').val(data.id);
        $('#ModalEditar_agrupadosTitulo').html(data.nombre);
        $('#ModalEditar_agrupadoscaracteristicaProducto').val(data.caracteristica);
        $('#ModalEditar_agrupadoscaracteristicaProducto2').val(data.caracteristica2);
        $('#ModalEditar_agrupadoscaracteristicaProducto3').val(data.caracteristica3);
        $('#ModalEditar_agrupadoscaracteristicaProducto4').val(data.caracteristica4);
        $('#ModalEditar_agrupadoscaracteristicaProducto5').val(data.caracteristica5);
        document.getElementById("ModalEditar_agrupadosMoneda").value = data.moneda;

    });


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




    $.ajax({
        url: "./api-v1/categorias/index.php",
        type: 'GET',
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: () => {
            $('#NuevoProductoLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

        },
        success: (response) => {
            $('#NuevoProductoLoader').html(``);
            if (response.result == true) {

                response.data.map((item) => {
                    $('#categoria').append(`<option value="${item.id}">${item.nombre}</option>`);
                    $('#ModalEditarCategoria').append(`<option value="${item.id}">${item.nombre}</option>`);
                })
                document.getElementById("categoria").disabled = false;
                document.getElementById("ModalEditarCategoria").disabled = false;
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
            $('#NuevoProductoLoader').html(``);
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




    $.ajax({
        url: "./api-v1/monedas/index.php",
        type: 'GET',
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: () => {
            $('#NuevoProductoLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

        },
        success: (response) => {
            $('#NuevoProductoLoader').html(``);
            if (response.result == true) {

                response.data.map((item) => {
                    $('#moneda').append(`<option value="${item.cod_moneda}">${item.simbolo}</option>`);
                    $('#ModalEditarMoneda').append(`<option value="${item.cod_moneda}">${item.simbolo}</option>`);
                    $('#ModalEditar_agrupadosMoneda').append(`<option value="${item.cod_moneda}">${item.simbolo}</option>`);
                })
                document.getElementById("moneda").disabled = false;
                document.getElementById("ModalEditarMoneda").disabled = false;

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
            $('#NuevoProductoLoader').html(``);
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
                                "mRender": function(data, type, value) {
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
            error: function(xhr, status) {
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
                                "mRender": function(data, type, value) {
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
            error: function(xhr, status) {
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
            error: function(xhr, status) {
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

    $('#tabla_producto tbody').on('click', 'tr', function() {

        let data = tabla_producto.row(this).data();
        $('#ModalEditarID').val(data.id);
        $('#ModalEditarNombreProducto').val(data.nombre);
        document.getElementById("ModalEditarMoneda").value = data.cod_moneda;
        $('#ModalEditarPrecio').val(data.precio);
        $('#ModalEditarStock').val(data.stock);
        $('#ModalEditarCategoria').val(data.categoria_id);
        $('#ModalEditarDescripcion').val(data.descripcion);
        $('#Modalimgpreview').attr("src", "../../../" + data.imagen);
        $('#Modalimgpreview').attr("title", data.nombre);
        $('#titulo_tabla_agrupados').html(`${data.nombre}`);
    });

    myModalEl = document.getElementById("staticBackdrop");
    modal = new te.Modal(myModalEl);

    modal_editar_agrupados = document.getElementById("modal_editar_agrupados");
    modal_editar_agrupados = new te.Modal(modal_editar_agrupados);

    form = document.getElementById('nuevoproductoform');

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
                        $('#ProductosLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

                    },
                    data: {
                        _method: "DELETE",
                        id: id
                    },
                    success: (response) => {

                        $('#ProductosLoader').html(``);

                        if (response.result == true) {
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
                    error: function(xhr, status) {
                        $('#StockLoader').html(` `);
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
    $("#ModalEditar_agrupados").on("submit", async function(event) {
        event.preventDefault();
        editar_producto_agrupado();

    });
    $("#nuevoproductoform").on("submit", async function(event) {
        event.preventDefault();
        let formdata = new FormData(event.currentTarget);
        let result

        result = await $.ajax({
            url: "./api-v1/productos/index.php",
            type: 'POST',
            data: new FormData(this),
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: () => {
                $('#NuevoProductoLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

            },
            success: (response) => {
                $('#NuevoProductoLoader').html(``);
                if (response.result == true) {
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
                        form.reset(); //si se realizo se limpia el form
                        document.getElementById('imgpreview').src = "";
                        document.getElementById('formFile').value = ""; // se limpia la preview de la imagen
                    } else if (response.data.status == 0) {
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
                            title: response.data.msg
                        })
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
            error: function(xhr, status) {
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
            contentType: false,
            cache: false,
            processData: false,
        });



    });
    $("#ModalEditar").on("submit", async function(event) {

        event.preventDefault();
        ModalEditarID = $("#ModalEditarID").val();
        ModalEditarNombreProducto = $("#ModalEditarNombreProducto").val();
        ModalEditarMoneda = $("#ModalEditarMoneda").val();
        ModalEditarStock = $("#ModalEditarStock").val();
        ModalEditarCategoria = $("#ModalEditarCategoria").val();
        ModalEditarDescripcion = $("#ModalEditarDescripcion").val();
        let result = [];

        result = await $.ajax({
            url: "./api-v1/productos/index.php",
            type: 'POST',
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                ModalEditarID: ModalEditarID,
                ModalEditarNombreProducto: ModalEditarNombreProducto,
                ModalEditarMoneda: ModalEditarMoneda,
                ModalEditarStock: ModalEditarStock,
                ModalEditarCategoria: ModalEditarCategoria,
                ModalEditarDescripcion: ModalEditarDescripcion,
                _method: "PUT"
            },

            beforeSend: () => {

                $('#ModalEditarLoader').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                                    <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>`);

            },
            success: (response) => {
                if (response.result == true) {
                    $('#ModalEditarLoader').html(``);
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
                        modal.hide();
                        Producto_consulta();
                    } else if (response.data.status == 0) {
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
            error: (error) => {
                $('#ModalEditarLoader').html(``);
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
                    title: error.responseJSON.mensaje
                })
                Producto_consulta();
            },
            dataType: 'json'
        });


    });

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
</script>