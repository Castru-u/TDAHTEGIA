<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi|Kanit">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<body>
    <a href="home.php"><i class="material-symbols-outlined voltar">
        arrow_back_ios
    </i></a>
    
    <div id="principal">

        <h1>TDAHTÉGIA</h1>

        <?xml version="1.0" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
 "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="500.000000pt" height="363.pt" viewBox="0 0 500.000000 363.000000"
 preserveAspectRatio="xMidYMid meet">

<g transform="translate(0.000000,363.000000) scale(0.100000,-0.100000)"
fill="#fa6000" stroke="none">
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

<?php
if(isset($_GET['msgLogin'])){
    echo $_GET['msgLogin'];
}  
?>

<form action="../actions/usuario/login_usuario.php" method="post">


<div class="caixatexto"><i class="material-symbols-outlined">
    person
</i>
<input type="text" name="email" id="" placeholder="Email"></div>

<div class="caixatexto"><i class="material-symbols-outlined">
    lock
</i>
<input type="password" name="senha" id="" placeholder="Senha"></div>

    <div id="botao"><button type="submit" id="entrar" disabled='true'>Entrar</button></div>
</form>
    <p>Não possui uma conta? <a href="cadastro.php">Cadastre-se!</a></p>
    </div>

</body>
<script src="../../public/js/login.js"></script>
</html>