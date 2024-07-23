let inputs = document.getElementsByTagName("input");

let preenchidos

for (let input of inputs){
    input.addEventListener('change', function(){
        preenchidos = true

        for (let i of inputs){
            if (i.value.length==0 && i.type!='checkbox'){
                preenchidos = false              
            }
        
        document.querySelector('#entrar').disabled = !preenchidos;
        }
    })
};