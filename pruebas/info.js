// cambiar a cursiva
function toggleItalic(h1Element) {
  const currentStyle = h1Element.style.fontStyle;
  const newStyle = currentStyle === "italic" ? "normal" : "italic"; // Toggle between italic and normal

  h1Element.style.fontStyle = newStyle;
}

const btnToggleItalic = document.getElementById("btnToggleItalic");
const h1Element1 = document.querySelector(".seccion-titulo h1"); // Select the h1 element

btnToggleItalic.addEventListener("click", () => {
  toggleItalic(h1Element1);
});



// cambiar a negrita
function toggleBold(h1Element) {
  const currentStyle = h1Element.style.fontWeight;
  const newStyle = currentStyle === "bold" ? "normal" : "bold"; // Toggle between bold and normal

  h1Element.style.fontWeight = newStyle;
}

const btnToggleBold = document.getElementById("btnToggleBold");
const h1Element2 = document.querySelector(".seccion-titulo h1"); // Select the h1 element

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
const h1Element3 = document.querySelector(".seccion-titulo h1"); // Select the h1 element

btnToggleColor.addEventListener("click", () => {
  toggleColor(h1Element3);
});

//cambio de imagen
function toggleImage(currentImageId, targetImageId) {
    const currentImage = document.getElementById(currentImageId);
    const targetImage = document.getElementById(targetImageId);
  
    // Hide the currently displayed image
    currentImage.style.display = "none";
  
    // Show the target image
    targetImage.style.display = "block";
  }

  const btnToggleImage = document.getElementById("btnToggleImage");

btnToggleImage.addEventListener("click", () => {
  let currentImageId = "imagen1"; // Initially assume Image 1 is displayed
  let targetImageId = "imagen2";

  // Check which image is currently displayed and switch to the other one
  const displayedImage = document.querySelector(".seccion-imagenes img:not([style='display: none'])");
  if (displayedImage) {
    currentImageId = displayedImage.id;
    targetImageId = currentImageId === "imagen1" ? "imagen2" : "imagen1";
  }

  toggleImage(currentImageId, targetImageId);
});



//adicionar al arreglo
let arregloStrings = []; // Initialize empty string array
function updateArregloLista() {
  const arregloLista = document.getElementById("arreglo-lista");
  arregloLista.innerHTML = ""; // Clear existing list items

  arregloStrings.forEach((item, index) => {
    const listItem = document.createElement("li");
    listItem.textContent = `${index + 1}. ${item}`; // Add index and item
    arregloLista.appendChild(listItem);
  });
}
const btnAgregarInicio = document.getElementById("btnAgregarInicio");
const valorNuevoInput = document.getElementById("valorNuevo");

btnAgregarInicio.addEventListener("click", () => {
  const nuevoValor = valorNuevoInput.value.trim(); // Get and trim input value

  if (nuevoValor) {
    arregloStrings.unshift(nuevoValor); // Add to the beginning of the array
    valorNuevoInput.value = ""; // Clear input field

    updateArregloLista(); // Update the list
  }
});


//agregar al final

