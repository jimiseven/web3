function toggleBold(h1Element) {
    const currentStyle = h1Element.style.fontWeight;
    const newStyle = currentStyle === "bold" ? "normal" : "bold"; // Toggle between bold and normal
  
    h1Element.style.fontWeight = newStyle;
  }
  
  const btnToggleBold = document.getElementById("btnToggleBold");
  const h1Element2 = document.querySelector(".seccion-ejemplos h2"); // Select the h1 element
  
  btnToggleBold.addEventListener("click", () => {
    toggleBold(h1Element2);
  });


  //cambio de color a texto
function toggleColor(h1Element) {
    const currentColor = h1Element.style.color;
    const newColor = currentColor === "blue" ? "black" : "blue"; // Toggle between blue and black
  
    h1Element.style.color = newColor;
  }
  
  const btnToggleColor = document.getElementById("btnToggleColor"); // Add button ID
  const h1Element3 = document.querySelector(".seccion-ejemplos h2"); // Select the h1 element
  
  btnToggleColor.addEventListener("click", () => {
    toggleColor(h1Element3);
  });

  //arrreglo

  let arregloStrings = [];

function updateArregloLista() {
  const arregloLista = document.getElementById("arreglo-lista");
  arregloLista.innerHTML = "";

  arregloStrings.forEach((item, index) => {
    const listItem = document.createElement("li");
    listItem.textContent = `${index + 1}. ${item}`;
    arregloLista.appendChild(listItem);
  });
}

const btnAgregarInicio = document.getElementById("btnAgregarInicio");
const valorNuevoInput = document.getElementById("valorNuevo");

btnAgregarInicio.addEventListener("click", () => {
  const nuevoValor = valorNuevoInput.value.trim();

  if (nuevoValor) {
    arregloStrings.unshift(nuevoValor);
    valorNuevoInput.value = "";
    updateArregloLista();
  }
});

const btnAgregarFinal = document.getElementById("btnAgregarFinal");

btnAgregarFinal.addEventListener("click", () => {
  const nuevoValor = valorNuevoInput.value.trim();

  if (nuevoValor) {
    arregloStrings.push(nuevoValor);
    valorNuevoInput.value = "";
    updateArregloLista();
  }
});

const btnEliminarInicio = document.getElementById("btnEliminarInicio");

btnEliminarInicio.addEventListener("click", () => {
  if (arregloStrings.length > 0) {
    arregloStrings.shift();
    updateArregloLista();
  }
});

const btnEliminarFinal = document.getElementById("btnEliminarFinal");

btnEliminarFinal.addEventListener("click", () => {
  if (arregloStrings.length > 0) {
    arregloStrings.pop();
    updateArregloLista();
  }
});


//funcionalidad cambio de imagen card1
let indiceImagen1 = 1; // Indice de la imagen actual (1 para img1.jpg)

function cambiarImagen1() {
    const imagen = document.getElementById("card1"); // Obtener la referencia a la imagen
  const imagenes = ["img/img1.jpg", "img/img4.jpg"]; // Array con las URLs de las imágenes

  indiceImagen1 = (indiceImagen1 + 1) % imagenes.length; // Calcular el nuevo índice
  imagen.src = imagenes[indiceImagen1]; // Cambiar la fuente de la imagen
}

//funcionalidad cambio de imagen card2
let indiceImagen2= 1; // Indice de la imagen actual (1 para img1.jpg)

function cambiarImagen2() {
    const imagen = document.getElementById("card2"); // Obtener la referencia a la imagen
  const imagenes = ["img/img2.jpg", "img/img5.jpg"]; // Array con las URLs de las imágenes

  indiceImagen2= (indiceImagen2+ 1) % imagenes.length; // Calcular el nuevo índice
  imagen.src = imagenes[indiceImagen2]; // Cambiar la fuente de la imagen
}

//funcionalidad cambio de imagen card2
let indiceImagen3= 1; // Indice de la imagen actual (1 para img1.jpg)

function cambiarImagen3() {
    const imagen = document.getElementById("card3"); // Obtener la referencia a la imagen
  const imagenes = ["img/img3.jpg", "img/img6.jpg"]; // Array con las URLs de las imágenes

  indiceImagen3= (indiceImagen3+ 1) % imagenes.length; // Calcular el nuevo índice
  imagen.src = imagenes[indiceImagen3]; // Cambiar la fuente de la imagen
}