<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/politica.css">
    <title>Níveis de acesso</title>
    <style>
        /* Estilos para o body */
        body {
            background-color: #1f9ea8;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif; /* Fonte padrão para o corpo do texto */
        }

        /* Estilos para a área de cabeçalho */
        .comeco {
            background-color: #001e27;
            height: 180px;
            position: absolute;
            top: 0;
            left: 0;
           margin-left:-2px;
        }

        .rodape{
    margin-top: 50px;
    background-color: #001e27; 
    padding: 40px 0; 
    margin-left:-8px;
    text-align: center; 
    margin:0;
    }


        /* Estilos para o título */
        .titulo {
            color: white;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 28px; /* Ajustando o tamanho do título */
            position: absolute;
            left: 50%; /* Centralizando horizontalmente */
            top: 39%; /* Posicionando no centro verticalmente */
            transform: translate(-50%, -50%); /* Centralizando horizontal e verticalmente */
        }

        /* Estilos para a logo */
        .logo {
            position: absolute;
            top: 50%; /* Posicionando no centro verticalmente */
            left: 20px;
            transform: translateY(-50%); /* Centralizando verticalmente */
            width: 150px; /* Ajustando o tamanho da logo */
        }

        /* Estilos para o conteúdo da política de privacidade */
        .conteudo {
            background-color: #fff;
            max-width: 800px;
            margin: 200px auto 20px auto; /* Espaçamento para o conteúdo */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        /* Estilos para os títulos dos parágrafos */
        .conteudo h2 {
            font-size: 24px;
            margin-top: 20px;
        }

        /* Estilos para os parágrafos */
        .conteudo p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        @media screen and (max-width: 768px) {
  /* Oculta o texto do banner em telas menores que 768px */
  .titulo {
      display: none;
  }
  .logo {
      margin-left:33%;
      width:185px;
  }
}

    </style>
</head>

<body>

    <div class="comeco">
   
    </div>

    <div class="conteudo">
        <h2>CEO</h2>
        <p><strong>Sua númeração é 1.</strong> <br>
            O nível de permissão permitirá que esse usuário entre em todas as páginas do programa.<br>
        </p>


        <h2>GERENTE GERAL</h2>
        <p><strong>Sua númeração é 2.</strong> <br>
            O nível de permissão permitirá que esse usuário entre nas seguintes páginas: <br>

        <table>
            <li>Cadastrar Produtos</li>
            <li>Controle Estoque</li>
            <li>Controle Fiscal</li>
            <li> Controle de Frotas</li>
            <li>Realizar solicitações</li>
            <li>Política de Privacidade</li>
            <li>Contato</li>
            <li> Sobre</li>
        </table>
        </p>


        <h2>GERENTE COMERCIAL</h2>
        <p><strong>Sua númeração é 3.</strong> <br>
            O nível de permissão permitirá que esse usuário entre nas seguintes páginas: <br>

        <table>
            <li>Cadastrar Produtos</li>
            <li>Controle Estoque</li>
            <li>Controle Fiscal</li>
            <li>Realizar solicitações</li>
            <li>Política de Privacidade</li>
            <li>Contato</li>
            <li>Sobre</li>
        </table>

        </p>


        <h2>GERENTE DE RH</h2>
        <p> <strong>Sua númeração é 4.</strong> <br>
            O nível de permissão permitirá que esse usuário entre nas seguintes páginas: <br>

        <table>
            <li>Controle de RH</li>
            <li>Realizar solicitações</li>
            <li>Política de Privacidade</li>
            <li>Contato</li>
            <li> Sobre</li>
        </table>
        </p>


        <h2>ESTAGIÁRIO</h2>
        <p> <strong>Sua númeração é 5.</strong> <br>
            O nível de permissão permitirá que esse usuário entre nas seguintes páginas: <br>

        <table>
            <li>Realizar solicitações</li>
            <li>Política de Privacidade</li>
            <li>Contato</li>
            <li> Sobre</li>
        </table>

        </p>

    </div>

    <div class="rodape">
        <a class="entra" href="../Portifolio/index.php">Voltar</a>
    </div>

</body>

</html>