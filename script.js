
function showModal() {

  document.getElementById('openModal').style.display = 'block';
}

function CloseModal() {
  document.getElementById('openModal').style.display = 'none';
}
function showModal2() {
  document.getElementById('openModal2').style.display = 'block';
}

function CloseModal2() {
  document.getElementById('openModal2').style.display = 'none';
}
function showModal3() {
  document.getElementById('openModal3').style.display = 'block';
}

function CloseModal3() {
  document.getElementById('openModal3').style.display = 'none';
}

function mostrarBuzon() {
  document.getElementById('buzon').style.display = 'block';
}

function cerrarBuzon() {
  document.getElementById('buzon').style.display = 'none';
}
function mostrarLeerBuzon() {
  document.getElementById('leerBuzon').style.display = 'block';
}

function cerrarLeerBuzon() {
  document.getElementById('leerBuzon').style.display = 'none';
}
function ocultarDiv() {
  var x = document.getElementById("ocultarDiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function ocultarDiv2() {
  var x = document.getElementById("ocultarDiv2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}


var idP;
var user_reaccion;
function pasarID(idPublicacion, reaccion){
  idP=idPublicacion;
  user_reaccion=reaccion;
}

/*jQuery para cambiar el nombre del botón*/
$(".reaccion").click(function () {
  $(this).text(function (i, text) {
   if(text === "¡Reaccionar!"){
    //Implemento una función AJAX
    const http= new XMLHttpRequest();
    const url= "reaccionar.php?idPublicacion="+idP+"&action=reaccionar&userReaccion="+user_reaccion+"";
    http.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        location.href="TraerPublicaciones.php";
        console.log(this.responseText);
        
      }
    }
    http.open("GET", url);
    http.send();
    return  "Quitar Reaccion";
   } else{
     //Implemento una función AJAX
     const http= new XMLHttpRequest();
     const url= "reaccionar.php?idPublicacion="+idP+"&action=quitarReaccion&userReaccion="+user_reaccion +"";
     http.onreadystatechange=function(){
       if(this.readyState==4 && this.status==200){
        location.href="TraerPublicaciones.php"; 
        console.log(this.responseText);
         
       }
     }
     http.open("GET", url);
     http.send();
    return "¡Reaccionar!";
   }  
  })
  
});


/*jQuery para las pruebas*/
$("#bn").click(function () {
  $(this).text(function (i, text) {
    return text === "¡Reaccionar!" ? "Quitar Reaccion" : "¡Reaccionar!";
  })
});


//jQuery y JavaScript
function Alert_Direccion(B, Cadena, url) {

  if (B == 1) {
    Swal.fire(
      'Recibido',
      Cadena,
      'success'
    );
    setTimeout(function () { location.href = url; }, 3000);
  }

  if (B == 2) {
    Swal.fire(
      'Recibido',
      Cadena,
      'success'
    );
  }
  if (B == 3) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: Cadena,

    })
    setTimeout(function () { location.href = url; }, 2000);
  }
  else {
    Swal.fire(
      'Recibido',
      Cadena,
      'success'
    );
    setTimeout(function () { location.href = url; }, 3000);
  }

}

//Implementación de la función ubicar
function Ubicar(direccionTejedor, ID){
    //Hago los trims
    var Id=ID;
    var cadena = direccionTejedor.toUpperCase(),
    patron = /N/g,
    nuevoValor    = "%23",
    nuevaCadena = cadena.replace(patron, nuevoValor);
    var trim=nuevaCadena,
    espacio = / /g,
    plus    = "+",
    trimeado = trim.replace(espacio, plus);
    window.open("https://www.google.com/maps/search/"+trimeado+"/@4.7336925,-74.125371,14z?hl=es", '_blank');
    
    Swal.fire({
        title: "Creando mapa del tejedor...",
        input: "text",
        text: "Por favor ingresa las cordenadas seguidas del arroba(@)",
         inputPlaceholder: "Por ejemplo: 4.7336925,-74.125371,14",
        confirmButtonText: "Enviar"
    })
    .then(resultado => {
        if (resultado.value) {
            let cord = resultado.value;
            mapear(cord, Id);
            
        }
    });
    
    
    function mapear(cord, ID){
            //Hago un trim para separar la long y lat con base a el caracter ','
            var Id= ID;
            var cadena = cord,
            patron = ",",
            nuevoValor    = "y",
            nuevaCadena = cadena.replace(patron, nuevoValor);
            //Nueva cadena sin la coma y el espacio
            //console.log(nuevaCadena); 
            //Cuento la cantidad de caracteres
            var caracteres = nuevaCadena.length-1;
            //console.log('Cantidad de caracteres ' + caracteres);
            //Ubico el caracter Y
            var ubicacionY= nuevaCadena.indexOf("y");
            //console.log('Ubicacion de Y en la posición ' + ubicacionY);
            //Asigno a una variable llamada long, los caracteres desde 0 hasta la ubicacionY
            var long=nuevaCadena.substring(0,ubicacionY);
            var lat= nuevaCadena.substring(ubicacionY+1,caracteres); 
        
             //Implemento una función AJAX
            const http= new XMLHttpRequest();
            const url= "updateCord.php?ID="+Id+"&lon="+long+"&lat="+lat;
            http.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    console.log(this.responseText);
                     Alert_Direccion(2, this.responseText,"");
                    }
                }
            
     http.open("GET", url);
     http.send();

    }
    

    
    
}

function MostrarDiv() {
  document.getElementById('MostrarDiv').style.display = 'block';
}

function CerrarDiv() {
  document.getElementById('MostrarDiv').style.display = 'none';
}







