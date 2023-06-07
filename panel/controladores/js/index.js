async function modulo_perfil() {
    $("#box_principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
    let validar = await comprobarsession();
    if (validar.data) {
        $("#box_principal").load("./controladores/modulos/perfil.php");
    } else {
        window.location.href = '../php/logout.php';
    }

}

async function modulo_ordenes() {
    $("#box_principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
    let validar = await comprobarsession();
    if (validar.data) {
        $("#box_principal").load("./controladores/modulos/ordenes.php");
    } else {
        window.location.href = '../php/logout.php';
    }

}
async function modulo_tokens() {
    $("#box_principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
    let validar = await comprobarsession();
    if (validar.data) {
        $("#box_principal").load("./controladores/modulos/tokens.php");
    } else {
        window.location.href = '../php/logout.php';
    }

}


async function comprobarsession() {
    let result = await $.ajax({
        // la URL para la petición
        url: './controladores/php/comprobarsession.php',
        // especifica si será una petición POST o GET
        type: 'GET',
        // el tipo de información que se espera de respuesta
        dataType: 'json',
        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
    });

    return result;
}

