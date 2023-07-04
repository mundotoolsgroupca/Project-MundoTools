const idrandom = (length) => {
  //creador de id random
  let result = "";
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return result;
};

class ProductosTicket {
  nombre = "";
  descripcion = "";
  precio = 0;
  precio2 = 0;
  cantidad = 0;
  simbolo = "";
  cod_moneda = "";
  imagen = "";
  id = "";
  ticketId = "";
}

const Carrito = {
  list: [],
  id: "Carrito",
  idcantidad: "Cantidad_produtos",
  idTotales: "CarritoTotales",
  add: (id, Count, Productosarr) => {
    debugger
    let Datos = new ProductosTicket();
    let productoExistente = Carrito.list.find((producto) => producto.id === id);

    if (productoExistente) {
      let cantidadtotal = Number(productoExistente.cantidad) + Number(Count);
      productoExistente.cantidad = cantidadtotal;
    } else {
      Carrito.list.push({
        nombre: Productosarr.nombre,
        descripcion: Productosarr.descripcion,
        precio: Productosarr.precio,
        precio2: Productosarr.precio2,
        simbolo: Productosarr.simbolo,
        imagen: Productosarr.imagen,
        id: Productosarr.id,
        ticketid: Carrito.makeRandomId(6),
        cantidad: Count,
        cod_moneda: Productosarr.cod_moneda,
      }); //Se Agregara Siempre y Cuando no este ingresado previamente o no haya ningun producto en el Carrito
    }
    // GUARDAR EN STORAGE
    localStorage.setItem("CARRITO", JSON.stringify(Carrito.list));

    //objeto.disabled = true;
    $(`#${Carrito.id}`).html(""); //limpiamos el carrito
    $(`#Cantidad_produtos`).html(`(${Carrito.list.length})`); //colocamos la cantidad de productos
    $(`#${Carrito.idTotales}`).html(Carrito.totalsum); //sumatoria total

    $("#newitemadd_status").removeClass("hidden");
    $("#newitemadd_status").addClass("visible"); //mostrar indicador de nuevo productos
    Carrito.list.map((item) => {
      $(`#${Carrito.id}`).append(
        ` 
      <div id="${
        item.ticketid
      }" class="[ relative  flex gap-1 items-center border-b p-1 border-gray-300   ]">
          <div class="absolute top-0 cursor-pointer " onclick='Carrito.delete("${
            item.ticketid
          }")'>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-danger w-6 h-6">
                  <path fill-rule="evenodd"
                      d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                      clip-rule="evenodd" />
              </svg>

          </div>
          <div class="[ w-full flex justify-between items-center ]">
              <div class="[ ml-5 flex gap-1 items-center   ]">
                  <div class="[ w-16 ]">
                      <img loading="lazy"  data-te-ripple-init onerror="this.onerror=null;this.src='./${
                        item.imagen
                      }';" src="../${item.imagen}" title="${
          item.nombre
        }" class="h-12  w-12   object-cover">
                  </div>
                  <div class="[ w-full text-slate-700 ]">
                      ${
                        item.nombre.length >= 10
                          ? item.nombre.substring(0, 25) + "..."
                          : item.nombre
                      }
                  </div>

              </div>
              <div>
                  <p class="text-lg font-bold flex gap-1 items-center ">${
                    item.precio
                  }${item.simbolo}<label class='text-xs text-gray-500'> (${
          item.cantidad
        }x)</label></p>
              </div>
          </div>
      </div>
      `
      );
    });

    return true;
  },
  delete: (ticketid) => {
    Carrito.list.map((Item, index) => {
      if (Item.ticketid == ticketid) {
        //$(`#${Carrito.id}`).html('');
        Carrito.list.splice(index, 1);
        localStorage.clear();
        localStorage.setItem("CARRITO", JSON.stringify(Carrito.list));
        $(`#${Carrito.idcantidad}`).html(`(${Carrito.list.length})`);
        $(`#${Carrito.idTotales}`).html(Carrito.totalsum);

        $(`#${ticketid}`)
          .hide("puff")
          .queue(function () {
            $(`#${ticketid}`).remove();
          });

        if (Carrito.list.length == 0) {
          $("#newitemadd_status").removeClass("visible");
          $("#newitemadd_status").addClass("hidden");
        }

        return true;
      } else {
        return false;
      }
    });
  },
  totalsum: () => {
    let total = 0;

    for (let i = 0; i < Carrito.list.length; i++) {
      let producto = Carrito.list[i];
      let subtotal = Carrito.list[i].precio * Carrito.list[i].cantidad;
      total += subtotal;
    }
    return total.toFixed(2);
    //return Carrito.list.reduce((sum, value) => (typeof value.precio == "number" ? sum + (value.precio * value.cantidad) : sum), 0);
  },
  clear: () => {
    Carrito.list = [];
    $(`#Cantidad_produtos`).html(`(${Carrito.list.length})`);
    $(`#${Carrito.idTotales}`).html(Carrito.totalsum);
    $(`#${Carrito.id}`).html("");
    $("#newitemadd_status").removeClass("visible");
    $("#newitemadd_status").addClass("hidden");
    localStorage.clear();
  },
  makeRandomId: (length) => {
    //creador de id random
    let result = "";
    const characters =
      "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (let i = 0; i < length; i++) {
      result += characters.charAt(
        Math.floor(Math.random() * characters.length)
      );
    }
    return result;
  },
};
