var imgsite = new Array("imagens/1.png", "imagens/2.png", "imagens/3.png","imagens/4.png","imagens/5.png","imagens/6.png")
var numrandom = Math.floor(Math.random() * imgsite.length)


document.getElementById("esquerda-img").src = imgsite[numrandom];
