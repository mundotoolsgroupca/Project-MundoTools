<script>
    $('#principal').off();
</script>
<div>
    <div class="[  rounded-lg bg-white p-6 shadow-lg   ]   [ lg:w-1/4 ]">
        <div class="[ flex items-center gap-1 flex-nowrap mb-3 ]">
            <p class="[ text-lg font-bold ]">Categorias</p>
            <span id="CategoriaLoader"></span>
        </div>

        <form>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group" data-te-input-wrapper-init>
                    <input maxlength="30" data-te-input-showcounter="true" name="Nombre" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="Nombre" placeholder="Name" required />
                    <label for="Nombre" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Nombre
                    </label>
                    <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>

                </div>
                <div class="relative z-0 w-full mb-6 group">
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
                <input maxlength="30" data-te-input-showcounter="true" name="nombre_usuario" type="text" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none  [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="clave" placeholder="Name" required />
                <label for="clave" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none  ">Clave
                </label>
                <div class="absolute w-full text-sm text-neutral-500 dark:text-neutral-200" data-te-input-helper-ref></div>
            </div>



            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

</div>