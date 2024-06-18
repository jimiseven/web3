/*const numeros = [10, 20, 30, 40, 50];
const [primero, segundo, tercero, cuarto, quinto] = numeros;
console.log(primero);
console.log(segundo);
console.log(tercero);
console.log(cuarto);
console.log(quinto);

const valores =[1,2,3,4];
const[,,,cuartoo] = valores;
console.log(cuartoo);4

const posiciones =[100,200,300,400,500];
const[num1, ...resto] = posiciones;
console.log(resto);*/

const articulos =[
    {nombre: "Radio", precio: 450},
    {nombre: "Celular", precio: 1850},
    {nombre: "Mouse", precio: 120},
]

const nuevoArreglo = articulos.forEach(function (producto){
    console.log(`Nombre: ${producto.nombre} - Precio: ${producto.precio}`);
});

const arreglo2 = articulos.map(function (elemento){
    console.log(`Nombre: ${elemento.nombre} - Precio: ${elemento.precio}`);
});

console.log("Los nuevos arreglos son: ");
console.log(arreglo2);