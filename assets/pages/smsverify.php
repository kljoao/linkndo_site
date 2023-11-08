<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            border: 1px solid blue;
            padding: 20px;
            background-color: white;
        }
        .form-container input[type="text"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <p>Pressione o botão abaixo para solicitar um código de verificação por SMS. Uma vez que você receba 7798, insira a mensagem no seu telefone.</p>
        <a href="#">Não é você? Sair</a>
        <input type="text" id="code" name="code" placeholder="e.g. 1234567">
        <input type="checkbox" id="remember" name="remember" value="remember">
        <label for="remember">Lembrar por 30 dias</label><br>
        <button onclick="sendSMSCode()">Enviar código SMS</button>
        <button onclick="verify()">Verificar</button>
    </div>
    <script>
        function sendSMSCode() {
            // Implemente a lógica para enviar o código SMS aqui
            alert("Código SMS enviado!");
        }
        function verify() {
            // Implemente a lógica para verificar o código aqui
            alert("Código verificado!");
        }
    </script>
</body>
</html>