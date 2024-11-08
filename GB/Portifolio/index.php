<?php
session_start();
include_once 'verify_emp.php';
include_once '../php/access_filter.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Gestão de Empresa</title>
</head>

<body>

<style>
 /* Estilização geral */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #f0f2f5;
    color: #333;
}

/* Estilização do header */
header {
    position: relative;
    height: 100vh;
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow: hidden;
}

header .info-text {
    position: relative;
    z-index: 2;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
}

header h1 {
    font-size: 4rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

header h3 {
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
    font-weight: 300;
}

header a.scroll {
    display: inline-block;
    margin-top: 2rem;
    font-size: 2.5rem;
    color: #fff;
    text-decoration: none;
    transition: transform 0.3s;
}

header a.scroll:hover {
    transform: translateY(10px);
}

/* Seção de funcionalidades */
#features {
    padding: 4rem 2rem;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 3rem auto;
    width: 90%;
    max-width: 1200px;
}

#features .header {
    text-align: center;
    margin-bottom: 2.5rem;
}

#features h1 {
    font-size: 2.8rem;
    color: #333;
    font-weight: 600;
}

.feature-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

/* Mensagem de saudação */
.conect {
    display: block;
    font-size: 1.5rem;
    text-align: center;
    margin-top: 1rem;
    color: #444;
    font-weight: 500;
}

/* Botão de logout */
button.logoutbttn {
    display: block;
    margin: 2rem auto;
    padding: 0.8rem 2rem;
    font-size: 1rem;
    color: #fff;
    background-color: #ff4b5c;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

button.logoutbttn:hover {
    background-color: #ff2c3c;
    transform: scale(1.05);
}

button.logoutbttn a {
    color: #fff;
    text-decoration: none;
}

/* Botão de rolar para cima */
button.scroll-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    padding: 0.6rem;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 50%;
    font-size: 2rem;
    cursor: pointer;
    display: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s, transform 0.3s;
}

button.scroll-top:hover {
    background-color: #555;
    transform: translateY(-5px);
}

/* Partículas */
#particles {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
    top: 0;
    left: 0;
}

/* Responsividade */
@media (max-width: 768px) {
    header h1 {
        font-size: 3rem;
    }

    header h3 {
        font-size: 1.4rem;
    }

    button.logoutbttn {
        font-size: 0.9rem;
    }
}

</style>

    <header>
        
        <div id="particles"></div>
        <div class="info-text">
            <h1>Bem vindo!</h1>
            <h3> Sistema de Gestão Online</h3>
            <a href="#about" class="scroll"><i class='bx bxs-down-arrow'></i></a>
        </div>
    </header>

    

    <section id="features">
        <div class="header">
            <h1>Acessos</h1>
      
        </div>
        <div class="feature-cards">
        </div>

        <?php


if (isset($_SESSION["id_user"])) {
    echo '<h1 class="conect">Olá, ' . $_SESSION["nome_completo"] . '</h1>';

    FiltroAccss();

} else {
    echo '<a class="conect" href="../php/login.php">Conecte-se</a>';
}
?>

<br><br><br>
       <button class="logoutbttn "><a href="#" class="conect" onclick="confirmLogout()"> Logout  </a></button> 
    </section>

    <button class="scroll-top" onclick="scrollToTop()">
        <i class='bx bxs-up-arrow'></i>
    </button>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
<script>
function confirmLogout() {
    var confirmLogout = confirm("Realmente que Sair dessa Pagina?");
    if (confirmLogout) {
        window.location.href = '../php/logout_profile.php';
    }
}
</script>