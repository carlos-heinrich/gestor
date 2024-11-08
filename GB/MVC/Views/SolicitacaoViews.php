

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/respostasolicitacao.css">
    <title>GESTÃO DE BIKES</title>
</head>

<body>

    <div class="comeco">

    <div class="retangulo"></div>
    <div class="sidebar">
        <button onclick="window.location.href='../../portifolio/index.php'">Home</button>
        <button onclick="window.location.href='../../php/listar_empresas.php'">Empresas Cadastradas</button>
        
    </div>
        <!DOCTYPE html>
<html>
<head>
    <title>Criar Nova Solicitação</title>
</head>
<body>
<div class="div">
<form action="" method="post">
    <form action="../../MVC/public/Solicitacao/index.php?action=create" method="POST">
            <label for="solicitante">Solicitante:</label>
            <input type="text" id="solicitante" name="solicitante" required><br>
            <label for="responsavel">Responsável:</label>
            <input type="text" id="responsavel" name="responsavel" required><br>
            <label for="pedido">Pedido:</label>
            <input type="text" id="pedido" name="pedido" required><br>
            <input type="submit" value="Criar">
        </form>
    <a href="index.php">Voltar</a>
</form>
 </body>
 </html>
</div>
       

        <div class="texto-centralizado">
            <h2>Solicitações</h2>
        </div>


        <div class="rodape">

<a class="entra" href="../../../GB/Portifolio/index.php">Voltar</a>
</div>

        <style>
            .div{
                margin-left:39%;
            }
            h2 {
            margin-left:288%;
            margin-top:70%;
            }
            .rodape{

margin-top: 198px;
background-color: #001e27; 
padding: 40px 0; 
text-align: center; 
}

.entra {
    text-decoration: none;
    background-color: transparent;
    color: rgb(255, 255, 255);
    border: 1px solid rgb(255, 255, 255);
    border-radius: 30px;
    padding: 15px 40px;
    font-size: 15px;
    display: inline-block;
    margin: 11px 400px;
    transition: background-color 0.3s, color 0.3s, transform 0.3s; /* Adicionando uma transição suave para o tamanho */
    font-family: Arial, Helvetica, sans-serif;
  }
  
  .entra:hover {
    transform: scale(1.1); /* Aumentando o tamanho em 10% ao passar o mouse */
  }
  .sidebar {
    position: absolute;
    top: 200px; /* Ajuste para não sobrepor a .comeco */
    left: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .sidebar button {
    width: 175px;
    padding: 12px;
    margin: 10px 0;
    background-color: #1F9EA8 ;
    color: white;
    border: none;
    cursor: pointer;
    text-align: center;
    border-radius: 10px;
    font-weight: bold;

  }
  
  .sidebar button:hover {
    background-color: yellowgreen;
  
  }
  
        </style>


        