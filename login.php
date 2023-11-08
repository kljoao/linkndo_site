<?php
  include('protection/conection.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/login.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <title>Oficial Linkndo</title>
  </head>
  <body>

  <?php
  if(isset($_POST['submit_register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cellphone = $_POST['mobile_number'];
    $password = $_POST['password'];

    $result = mysqli_query($mysqli, "INSERT INTO users(user_name,email,cellphone,user_password) VALUES
    ('$name','$email','$cellphone','$password')");

    if($result){
      header("Location: aprovado.html");
    }
  }
  ?>

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <a href=""><div><i class="fa fa-google"></i> Login with google.</div></a>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="E-mail" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
          </form>
          <form method="POST" action="" class="sign-up-form" id="submitForm">
            <h2 class="title">Sign up</h2>
            <a href=""><div><i class="fa fa-google"></i> Register with google.</div></a>

            <div class="input-field">
              <i class="name-color fas fa-user"></i>
              <input type="text" name="name" placeholder="Name*" minlength="8" maxlength="60" id="name" required/>
            </div>

            <p class="checkNumber">Invalid mobile number*</p>
            <div class="input-field">
              <input type="text" name="mobile_number" class="mobile-number" id="phone" minlength="14" maxlength="15"/>
            </div>

            <p class="invalidEmail">Invalid E-mail*</p>
            <div class="input-field">
              <i class="emailColor fas fa-envelope"></i>
              <input type="text" name="email" placeholder="Email*" onblur="validacaoEmail(email)"  maxlength="60" class="emailInput">
            </div>

            <p class="duoemailcheck">Emails don't match*</p>
            <div class="input-field">
              <i class="confirmColor fas fa-envelope"></i>
              <input type="email" placeholder="Confirm email*" required class="email-confirm"/>
            </div>

            <p class="passwordCheck">Minimum 8 digits, one special character and <br>number*</p>
            <div class="input-field">
              <i class="passwordColor fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password*" required class="password" minlength="8" onblur="validarSenha(senha)"/>
            </div>

            <p class="confirmPasswordCheck">Password don't match</p>
            <div class="input-field">
              <i class="confirmPassColor fas fa-lock"></i>
              <input type="password" name="passwordConfirm" placeholder="Confirm Password*" required minlength="8" class="confirmaSenha" onkeyup="validarConfirmaSenha(passwordConfirm)"/>
            </div>

            <input type="submit" name="submit_register" class="btn" value="Sign up" onclick="cadastro()"/>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Are you new?</h3>
            <p>
              Register quickly, just click in the button. 
              It's simple and fast.
            </p>
            <button class="btn transparent" id="sign-up-btn">Sign up</button>
          </div>
          <img src="assets/img/cadastro.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Already register?</h3>
            <p>
              Access your account quickly and easily by clicking the button below. 
            </p>
            <button class="btn transparent" id="sign-in-btn">Sign in</button>
          </div>
          <img src="assets/img/login.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script>
      validName = false
      validNumber = false
      validEmail = false
      validConfirmEmail = false
      validPassword = false
      validConfirmPassword = false

      //BlOQUEIO CARACTERES ESPECIAIS E NUMEROS - INPUTNOME
        const nameInput = document.querySelector("#name");

        nameInput.addEventListener("keypress", function(e) {
            if(!checkChar(e)) {
              e.preventDefault();
          }
        });
        function checkChar(e) {
            var char = String.fromCharCode(e.keyCode);
            var pattern = '[a-zA-Z ^~´`óòõãáàéèê]';
            if (char.match(pattern)) {
            return true;
          }
        }
        //BlOQUEIO CARACTERES ESPECIAIS E NUMEROS - INPUTNOME

        //Validador Nome
        const colorName = document.querySelector('.name-color');

        nameInput.addEventListener('keyup', () => {
          if(nameInput.value.length < 7){
            colorName.setAttribute('style', 'color: red;')
            nameInput.setAttribute('style', 'color: red;')
            validName = false
          }
          else{
            colorName.setAttribute('style', 'color: green;')
            nameInput.setAttribute('style', 'color: green;')
            validName = true
          }
        })
        //Validador Nome

        // ALTERAR FORMULAS
        const loginBtn = document.querySelector("#sign-in-btn");
        const cadastroBtn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        cadastroBtn.addEventListener("click", () => {
          container.classList.add("sign-up-mode");
        });

        loginBtn.addEventListener("click", () => {
          container.classList.remove("sign-up-mode");
        });
        // ALTERAR FORMULAS

        //Validador Confirma E-mail
        const emailInput = document.querySelector('.emailInput');
        const confirmaIcon = document.querySelector('.confirmColor');

        const emailColor = document.querySelector('.emailColor');
        const confirmaInput = document.querySelector('.email-confirm')

        const checkEmail = document.querySelector('.duoemailcheck');

        confirmaInput.addEventListener('blur', () => {
          if(confirmaInput.value != emailInput.value){
            emailColor.setAttribute('style', 'color: red;')
            emailInput.setAttribute('style', 'color: red;')
            confirmaIcon.setAttribute('style', 'color: red;')
            confirmaInput.setAttribute('style', 'color: red;')

            checkEmail.setAttribute('style', 'display: block;')
            validConfirmEmail = false
          }
          else if((confirmaInput.value && emailInput.value) == 0){
            emailColor.setAttribute('style', 'color: red;')
            emailInput.setAttribute('style', 'color: red;')
            confirmaIcon.setAttribute('style', 'color: red;')
            confirmaInput.setAttribute('style', 'color: red;')

            checkEmail.setAttribute('style', 'display: block;')
            validConfirmEmail = false
          }
          else{
            emailColor.setAttribute('style', 'color: green;')
            emailInput.setAttribute('style', 'color: black;')
            confirmaIcon.setAttribute('style', 'color: green;')
            confirmaInput.setAttribute('style', 'color: black;')

            checkEmail.setAttribute('style', 'display: none;')
            validConfirmEmail = true
          }
        })
        //Validador Confirma E-mail

        //Validador E-MAIL
        const emailInvalido = document.querySelector('.invalidEmail')
        function validacaoEmail(field) {
          usuario = field.value.substring(0, field.value.indexOf("@"));
          dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
          if ((usuario.length >=3) &&
              (dominio.length >=3) &&
              (usuario.search("@")==-1) &&
              (dominio.search("@")==-1) &&
              (usuario.search(" ")==-1) &&
              (dominio.search(" ")==-1) &&
              (dominio.search(".")!=-1) &&
              (dominio.indexOf(".") >=1)&&
              (dominio.lastIndexOf(".") < dominio.length - 1)) {
                emailInvalido.setAttribute('style', 'display: none;')
                emailColor.setAttribute('style', 'color: green;')
                emailInput.setAttribute('style', 'color: black;')
                validEmail = true
          }
          else{
            emailInvalido.setAttribute('style', 'display: block;')
            emailColor.setAttribute('style', 'color: red;')
            emailInput.setAttribute('style', 'color: red;')
            validEmail = false
          }
          }
        //Validador E-MAIL

        //Validador SENHA
        const senhaInput = document.querySelector('.password');
        const senhaColor = document.querySelector('.passwordColor');
        const senhaCheck = document.querySelector('.passwordCheck');

        function validarSenha(input) {
          var senha = input.value;
          
          // Verificar o comprimento mínimo da senha
          if (senha.length < 8) {
            senhaCheck.setAttribute('style', 'display: block;')
            senhaColor.setAttribute('style', 'color: red;')
            senhaInput.setAttribute('style', 'color: red;')
            validPassword = false
              return;
          }
          
          // Verificar se há pelo menos um caractere especial
          var caractereEspecial = /[\W_]/;  // Regex para verificar caractere especial
          if (!caractereEspecial.test(senha)) {
            senhaCheck.setAttribute('style', 'display: block;')
            senhaColor.setAttribute('style', 'color: red;')
            senhaInput.setAttribute('style', 'color: red;')
            validPassword = false
              return;
          }
          
          // Verificar se há pelo menos um número
          var numero = /\d/;  // Regex para verificar número
          if (!numero.test(senha)) {
            senhaCheck.setAttribute('style', 'display: block;')
            senhaColor.setAttribute('style', 'color: red;')
            senhaInput.setAttribute('style', 'color: red;')
            validPassword = false
              return;
          }

          senhaCheck.setAttribute('style', 'display: none;')
          senhaColor.setAttribute('style', 'color: green;')
          senhaInput.setAttribute('style', 'color: black;')
          validPassword = true
        }
        //Validador SENHA

        //Validador ConfirmaSENHA
        const confirmaSenhaInput = document.querySelector('.confirmaSenha');
        const confirmPassColor = document.querySelector('.confirmPassColor');
        const confirmPasswordCheck = document.querySelector('.confirmPasswordCheck');

        function validarConfirmaSenha(input){

          if(confirmaSenhaInput.value != senhaInput.value){
            confirmPasswordCheck.setAttribute('style', 'display: block;')
            confirmPassColor.setAttribute('style', 'color: red;')
            confirmaSenhaInput.setAttribute('style', 'color: red;')
            validConfirmPassword = false
          }
          else if((confirmaSenha.value && senhaInput.value) == 0){
            confirmPasswordCheck.setAttribute('style', 'display: block;')
            confirmPassColor.setAttribute('style', 'color: red;')
            confirmaSenhaInput.setAttribute('style', 'color: red;')
            validConfirmPassword = false
          }
          else{
            confirmPasswordCheck.setAttribute('style', 'display: none;')
            confirmPassColor.setAttribute('style', 'color: green;')
            confirmaSenhaInput.setAttribute('style', 'color: black;')
            validConfirmPassword = true
          }
        }
        //Validador ConfirmaSENHA

        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
          utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });

  
        if((validName && validNumber && validEmail && validConfirmEmail && validPassword && validConfirmPassword) == true){
          document.getElementById("submitForm").submit();
        }
        else{
        //   Swal.fire({
        //   icon: "error",
        //   title: "Oops...",
        //   text: "Something went wrong! Check the informations and try again",
        // });
        }

    </script>
  </body>
</html>