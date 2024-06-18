function pasa(valor){
    if(valor === 1){
        imagen.src = "imgs/img1.jpg"
    }
    else{
        imagen.src = "imgs/img2.jpg"
    }
}


// let indiceImagen = 1; // Indice de la imagen actual (1 para img1.jpg)

// function cambiarImagen() {
//     const imagen = document.getElementById("imagen"); // Obtener la referencia a la imagen
//   const imagenes = ["imgs/img1.jpg", "imgs/img2.jpg"]; // Array con las URLs de las imágenes

//   indiceImagen = (indiceImagen + 1) % imagenes.length; // Calcular el nuevo índice
//   imagen.src = imagenes[indiceImagen]; // Cambiar la fuente de la imagen
// }
