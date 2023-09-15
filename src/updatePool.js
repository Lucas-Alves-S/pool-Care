function alterDate() {
    var nextClean = document.getElementById("nextClean").value;
    document.getElementById("nextClean").value = "";
    document.getElementById("lastClean").value = nextClean;
}/* 

function formatDate(input) {
    let value = input.value;
    value = value.replace(/\D/g, '');
  
    if (value.length > 4) {
      value = value.replace(/^(\d{4})(\d{2})(\d{0,2})(\d{0,2})$/, '$1-$2-$3');
    } else if (value.length > 2) {
      value = value.replace(/^(\d{4})(\d{0,2})$/, '$1-$2');
    }
    
    input.value = value;
} */

function formatarData(input) {
  var valor = input.value.replace(/\D/g, '');

  if (valor.length > 2) {
      valor = valor.substring(0, 2) + '-' + valor.substring(2);
  }
  if (valor.length > 5) {
      valor = valor.substring(0, 5) + '-' + valor.substring(5, 9);
  }
  input.value = valor;
}
  