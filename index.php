<?php 
  include_once('class/classes.php')
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SOS Pets</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="/sos_pet/">
            <img src="images/logo.png" alt="" />
            <span>
              SOS Pets
            </span>
          </a>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Tem interesse em adotar ou doar um Pet?
                    </h1>
                    <p>
                      Clique abaixo para realizar login ou cadastro
                    </p>
                    <div class="btn-box">
                      <a href="logar" class="btn-1">
                        Login
                      </a>
                      <a href="cadastrar" class="btn-2">
                        Cadastre-se
                      </a>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="images/adotePet.gif" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- experience section -->

  <section class="experience_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="img-box">
            <img src="images/ImportanciaAdotarPet.gif" alt="">
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Qual a importância para adotar um PET?
              </h2>
            </div>
            <p>
              Ao adotar um animal, você não apenas dá a ele uma segunda chance de ter uma vida feliz e segura, mas também está contribuindo para o resgate de um ser vulnerável. Cada adoção responsável significa uma vida salva e um animal a menos sofrendo nas ruas ou abrigos superlotados.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end experience section -->

  <!-- category section -->

  <section class="category_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Sobre Nós
        </h2>
      </div>
            <p> 
              Somos uma iniciativa com objetivo de facilitar a conexão entre animais em busca de um lar e pessoas que desejam adotar, queremos ser o elo que une corações e transforma vidas, proporcionando um futuro melhor para os bichinhos e suas novas famílias.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end category section -->

  <!-- freelance section -->

  <section class="freelance_section ">
    <div id="accordion">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 offset-md-1">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  Propósito SOS PETS
                </h2>
              </div>
              <div class="tab_container">
                <div class="t-link-box" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <div class="img-box">
                    <img src="images/f1.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      Missão
                    </h5>
                    <h3>
                      Facilitar a conexão entre animais em busca de um lar e pessoas que desejam adotar.
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <div class="img-box">
                    <img src="images/f2.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      Visão
                    <h3>
                      Almejamos ser referencia no ABC na promoção de adoção responsável e no apaio a causa animal
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <div class="img-box">
                    <img src="images/f3.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      Valores
                    </h5>
                    <h3>
                      Paixão pelos pets; Respeito Mútuo; Reconhecimento e Premiação; Encantamento dos Clientes; Servir com Prazer.
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="img-box">
                <img src="./images/Missao.gif" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="img-box">
                <img src="./images/Visao.gif" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="img-box">
                <img src="./images/valores.gif" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end freelance section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-10 mx-auto">
          <div class="heading_container">
            <h2>
              Dúvidas frequentes
            </h2>
          </div>
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="detail-box">
                  <h4>
                    O que os pets nos ensinam?
                  </h4>
                  <p>
                    Enquanto os humanos ajudam seus melhores amigos pets a caminhar, fazer suas necessidades fisiológicas em locais apropriados e brincar, estes ensinam muito sobre lealdade, companheirismo e afeto.
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h4>
                    Qual a importância de ter um pet?
                  </h4>
                  <p>
                    Estudos indicam que ter um cachorro, um gato, ou qualquer outro animalzinho, contribui para uma melhora psicológica e emocional da pessoa, resultando em uma diminuição na pressão arterial e consequente risco de desenvolver uma doença cardíaca, além da melhora na qualidade do sono e na redução do estresse
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h4>
                    Qual a importância de adotar um pet?
                  </h4>
                  <p>
                    Ao adotar um animal, você não apenas dá a ele uma segunda chance de ter uma vida feliz e segura, mas também está contribuindo para o resgate de um ser vulnerável. Cada adoção responsável significa uma vida salva e um animal a menos sofrendo nas ruas ou abrigos superlotados.
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->



  <!-- info section -->

  <section class="info_section ">
    <div class="info_container layout_padding-top">
      <div class="container">
        <div class="info_top">
          <div class="info_logo">
            <img src="images/logo.png" alt="" />
            <span>
              SOS Pets
            </span>
          </div>
          <div class="social_box">
            Instagram dos Participantes
            <a href="https://www.instagram.com/danconsolii/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="https://www.instagram.com/kauan_zinho__/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="https://www.instagram.com/yurirodello/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="https://www.instagram.com/gabriell_f1/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="https://www.instagram.com/gabriell_f1/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="https://www.instagram.com/biamelo0_/" target="_blank">
              <img src="images/instagram.png" alt="">
            </a>
          </div>
        </div>

        
        <div class="row">
          <div class="col-lg-9 col-md-10 mx-auto">
            <div class="info_contact layout_padding2">
              <div class="row">
                <div class="col-md-4">
                  <div href="#" class="link-box">
                    <div class="img-box">
                      <img src="images/mail.png" alt="">
                    </div>
                    <div class="detail-box">
                      <h6>
                        ouvidoria@fsa.br
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div href="#" class="link-box">
                    <div class="img-box">
                      <img src="images/call.png" alt="">
                    </div>
                    <div class="detail-box">
                      <h6>
                        Tel +55 11 4979-3300
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end info section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>


</body>
</body>

</html>