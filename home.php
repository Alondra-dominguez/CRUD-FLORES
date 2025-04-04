<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería - Home</title>
    <link rel="stylesheet" href="css/home.css">
    <style>
        /* Agregar estilo para la tabla */
        table.pedido-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.pedido-table th, table.pedido-table td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table.pedido-table th {
            background-color: #f2f2f2;
        }

        /* Estilos para los botones */
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
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
                    <th>Tipo</th>
                    <th>Color</th>
                    <th>Cantidad</th>
                    <th>Envase</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaPedidos">
                <!-- Pedidos cargados dinámicamente desde Firebase -->
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

    <!-- ... Tu HTML del principio sigue igual ... -->

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

        <button type="submit" id="submitBtn">Registrar Pedido</button>
    </form>
    <span class="close" onclick="document.getElementById('registroPedido').style.display='none'">❌</span>
</div>

<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
  import { getFirestore, collection, addDoc, getDocs, doc, deleteDoc, getDoc, updateDoc } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-firestore.js";

  const firebaseConfig = {
    apiKey: "AIzaSyAg6SLXiT59Q85t5_5TV4cRrEfzkSaYntk",
    authDomain: "floralo-d5111.firebaseapp.com",
    projectId: "floralo-d5111",
    storageBucket: "floralo-d5111.appspot.com",
    messagingSenderId: "378738233804",
    appId: "1:378738233804:web:f68d4e7734acdde05f8d69",
    measurementId: "G-7QDG5HJ2G0"
  };

  const app = initializeApp(firebaseConfig);
  const db = getFirestore(app);
  const form = document.querySelector('#registroPedido form');
  const submitBtn = document.getElementById('submitBtn');

  let modoEditar = false;
  let idEditar = null;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const tipoFlores = document.getElementById('tipoFlores').value;
    const colorFlores = document.getElementById('colorFlores').value;
    const cantidadFlores = parseInt(document.getElementById('cantidadFlores').value);
    const tipoEnvase = document.getElementById('tipoEnvase').value;

    if (modoEditar && idEditar) {
      // Editar pedido existente
      try {
        const pedidoRef = doc(db, "pedidos", idEditar);
        await updateDoc(pedidoRef, {
          tipoFlores,
          colorFlores,
          cantidadFlores,
          tipoEnvase
        });

        alert("✅ Pedido actualizado con éxito.");
        modoEditar = false;
        idEditar = null;
        submitBtn.textContent = "Registrar Pedido";
        form.reset();
        document.getElementById('registroPedido').style.display = 'none';
        cargarPedidos();
      } catch (error) {
        console.error("❌ Error al actualizar pedido:", error);
        alert("❌ No se pudo actualizar el pedido.");
      }
    } else {
      // Agregar nuevo pedido
      try {
        await addDoc(collection(db, "pedidos"), {
          tipoFlores,
          colorFlores,
          cantidadFlores,
          tipoEnvase,
          fecha: new Date()
        });

        alert("✅ Pedido registrado con éxito.");
        form.reset();
        document.getElementById('registroPedido').style.display = 'none';
        cargarPedidos();
      } catch (error) {
        console.error("❌ Error al registrar pedido:", error);
        alert("❌ Ocurrió un error al guardar el pedido.");
      }
    }
  });

  async function cargarPedidos() {
    try {
      const tbody = document.querySelector('.pedido-table tbody');
      tbody.innerHTML = "";

      const querySnapshot = await getDocs(collection(db, "pedidos"));
      let i = 1;
      querySnapshot.forEach((docSnap) => {
        const data = docSnap.data();
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>#${i.toString().padStart(3, '0')}</td>
          <td>${data.tipoFlores}</td>
          <td>${data.colorFlores}</td>
          <td>${data.cantidadFlores}</td>
          <td>${data.tipoEnvase}</td>
          <td>
            <button class="btn-edit" onclick="editarPedido('${docSnap.id}')">✏️ Editar</button>
            <button class="btn-delete" onclick="eliminarPedido('${docSnap.id}')">❌ Eliminar</button>
          </td>
        `;
        tbody.appendChild(tr);
        i++;
      });
    } catch (error) {
      console.error("Error al cargar pedidos:", error);
    }
  }

  // Funciones globales
  window.eliminarPedido = async function (id) {
    try {
      await deleteDoc(doc(db, "pedidos", id));
      alert("✅ Pedido eliminado con éxito.");
      cargarPedidos();
    } catch (error) {
      console.error("❌ Error al eliminar pedido:", error);
      alert("❌ No se pudo eliminar el pedido.");
    }
  };

  window.editarPedido = async function (id) {
    try {
      const pedidoDoc = await getDoc(doc(db, "pedidos", id));

      if (pedidoDoc.exists()) {
        const data = pedidoDoc.data();
        document.getElementById('tipoFlores').value = data.tipoFlores;
        document.getElementById('colorFlores').value = data.colorFlores;
        document.getElementById('cantidadFlores').value = data.cantidadFlores;
        document.getElementById('tipoEnvase').value = data.tipoEnvase;

        // Cambiar estado a modo edición
        modoEditar = true;
        idEditar = id;
        submitBtn.textContent = "Editar Pedido";

        document.getElementById('registroPedido').style.display = 'block';
      } else {
        alert("❌ El pedido no existe.");
      }
    } catch (error) {
      console.error("❌ Error al cargar el pedido para editar:", error);
    }
  };

  cargarPedidos();
</script>


</body>
</html>
