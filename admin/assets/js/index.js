async function modulo_productos() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);

  let validar = await comprobarsession();
  if (validar.data) {
    $("#principal").load("./modulos/Productos/index.php");
  } else {
    cwindow.location.href = './php/logout.php';
  }


}

async function modulo_stock() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent alig00ct(0,0,0,0)]">Loading...</span> </div>`);

  let validar = await comprobarsession();
  if (validar.data) {
    $("#principal").load("./modulos/Stock/index.php");
  } else {
    window.location.href = './php/logout.php';
  }

}
async function modulo_categoria() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
  let validar = await comprobarsession();
  if (validar.data) {

    $("#principal").load("./modulos/Categorias/index.php");
  } else {
    window.location.href = './php/logout.php';
  }
}
async function modulo_ordenes() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
  let validar = await comprobarsession();
  if (validar.data) {
    $("#principal").load("./modulos/Ordenes/index.php");
  } else {
    window.location.href = './php/logout.php';
  }

}


async function modulo_tokens() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
  let validar = await comprobarsession();
  if (validar.data) {
    $("#principal").load("./modulos/Tokens/index.php");
  } else {
    window.location.href = './php/logout.php';
  }
}
const makeRandomId = (length) => { //creador de id random
  let result = ''
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return result;
}
async function modulo_usuarios() {
  $("#principal").html(`<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"> <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span> </div>`);
  let validar = await comprobarsession();
  if (validar.data) {
    $("#principal").load("./modulos/usuarios/index.php");
  } else {
    window.location.href = './php/logout.php';
  }
}
 

async function comprobarsession() {
  let result = await $.ajax({
    // la URL para la petición
    url: './php/comprobarsession.php',
    // especifica si será una petición POST o GET
    type: 'GET',
    // el tipo de información que se espera de respuesta
    dataType: 'json',
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
  });

  return result;
}



