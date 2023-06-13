function validarString(string, permitidos) {
  string = string.trim();
  if (string.length === 0) {
    return false; // La cadena solo contiene espacios en blanco
  }
  for (let i = 0; i < string.length; i++) {
    if (permitidos.indexOf(string[i]) === -1) {
      return false;
    }
  }
  return true;
}

function validarMonto(monto) {
  let regex = /^\d+(?:\.\d{0,2})?$/; // expresión regular para verificar el formato de número
  if (!regex.test(monto)) {
    return false; // si la entrada no coincide con el formato de número, retornamos false
  }
  let num = parseFloat(monto); // convertimos la entrada en un número de punto flotante
  if (num < 0) {
    return false; // si el número es negativo, retornamos false
  }
  return true; // la entrada es válida
}
