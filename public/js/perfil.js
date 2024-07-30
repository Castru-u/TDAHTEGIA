let editar = document.getElementById("editar");
let salvar = document.getElementById("salvar");
let cancelar = document.getElementById("cancelar")

editar.addEventListener('click', function(){
    editar.style.display = 'none';
    salvar.style.display = 'block';
    cancelar.style.display = 'block';
    document.getElementById("area1").style.display = 'block';
    document.querySelector('textarea').style.display = 'block';
    document.querySelector('.input-box p').style.display = 'none';
}) 

cancelar.addEventListener('click', function(){
    editar.style.display = 'block';
    salvar.style.display = 'none';
    cancelar.style.display = 'none';
    document.getElementById("area1").style.display = 'none';
    document.querySelector('textarea').style.display = 'none';
    document.querySelector('.input-box p').style.display = 'block';
})