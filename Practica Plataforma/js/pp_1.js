function viaje(){
    var valor = document.getElementById("destino").value;//para que funcione movimos esta linea document.getElementById sirve para identificar el id seleccionado
    var cadena='';
    switch(valor) {
      case "1": cadena = "La Paz - precio: 100 Bs"; break;
      case "2": cadena = "Santa Cruz - precio: 170 Bs"; break;
      case "3": cadena = "Oruro - precio: 110 Bs"; break;
      case "4": cadena = "Potosí - precio: 60 Bs"; break;
      case "5": cadena = "Tarija - precio: 215 Bs"; break;
    }
    alert("Destino de viaje "+cadena);
  }
  