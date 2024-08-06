document.getElementById('virar').addEventListener('click', function(){
	document.getElementById('blocovirar').classList.toggle('none')
    document.getElementById('blocovirar').classList.toggle('flex')
})

document.getElementById('add').addEventListener('click', function(){
	document.getElementById('blocoadd').classList.toggle('none')
    document.getElementById('blocoadd').classList.toggle('flex')
})

document.querySelector("#blocovirar .cancelar").addEventListener('click', function(){
	document.getElementById('blocovirar').classList.toggle('none')
    document.getElementById('blocovirar').classList.toggle('flex')
})

document.querySelector("#blocoadd .cancelar").addEventListener('click', function(){
	document.getElementById('blocoadd').classList.toggle('none')
    document.getElementById('blocoadd').classList.toggle('flex')
})