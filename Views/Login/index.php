<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al Sistema - Arcadia OS</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Assets/css/style.css">
    
    <style>
        /* ESTILOS EXCLUSIVOS PARA EL LOGIN (Sobrescriben o añaden a style.css) */
        body.login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #050505;
            background-image: 
                linear-gradient(rgba(0, 255, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 0, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            margin: 0;
        }
        
        .login-card {
            background: #111;
            border: 2px solid #fff;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            box-shadow: 10px 10px 0px #333;
            position: relative;
        }

        .login-title {
            color: #00ff00;
            font-family: 'Press Start 2P', cursive;
            margin-bottom: 30px;
            font-size: 1.2rem;
            text-transform: uppercase;
            line-height: 1.5;
            text-shadow: 0 0 10px #00ff00;
        }

        .login-input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            background: #000;
            border: 2px solid #555;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            outline: none;
            text-align: center;
        }

        .login-input:focus {
            border-color: #00ff00;
            box-shadow: 0 0 15px rgba(0,255,0,0.3);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: #00ff00;
            color: #000;
            border: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.8rem;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.2s;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #fff;
            transform: scale(1.05);
            box-shadow: 0 0 20px #fff;
        }

        .error-msg {
            color: #ff3333;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.6rem;
            margin-bottom: 20px;
            border: 1px solid #ff3333;
            padding: 10px;
            background: rgba(255, 51, 51, 0.1);
            animation: shake 0.5s;
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
    </style>
</head>
<body class="login-page">

    <div class="login-card">
        <h2 class="login-title">Arcadia OS<br>Security Check</h2>

        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="error-msg">
                <i class="fas fa-exclamation-triangle"></i><br>
                <?php echo $_SESSION['error_login']; ?>
            </div>
            <?php unset($_SESSION['error_login']); ?>
        <?php endif; ?>

        <form action="?c=Login&a=autenticar" method="post">
            <input type="text" name="correo" placeholder="USUARIO / EMAIL" class="login-input" required autocomplete="off">
            
            <input type="password" name="contrasena" placeholder="CLAVE DE ACCESO" class="login-input" required>
            
            <button type="submit" class="btn-login">INSERT COIN</button>
        </form>
        
        <div style="margin-top: 30px; color: #555; font-size: 0.5rem; font-family: monospace;">
            SYSTEM v2.4 // UNAUTHORIZED ACCESS IS PROHIBITED
        </div>
    </div>

</body>
</html>