<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería - Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <nav class="navbar">
        <span class="menu-icon">☰</span>
        <ul class="nav-links">
            <li><a href="pedidos.php">Pedidos</a></li>
            <li><a href="canceados.php">Pedidos Cancelados</a></li>
        </ul>
        <div class="nav-icons">
            <span class="profile-icon">👤</span>
            <span class="logout-icon">🚪</span>
        </div>
    </nav>

    <div class="content">
        <h1>Bienvenido a Flor Alondra</h1>
        <p>Administra tus pedidos de flores fácilmente.</p>

        <!-- Tabla de pedidos -->
        <table class="pedido-table">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nombre del Pedido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#001</td>
                    <td>Ramo de Rosas</td>
                    <td>
                        <button class="btn-edit">✏️ Editar</button>
                        <button class="btn-delete">❌ Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>#002</td>
                    <td>Caja de Tulipanes</td>
                    <td>
                        <button class="btn-edit">✏️ Editar</button>
                        <button class="btn-delete">❌ Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Iconos flotantes -->
<div class="fab">
    <!-- Icono de chat flotante -->
    <div class="chat-icon" onclick="openChat()">
        💬
    </div>

    <!-- Botón para agregar nuevo pedido -->
    <button class="fab-btn" onclick="document.getElementById('registroPedido').style.display='block'">+</button>
</div>


    <!-- Formulario de registro de nuevo pedido -->
    <div id="registroPedido" class="registro-pedido">
        <form>
            <label for="tipoFlores">Tipo de Flores:</label>
            <input type="text" id="tipoFlores" placeholder="Ej. Rosas, Tulipanes">

            <label for="colorFlores">Color de Flores:</label>
            <input type="text" id="colorFlores" placeholder="Ej. Rojo, Blanco">

            <label for="cantidadFlores">Cantidad de Flores:</label>
            <input type="number" id="cantidadFlores" placeholder="Ej. 10">

            <label for="tipoEnvase">Caja o Ramo:</label>
            <select id="tipoEnvase">
                <option value="caja">Caja</option>
                <option value="ramo">Ramo</option>
            </select>

            <button type="submit">Registrar Pedido</button>
        </form>
        <span class="close" onclick="document.getElementById('registroPedido').style.display='none'">❌</span>
    </div>

    <!-- API de Tawk.to -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/your_tawk_to_script_id/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

    <script>
        // Cerrar el formulario de registro
        function closeRegistro() {
            document.getElementById('registroPedido').style.display = 'none';
        }

        // Función para abrir el chat
        function openChat() {
            Tawk_API.toggle();
        }
    </script>
</body>
</html>
