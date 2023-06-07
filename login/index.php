<?php
session_name("ecomercer_user_data");
session_start();
if (isset($_SESSION['token'])) {
    // la variable si esta definida

    if (empty($_SESSION['token']) || is_null($_SESSION['token'])) {
        // la variable esta vacia o es null
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
} else {
    // la variable no esta definida
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <meta name="csrf-token" content="<?php echo $_SESSION['token']; ?>">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="../assets/img/logo-white.png" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    <title>Login</title>
</head>

<body>
    <section class="gradient-form  flex justify-center items-center h-screen bg-neutral-200 dark:bg-neutral-700">
        <div class="w-full h-full p-10 [ md:w-3/4 ] [ lg:w-3/4 ]">
            <div class="g-6 flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
                <div class="w-full">
                    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-800">
                        <div class="g-0 lg:flex lg:flex-wrap">
                            <!-- Left column container-->
                            <div class="p-4 md:px-0 lg:w-6/12 relative">
                                <a href="../tienda.php" class=" absolute left-5 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                    </svg>
                                </a>
                                <div class="md:mx-6 md:p-12">
                                    <!--Logo-->
                                    <div class="[ text-center ]">
                                        <a href="../">
                                            <img class="[ mx-auto w-48 ]" src="../assets/img/logo.png" alt="logo" />
                                        </a>
                                        <h4 class="mb-12 mt-1 pb-1 text-xl font-semibold">
                                            Panel del Vendedor
                                        </h4>
                                    </div>

                                    <form id='form_ingresa'>
                                        <p class="mb-4">Datos De Usuario</p>
                                        <!--Username input-->
                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <input type="text" name="nombre" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleFormControlInput1" placeholder="Username" />
                                            <label for="exampleFormControlInput1" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Usuario
                                            </label>
                                        </div>

                                        <!--Password input-->
                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <input type="password" name="clave" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleFormControlInput11" placeholder="Password" />
                                            <label for="exampleFormControlInput11" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Clave
                                            </label>
                                        </div>

                                        <!--Submit button-->
                                        <div class="mb-12 pb-1 pt-1 text-center">
                                            <button onclick="InicioSession()" id="btn_ingresar" class="[ lg:text-xs ] disabled:opacity-50 flex gap-1 items-center justify-center w-full rounded-r bg-[#e4a11b] px-6 py-2.5 font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-[#e4a11b] hover:shadow-lg focus:bg-[#e4a11b]focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#e4a11b] active:shadow-lg" type="button" data-te-ripple-init data-te-ripple-color="light">
                                                <div>Entrar</div>

                                            </button>

                                            <!--Forgot password link-->
                                            <!--<a href="#!">Forgot password?</a>-->

                                        </div>


                                    </form>
                                </div>
                            </div>

                            <!-- Right column container with background and description-->
                            <div class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none hidden bg-cover bg-no-repeat bg-center [ md:hidden ] [ lg:block ] bg-[url('../assets/img/login-banner.jpg')]  ">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function InicioSession() {
            var form_data = $('#form_ingresa').serialize(); //serialize form data
            $.ajax({
                url: "../api/login/index.php",
                method: "POST",
                data: form_data,
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: () => {
                    $('#btn_ingresar').prop('disabled', true);
                    $('#btn_ingresar').html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
                },
                success: function(response) {

                    if (response.result) {
                        $('#btn_ingresar').html(`Ingresando...`);
                        window.location.href = "../tienda.php";
                    } else {
                        $('#btn_ingresar').html(`Entrar`);
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
                    $('#btn_ingresar').prop('disabled', false);
                    $('#btn_ingresar').html(`Entrar`);
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>

</html>