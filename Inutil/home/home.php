<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Slideshow HTML/CSS/JS/PHP</title>
<style>
.slideshow {
  position: relative;
  width: 100%;
  height: 300px;
  overflow: hidden;
}

.slideshow img {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  animation: fade 3s infinite;
}

.slideshow a {
    text-decoration: none;
    padding: 0;
    margin: 0;
}

@keyframes fade {
  0% {
    opacity: 0;
  }
  20% {
    opacity: 1;
  }
  33% {
    opacity: 1;
  }
  53% {
    opacity: 0;
  }
  100% {
    opacity: 0;
  }
}


</style>
</head>
<body>
<div class="slideshow">
    <a href="seu-link1">
        <img src="ADOLESCENTES.jpg" alt="Imagem 1">
    </a>
    <a href="seu-link2">
        <img src="ADOLESCENTES.jpg" alt="Imagem 2">
    </a>
    <a href="seu-link3">
        <img src="ADOLESCENTES.jpg" alt="Imagem 3">
    </a>
</div>
</body>
</html>
