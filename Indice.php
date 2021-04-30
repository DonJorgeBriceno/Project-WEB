<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="AlertifyJS/alertify.min.js"></script>
     <link rel="stylesheet" href="AlertifyJS/css/alertify.min.css">
    <link rel="stylesheet" href="style.css">
    <h1 id="Titulo">Proyecto WEB</h1>
</head>


<body id="Bodytable">
    <script src="https://www.google.com/recaptcha/api.js?render=6LeYKLsaAAAAAFkq_Nw1GUMP37wp1tfLH7UAk6gs"></script>

    <table class="table table-responsive">
        <tbody >
        
            <td>
            <!-- Start Card para el login y registro de Tejedores -->
                 <div class="card" style="width: 27rem;">
                      <img class="card-img-top" src="Img/Tejedor.png" alt="Card image cap">
                      <div class="card-body">
                    <h5 class="card-title">Tejedores</h5>
                    <p class="card-text">Los artesanos téxtiles como tú forman parte del folklore de las culturas y nos inspiraran</p>
                    <form action="form-post.php?id=1" id="evaluar" method="post" >
                    <input type="submit" class="btn btn-primary" value="Empezar">
                    </form>
                  </div>
                </div> 
            <!-- End Card para el login y registro de Tejedores -->
            </td>
            <td>
                <!-- Start Card para el login y registro de Consumidores -->
                 <div class="card" style="width: 27rem;">
                      <img class="card-img-top" src="Img/Consumidor.jpg" alt="Card image cap">
                      <div class="card-body">
                    <h5 class="card-title">Consumidores</h5>
                    <p class="card-text">La demanda de tejidos ha aumentado, ¡date prisa!, no te quedes sin tus compras</p>
                    <form action="form-post.php?id=2" id="evaluar2" method="post" >
                    <input type="submit" class="btn btn-primary" value="¡Hora de negociar!">
                    </form>
                  </div>
                </div> 
            <!-- End Card para el login y registro de Consumidores -->
            </td>
            <td>
                <!-- Start Card para el login y registro de Administradores -->
                 <div class="card" style="width: 27rem;">
                      <img class="card-img-top" src="Img/Administracion.png" alt="Card image cap">
                      <div class="card-body">
                    <h5 class="card-title">Administrador</h5>
                    <p class="card-text">En esta sesión podrás gestionar el proyecto, incluyendo los participantes</p>
                    <a onclick="javascript:showModal3();" class="btn btn-primary">Echar un vistazo</a>
                  </div>
                </div> 
            <!-- End Card para el login y registro de Administradores -->
            </td>
        </tbody>
    </table>
    
       <script>
    $('#evaluar').submit(function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeYKLsaAAAAAFkq_Nw1GUMP37wp1tfLH7UAk6gs', {action: 'registro'}).then(function(token) {
                 $('#evaluar').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#evaluar').prepend('<input type="hidden" name="action" value="registro">');
                $('#evaluar').unbind('submit').submit();
            });;
        });
  });
     $('#evaluar2').submit(function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeYKLsaAAAAAFkq_Nw1GUMP37wp1tfLH7UAk6gs', {action: 'registro'}).then(function(token) {
                 $('#evaluar2').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#evaluar2').prepend('<input type="hidden" name="action" value="registro">');
                $('#evaluar2').unbind('submit').submit();
            });;
        });
  });
  </script>
    
    
    
    <!-- Modal para el login y registro de Tejedores -->
    <div id="openModal" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close" onclick="javascript:CloseModal();">X</a>
            <h2>Bienvenido Tejedor</h2>
            <p>Los artesanos téxtiles como tú forman parte del folklore de las culturas y nos
                inspiraran con grandes obras de arte tradicionalmente lugareñas
            </p>
            <h5>Ingresa aquí</h5>
             <form action="Tejedor.php" method="POST">
                <input type="text" name="userT" class="form-control campoRegistro" placeholder="Tu mail Tejedor">
                <input type="password" name="keyT" class="form-control campoRegistro">
                 
                <input type="submit" name="Ingreso" value="Entrar" id="fromIngresoT">
                <br><br>
                <a href="#" onclick="ocultarDiv();">¿Aún no te has registrado ?</a>
                <br>
                <section id="ocultarDiv" style="display: none;">
                    <input type="text" name="nameT" id="nameT" class="form-control R"
                        placeholder="Primer nombre y Apellido" required>
                    <input type="text" name="mailT" id="EmailT" class="form-control R Email"
                        placeholder="Aquí va tu mail" required>
                    <input type="text" name="direT" id="direT" class="form-control R" placeholder="Y aquí tu dirección"
                        required>
                    <input type="password" name="passT" class="form-control R" placeholder="Ahora asigna una contraseña"
                        required>
                    <input type="submit" name="Registro" class="validadorEmail" value="Registrarte">

                </section>
            </form>
            <script>
                //jQuery para validar los campos vacios únicamente al registrarse
                $("#fromIngresoT").click(function (i) {
                    $(".R").removeAttr('required');
                });
            </script>

        </div>
    </div>
    <!-- Modal para el login y registro de Consumidores -->
    <div id="openModal2" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close" onclick="javascript:CloseModal2();">X</a>
            <h2>Bienvenido Consumidor</h2>
            <p>La demanda de tejidos ha aumentado, ¡date prisa!, no te quedes sin tus compras.
            </p>
            <h5>Ingresa aquí</h5>
            <form action="Consumidor.php" method="POST">
                <input type="text" name="userC" class="form-control" placeholder="Tu mail Consumidor">
                <input type="password" class="form-control" name="keyC">
                <input type="submit" name="Ingreso" value="Entrar" id="fromIngresoC">
                <br><br>
                <a href="#" onclick="ocultarDiv2();">¿Aún no te has registrado ?</a>
                <br>
                <section id="ocultarDiv2" style="display: none;">
                    <input type="text" name="nameC" id="nameC" class="form-control T"
                        placeholder="Primer nombre y Apellido" required>
                    <input type="text" name="mailC" id="mailC" class="form-control T Email"
                        placeholder="Aquí va tu mail" required>
                    <input type="text" name="direC" id="direC" class="form-control T" placeholder="Y aquí tu dirección"
                        required>
                    <input type="password" name="passC" class="form-control T" placeholder="Ahora asigna una contraseña"
                        required>
                    <input type="submit" name="Registro" class="validadorEmail"
                        onclick="javascript:validadorUser('Consumidor');" value="Registrarte">
                </section>
            </form>
            <script>
                //jQuery para validar los campos vacios únicamente al registrarse
                $("#fromIngresoC").click(function (i) {
                    $(".T").removeAttr('required');
                });
            </script>
        </div>
    </div>
    <div id="openModal3" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close" onclick="javascript:CloseModal3();">X</a>
            <h2>Bienvenido Administrador</h2>
            <p>Esta es tu sesión para gestionar el proyecto
            </p>
            <h3>Ingresa aquí</h3>
            <form action="Administrador.php" method="POST">
                <input type="text" name="userA" class="form-control" placeholder="Tu usuario Admin">
                <input type="password" class="form-control" name="keyA">
                <input type="submit" name="Ingreso" value="Entrar">

            </form>
        </div>
    </div>
    <script src="jQuery/jquery-3.6.0.min.js"></script>
    
  <?php
error_reporting(0);
$id=$_GET['id'];
    if($id==1){
         echo  '<script type="text/javascript">'
               , 'showModal();'
               , '</script>';
    }if($id==2){
         echo  '<script type="text/javascript">'
               , 'showModal2();'
               , '</script>';
        
    }
?>

   
   
    <script>
        //jQuery para validar correo, la función se ejecuta siempre que el user haga inputs sobre el campo #Email
        var auxColor;
        $('.Email').keyup(function (e) {
            var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var EmailId = this.value;
            if (emailRegex.test(EmailId)) {
                auxColor = true;
                this.style.backgroundColor = "LightBlue";
            }

            else {
                auxColor = false;
                this.style.backgroundColor = "LightPink";
            }

        });
        $(".validadorEmail").click(function (i) {
            if (!auxColor) {
                i.preventDefault();
            }
        });

    </script>
    
</body>

</html>