<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .profile-pic {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin: 0 auto 10px;
        }
        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .camera-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: purple;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .user-info {
            margin-bottom: 20px;
        }
        .edit-btn {
            background: purple;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-pic">
            <img src="https://via.placeholder.com/100" alt="Foto de perfil">
            <div class="camera-icon">📷</div>
        </div>
        <div class="user-info">
            <h2>Nombre Completo</h2>
            <p>correo@ejemplo.com</p>
        </div>
        <button class="edit-btn">Editar perfil</button>
    </div>
</body>
</html>

