<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flor Alo</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function mostrarAlerta(mensaje) {
            let alerta = document.getElementById("alerta");
            alerta.innerText = mensaje;
            alerta.style.display = "block";
        }

        function validarRegistro() {
            let nombre = document.getElementById("nombre").value;
            let correo = document.getElementById("correo").value;
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let alerta = document.getElementById("alerta");
            let nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;
            let correoRegex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            
            alerta.style.display = "none";

            if (!nombreRegex.test(nombre)) {
                mostrarAlerta("El nombre solo debe contener letras mayúsculas y minúsculas.");
                return false;
            }
            if (!correoRegex.test(correo)) {
                mostrarAlerta("El correo debe ser válido y no contener caracteres especiales.");
                return false;
            }
            if (!passwordRegex.test(password)) {
                mostrarAlerta("La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas y números.");
                return false;
            }
            if (password !== confirmPassword) {
                mostrarAlerta("Las contraseñas no coinciden.");
                return false;
            }
            return true;
        }
        
        function mostrarRegistro() {
            document.getElementById('login-container').style.display = 'none';
            document.getElementById('registro').style.display = 'block';
        }
    </script>
    <style>
        .alerta {
            display: none;
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container" id="login-container">
        <div class="logo">🌸</div>
        <h2>Bienvenido a Flor Alondra</h2>
        <input type="email" class="input-field" placeholder="Correo electrónico">
        <input type="password" class="input-field" placeholder="Contraseña">
        <button class="btn btn-primary">INICIAR SESIÓN</button>
        <button class="btn btn-secondary" onclick="mostrarRegistro()">REGISTRARTE</button>
    </div>
    
    <div class="login-container" id="registro" style="display: none; margin-top: 20px;">
        <h2>Registro</h2>
        <div id="alerta" class="alerta"></div>
        <input type="text" id="nombre" class="input-field" placeholder="Nombre Completo">
        <input type="email" id="correo" class="input-field" placeholder="Correo electrónico">
        <input type="password" id="password" class="input-field" placeholder="Contraseña">
        <input type="password" id="confirmPassword" class="input-field" placeholder="Confirmar Contraseña">
        <button class="btn btn-primary" onclick="return validarRegistro()">REGISTRAR</button>
    </div>
</body>
</html>