
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../../public/css/cadastro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi|Kanit">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <script>
        function abrirTermos() {
            document.getElementById('termos-container').style.display = 'block';
            document.getElementById('dados').style.display = 'none';
            document.getElementById('aceito_termos_1').disabled = false;
        }

        function habilitarBotao() {
            var checkbox1 = document.getElementById('aceito_termos_1');
            var checkbox2 = document.getElementById('aceito_termos_2');

            checkbox1.checked = checkbox2.checked;
            document.getElementById('cadastrar').disabled = !checkbox1.checked;
        }

        function fecharTermos() {
            document.getElementById('termos-container').style.display = 'none';
            document.getElementById('dados').style.display = 'flex';
            
        }

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
            
            habilitarBotao(); // Atualiza o estado do botão de cadastro
        }

    </script>
</head>
<body>
    <a href="home.html"><i class="material-symbols-outlined voltar">
        arrow_back_ios
    </i></a>

    <div id="principal">
        <div id="esquerdo" class="lado">
            <div id="logo">
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
     "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="500.000000pt" height="363.pt" viewBox="0 0 500.000000 363.000000"
     preserveAspectRatio="xMidYMid meet">
    
    <g transform="translate(0.000000,363.000000) scale(0.100000,-0.100000)"
    fill="#FFF" stroke="none">
    <path d="M1251 3110 c-678 -280 -1235 -511 -1237 -513 -2 -2 209 -91 469 -198
    l472 -194 0 -965 1 -964 94 -29 c373 -112 813 -198 1168 -228 175 -14 558 -6
    721 15 334 45 683 123 994 222 l107 35 0 957 0 957 147 60 c81 33 150 62 155
    63 4 2 8 -140 8 -317 l0 -320 -53 -53 c-38 -38 -57 -66 -65 -98 -10 -39 -82
    -671 -77 -678 1 -1 134 -1 296 0 l295 3 -33 315 c-18 173 -38 335 -45 360 -9
    33 -26 59 -65 97 l-53 52 2 363 3 363 218 89 c130 54 212 93 205 97 -32 18
    -2471 1019 -2482 1018 -6 0 -566 -229 -1245 -509z m2233 -103 c538 -221 977
    -407 976 -412 -2 -6 -443 -191 -981 -413 l-979 -403 -979 403 c-538 222 -980
    407 -982 412 -3 8 1928 813 1957 815 6 1 451 -180 988 -402z m-1622 -1176
    l638 -263 667 275 668 275 6 -326 c3 -180 7 -447 8 -594 l1 -267 -82 -25
    c-237 -72 -644 -156 -898 -186 -441 -50 -964 1 -1550 153 l-165 42 0 133 c0
    72 1 344 3 602 l2 470 33 -13 c17 -8 319 -132 669 -276z m2606 -330 c9 -6 20
    -65 32 -182 11 -96 22 -195 25 -221 l6 -48 -81 0 -81 0 6 48 c3 26 14 125 25
    221 17 161 25 191 50 191 3 0 11 -4 18 -9z m-618 -925 l0 -143 -107 -32 c-270
    -78 -602 -146 -853 -175 -378 -44 -737 -25 -1200 65 -146 29 -436 97 -507 120
    l-33 11 0 144 c0 79 4 144 8 144 5 0 69 -16 143 -35 703 -180 1262 -213 1867
    -109 158 27 442 91 567 128 126 37 115 48 115 -118z"/>
    </g>
    </svg>
        <p>TDAHTÉGIA</p>
            </div>
        <p id="texto">Entre<br>na nossa<br>plataforma!</p>
        <p id="info">(77)9825-1760<br>tdahtegia.com.br<br>approtinadeestudos@gmail.com</p>
        </div>
        <div id="direito" class="lado">
            <div id="caixa">
                <form action="#" method="post">
                    <div id="dados">
                        <h1>Cadastre-se</h1>
                        
                        <div class="caixatexto">
                            <input type="text" name="" id="" placeholder="Nome de usuário">
                        </div>
                        <div class="caixatexto">
                            <input type="text" name="" id="" placeholder="Email">
                        </div>
                        <div class="caixatexto">
                            <input type="password" name="" id="" placeholder="Senha">
                        </div>
                        <div class="caixatexto">
                            <input type="password" name="" id="" placeholder="Confirmar Senha">
                        </div>
    
                        <div id="termos">
                            <label>
                            <input type="checkbox" id="aceito_termos_1" onclick="sincronizarCheckboxes(); abrirTermos();"> Aceito os termos de serviço
                                <a href="#" onclick="abrirTermos(); return false">termos de serviço</a>
                            </label>
                            <br>
                            <button type="submit" id="cadastrar" disabled>Cadastrar</button>   
                            <p>Já possui uma conta? <a href="login.html">Entre!</a></p>
                        </div>
                    </div>
    
                    <div id="termos-container">
                        <h2>Termos de Uso e Política de Privacidade</h2>
                        <p>Última atualização: [16/07/2023]</p>
                        <h3>Termos de Uso</h3>
                        <p>
                            1. Aceitação dos Termos: Ao utilizar o site ou aplicativo de estudo TDAHTÉGIA, você concorda em cumprir e estar sujeito a estes Termos de Uso. Se você não concordar com estes termos, por favor, não utilize a plataforma.
                        </p>
                        <p>
                            2. Elegibilidade: O uso da plataforma é permitido apenas para indivíduos com idade mínima de 10 anos. Menores de 18 anos devem obter permissão de um responsável legal para utilização da mesma.
                        </p>
                        <p>
                            3. Conta de Usuário: Você deve criar uma conta para acessar algumas funcionalidades da plataforma. Você é responsável por manter a confidencialidade de sua senha e por todas as atividades que ocorrem em sua conta.
                        </p>
                        <p>
                            4. Uso Aceitável: Você concorda em usar o Aplicativo apenas para fins legais e de acordo com os Termos de Uso. Você não deve:
                        </p>
                        <ul>
                            <li>Utilizar a plataforma de forma que viole qualquer lei ou regulamento local, estadual, nacional ou internacional.</li>
                            <li>Publicar, enviar ou compartilhar qualquer conteúdo que seja ilegal, ofensivo, difamatório, obsceno ou que infrinja os direitos de terceiros.</li>
                            <li>Tentar acessar contas de outros usuários ou dados da plataforma sem autorização.</li>
                        </ul>
                        <p>
                            5. Direitos de Propriedade: Todos os direitos, títulos e interesses relativos à plataforma e seu conteúdo são de propriedade exclusiva dos desenvolvedores. Você não pode copiar, modificar, distribuir ou criar obras derivadas com base na plataforma sem permissão explícita.
                        </p>
                        <p>
                            6. Alterações a esta Política: Podemos atualizar esta Política de Privacidade periodicamente. Notificaremos você sobre quaisquer alterações significativas publicando a nova política na plataforma. Recomendamos revisar esta página regularmente para se manter informado sobre nossa coleta e uso de informações.
                        </p>
                        <p>
                            7. Contato: Se você possuir qualquer dúvida sobre estes Termos de Uso e Política de Privacidade, entre em contato conosco em [approtinadeestudos@gmail.com].
                        </p>
                        <p>
                            Ao usar nosso Aplicativo, você confirma que leu e concorda com estes Termos de Uso e Política de Privacidade.
                        </p>
                        <label>
                        <input type="checkbox" id="aceito_termos_2" onclick="sincronizarCheckboxes(); fecharTermos();"> Aceito os 
                            <a href="../../app/pages/cadastro.html" onclick="fecharTermos(); return false;">termos de serviço</a>
                            <button onclick="fecharTermos(); return false;">Fechar</button>
                        </label>
                    </div>
                </form>
            </div>
        </div>

</body>
</html>