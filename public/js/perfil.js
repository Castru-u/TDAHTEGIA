let editar = document.getElementById("editar");
let salvar = document.getElementById("salvar");
let cancelar = document.getElementById("cancelar")

editar.addEventListener('click', function(){
    editar.classList.toggle('none');
    salvar.classList.toggle('none');
    cancelar.classList.toggle('none');
    document.getElementById("area1").classList.toggle('none');
    document.getElementById("area1").classList.toggle('flex');
    document.querySelector('textarea').classList.toggle('none');
    document.querySelector('.input-box p').classList.toggle('none');
}) 

cancelar.addEventListener('click', function(){
    editar.classList.toggle('none');
    salvar.classList.toggle('none');
    cancelar.classList.toggle('none');
    document.getElementById("area1").classList.toggle('none');
    document.getElementById("area1").classList.toggle('flex');
    document.querySelector('textarea').classList.toggle('none');
    document.querySelector('.input-box p').classList.toggle('none');
});