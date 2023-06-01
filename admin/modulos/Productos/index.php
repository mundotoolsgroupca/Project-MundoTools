<script src="./controladores/js/script.js?v=<?php echo rand() ?>"></script>
<div class="[ h-full flex gap-3 flex-col ] [ lg:flex-row ]">
    <!-- Modulo -->
    <div class="[ h-auto  rounded-lg  bg-white p-6 shadow-lg w-full ] [   md:overflow-y-auto ] [ lg:w-1/5   lg:overflow-y-auto ]">
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
                    <label for="idproducto" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Id Producto
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                </div>

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <input maxlength="11" data-te-input-showcounter="true" max name="id_grupo" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="id_grupo" value="<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //Puede usar la MAX()función de MySQL para obtener el valor máximo de la id_grupocolumna. Sin embargo, dado que id_grupopuede contener caracteres alfanuméricos, debe usar las funciones SUBSTRING()y CAST()para extraer solo la parte numérica de la columna y convertirla en un número entero antes de llamar a MAX(). Aquí hay una consulta de ejemplo que debería hacer lo que usted quiere Esta consulta extrae la parte numérica de la id_grupocolumna usando SUBSTRING()y la convierte en un entero sin signo usando CAST(). Luego calcula el máximo de esta columna usando MAX(), lo que le da el último id_grupo.Tenga en cuenta que debe reemplazar tu_tablacon el nombre real de su tabla en la consulta.

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                include "../../php/conexion.php";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $consulta = 'SELECT MAX(CAST(SUBSTRING(id_grupo, 1) + 1 AS UNSIGNED)) AS id_grupo FROM productos_agrupados;';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $resultado = mysqli_query($conexion, $consulta);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($resultado) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $data = [];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $row = mysqli_fetch_assoc($resultado);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $row['id_grupo'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "0";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>" placeholder="id" required />
                    <label for="id_grupo" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">ID Del Grupo
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

                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                    <input class="peer/caracteristica1 checked:border-primary checked:bg-primary dark:checked:border-primary dark:checked:bg-primary relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" id="caracteristica1" name="caracteristica1" />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="caracteristica1"> Caracteristica1 </label>

                    <div class="relative mb-6 hidden peer-checked/caracteristica1:block" data-te-input-wrapper-init>
                        <textarea maxlength="40" data-te-input-showcounter="true" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="caracteristica1" name='caracteristica1' rows="3" placeholder="Descripcion" required>...</textarea>
                        <label for="caracteristica1" class="peer-focus:text-primary pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Caracteristica1 </label>
                        <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                    </div>
                </div>
                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                    <input class="peer/caracteristica2 checked:border-primary checked:bg-primary dark:checked:border-primary dark:checked:bg-primary relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" id="caracteristica2" name="caracteristica2" />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="caracteristica2"> Caracteristica2 </label>

                    <div class="relative mb-6 hidden peer-checked/caracteristica2:block" data-te-input-wrapper-init>
                        <textarea maxlength="40" data-te-input-showcounter="true" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name='caracteristica2' id="caracteristica2" rows="3" placeholder="Descripcion" required>...</textarea>
                        <label for="caracteristica2" class="peer-focus:text-primary pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Caracteristica2 </label>
                        <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                    </div>
                </div>
                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                    <input class="peer/caracteristica3 checked:border-primary checked:bg-primary dark:checked:border-primary dark:checked:bg-primary relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" id="caracteristica3" name="caracteristica3" />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="caracteristica3"> Caracteristica3 </label>

                    <div class="relative mb-6 hidden peer-checked/caracteristica3:block" data-te-input-wrapper-init>
                        <textarea maxlength="40" data-te-input-showcounter="true" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="caracteristica3" rows="3" name="caracteristica3" placeholder="Descripcion" required>...</textarea>
                        <label for="caracteristica3" class="peer-focus:text-primary pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Caracteristica3 </label>
                        <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                    </div>
                </div>
                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                    <input class="peer/caracteristica4 checked:border-primary checked:bg-primary dark:checked:border-primary dark:checked:bg-primary relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" id="caracteristica4" name="caracteristica4" />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="caracteristica4"> Caracteristica4 </label>

                    <div class="relative mb-6 hidden peer-checked/caracteristica4:block" data-te-input-wrapper-init>
                        <textarea maxlength="40" data-te-input-showcounter="true" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="caracteristica4" name='caracteristica4' rows="3" placeholder="Descripcion" required>...</textarea>
                        <label for="caracteristica4" class="peer-focus:text-primary pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Caracteristica4 </label>
                        <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                    </div>
                </div>
                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                    <input class="peer/caracteristica5 checked:border-primary checked:bg-primary dark:checked:border-primary dark:checked:bg-primary relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" type="checkbox" id="caracteristica5" name="caracteristica5" />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="caracteristica5"> Caracteristica5 </label>

                    <div class="relative mb-6 hidden peer-checked/caracteristica5:block" data-te-input-wrapper-init>
                        <textarea maxlength="40" data-te-input-showcounter="true" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="Caracteristica5" name="caracteristica5" rows="3" placeholder="Descripcion" required>...</textarea>
                        <label for="Caracteristica5" class="peer-focus:text-primary pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Caracteristica5 </label>
                        <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
                    </div>
                </div>




                <!--Submit button-->
                <button type="submit" class="inline-block w-full rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]" data-te-ripple-init data-te-ripple-color="light">
                    Guardar
                </button>
            </form>

        </div>

    </div>

    <!-- Modulo -->
    <div class="[  h-auto rounded-lg bg-white p-6 shadow-lg w-full ] [ lg:w-4/5    ]">
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
                                <label for="ModalEditar_agrupadoscaracteristicaProducto2" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica2
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto3" id="ModalEditar_agrupadoscaracteristicaProducto3" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto3" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica3
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto4" id="ModalEditar_agrupadoscaracteristicaProducto4" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto4" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica4
                                </label>
                            </div>
                            <div class="relative w-full" data-te-input-wrapper-init>
                                <input maxlength="40" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" name="ModalEditar_agrupadoscaracteristicaProducto5" id="ModalEditar_agrupadoscaracteristicaProducto5" placeholder="Example label" />
                                <label for="ModalEditar_agrupadoscaracteristicaProducto5" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">Caracteristica5
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
    if (typeof tabla_producto === 'undefined') {
        let tabla_producto = new DataTable('#tabla_producto');
    }

    if (typeof tabla_agrupados_data === 'undefined') {
        let tabla_agrupados_data = new DataTable('#tabla_agrupados_producto');
    }

    myModalEl = document.getElementById("staticBackdrop");
    modal = new te.Modal(myModalEl);

    modal_editar_agrupados = document.getElementById("modal_editar_agrupados");
    modal_editar_agrupados = new te.Modal(modal_editar_agrupados);

    form = document.getElementById('nuevoproductoform');

    Producto_consulta();


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
                        modulo_productos();
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
</script>