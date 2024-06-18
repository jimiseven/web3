/*const numeros=[10,20,[1,2,3,4,5], 30,40];
console.log(`El arreglo de numeros es: ${numeros}`);

const dias = ['lunes', 'marte', 'miercoles'];
console.log(`el arreglo de dias es: ${dias}`);

const detodo=['string', 10, false, null, undefined, {nombre: "Pedro"}, [1,2,3,4,5]];
console.log(`el arreglo detodo es: ${detodo}`);

//otra forma de imprimir
console.log(numeros[0], numeros[2]);*/

//Agregar de objetos mediante SPREAD OPERATOR
const productos=[];
const articulos={
    nombre: 'Monitor 32 pulgadas',
    precio: 400,
}

const articulos2={
    nombre: 'Microfono',
    precio: 100,
}

const articulos3={
    nombre: 'Consola',
    precio: 200,
}

let resultado=[...productos, articulos, articulos2, articulos3]; //tarea como se pone los ... puede estar al principio o en el segundo parametro
console.table(resultado);

let resultado2=[articulos3, ...productos, articulos2];
console.table(resultado2);

let resultado3=[articulos3, articulos, ...productos, articulos2];
console.table(resultado3);