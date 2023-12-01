//tomamos los elementos
var inputTarea = document.getElementById("tarea");
var btn = document.getElementById("agregar");
var listado = document.getElementById("listado");
var cantidad = document.getElementById("cantidad");

//variable que lleva la cantidad de tareas
var total = 0;

btn.onclick = function() {
    //controlamos si el campo esta vacio
    if (inputTarea.value == "") {
        return;
    }
    //tomamos el valor del campo
    var elemento = inputTarea.value;
    //creo un elemento li
    var li = document.createElement("li");
    //le agrego el texto al elemento
    li.textContent = elemento;
    //egrego el li al listado
    listado.appendChild(li);
    //incremento la cantidad de tareas
    total++;
    cantidad.innerHTML = total;


    //Agregamos el boton eliminar a cada elemento del listado
    var btnEliminar = document.createElement("span");
    btnEliminar.textContent = "\u00d7";
    li.appendChild(btnEliminar);


    //Agregamos la funcionalidad que elimina del listado el elemento
    btnEliminar.onclick = function() {
        li.remove();
        total--;
        cantidad.innerHTML = total;
    }

    //limpiamos el campo
    inputTarea.value = "";

}
function verificarFormato() {
    var nombre = document.getElementById('nombre').value;
    var email = document.getElementById('correo').value;
   
    const pattern = new RegExp('^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$', 'i');
    //https://es.stackoverflow.com/questions/81041/expresion-regular-para-validar-letras-con-acentos-y-%C3%B1

    console.log("ha entrado");

    if (nombre === '' || !pattern.test(nombre)) {
        window.alert("El campo nombre está vacío o contiene un número");
        return false;
    }

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo)) {
        window.alert("El email introducido no es correcto");
        return false;
    }

   // window.alert("Formatos validos")
   // return true; // Devuelve true si todas las validaciones son exitosas
}
