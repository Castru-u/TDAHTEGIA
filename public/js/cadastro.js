
        function abrirTermos() {
            document.getElementById('termos-container').style.display = 'block';
            document.getElementById('dados').style.display = 'none';
            document.getElementById('aceito_termos_1').disabled = false;
        }


        var checkbox1 = document.getElementById('aceito_termos_1');
        var checkbox2 = document.getElementById('aceito_termos_2');

        checkbox1.checked = checkbox2.checked;


        function fecharTermos() {
            document.getElementById('termos-container').style.display = 'none';
            document.getElementById('dados').style.display = 'flex';
            
        }

        let inputs = document.getElementsByTagName("input");

        let preenchidos

        for (let input of inputs){
            input.addEventListener('change', function(){
                preenchidos = true

                for (let i of inputs){
                    if (i.value.length==0 && i.type!='checkbox'){
                        preenchidos = false
                        
                    }
                if (document.getElementById('senha').value==document.getElementById('senha2').value){
                    document.getElementById('textored').style.display='none'
                }else{
                    preenchidos = false;
                    document.getElementById('textored').style.display='block'}

                if (checkbox1.checked){
                }else{
                    preenchidos = false}
                
                document.getElementById('cadastrar').disabled = !preenchidos;
                }
            })
        };

        function sincronizarCheckboxes() {
            var checkbox1 = document.getElementById('aceito_termos_1');
            var checkbox2 = document.getElementById('aceito_termos_2');
            
            // Verifica qual checkbox está sendo clicado
            if (event.target === checkbox1) {
                console.log('Checkbox 1 clicado');
                // Sincroniza checkbox2 com checkbox1
                checkbox2.checked = checkbox1.checked;
                
                // Habilita ou desabilita checkbox2 baseado no estado de checkbox1
                checkbox2.disabled = !checkbox1.checked;
            } else if (event.target === checkbox2) {
                console.log('Checkbox 2 clicado');
                // Sincroniza checkbox1 com checkbox2
                checkbox1.checked = checkbox2.checked;
                
                // Habilita ou desabilita checkbox1 baseado no estado de checkbox2
                checkbox1.disabled = !checkbox2.checked;
            }
            
        }

    