<?php
require_once '../vendor/autoload.php';
require_once '../config/config.php';

use Dompdf\Dompdf;

// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'bike';
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$stmt = $pdo->query("SELECT * FROM controleestoque");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Variável para armazenar o conteúdo das tabelas
$tablesContent = '';

// Itera sobre os resultados e cria uma tabela para cada livro
foreach ($livros as $livro) {
    $tableContent = "
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #0056b3;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #0056b3;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class='container'>
        <h1>Tutorial de uso site Bitrix</h1>
        <p>Este site é um sistema de gestão de empresas especialmente desenvolvido para empresas de bicicletas. O site proporciona uma solução integrada para otimizar e simplificar a administração de empresas de bicicletas, melhorando a eficiência e a produtividade. A plataforma permite o controle abrangente de diversos aspectos da operação empresarial, incluindo:</p>
        <h2>1. Introdução:</h2>
        <h3>2. Acesso ao site:</h3>
        <p>Abra o navegador de sua preferência e digite o endereço do site: gestao_bikes/gb/php/index/php</p>
        <p>Na página inicial, você verá um botão “ENTRAR” no lado direito superior. Primeiramente será necessário fazer login com a conta da sua empresa, caso não tenha, direcione para a página de “Realizar cadastro”. Nessa página você terá que preencher dados como: nome da empresa, tipo de serviço, CNPJ, senha, CEP da empresa, estado, rua e número de endereço.</p>
        <h2>Produtos:</h2>
        <p>Gerenciamento completo de catálogo de produtos.</p>
        <h2>Gestão de RH:</h2>
        <p>Controle de recursos humanos, desde o cadastro de funcionários até a gestão de folha de pagamento.</p>
        <h2>Cadastro de Empresas:</h2>
        <p>Adição e gerenciamento de novas empresas dentro do sistema.</p>
        <h2>Controle Fiscal:</h2>
        <p>Monitoramento e conformidade fiscal, incluindo emissão de notas e relatórios fiscais.</p>
        <h2>Controle Interno de Estoque:</h2>
        <p>Gestão detalhada de estoque, garantindo a disponibilidade de produtos e peças.</p>
        <h2>Controle de Frota de Veículos:</h2>
        <p>Supervisão e manutenção da frota de veículos usados na operação.</p>
        <h2>Gestão de Contas a Pagar:</h2>
        <p>Organização e controle de pagamentos, facilitando a gestão financeira.</p>
        <h2>Objetivo:</h2>
        <p>Este tutorial tem como objetivo ajudar os usuários que enfrentam dificuldades ao utilizar o site de gestão de empresa. O documento fornece um guia passo a passo detalhado, abordando as principais funcionalidades do site. Ele visa facilitar a navegação e o entendimento das ferramentas disponíveis, permitindo que os usuários aproveitem ao máximo os recursos da plataforma para otimizar suas operações empresariais.</p>
        <h3>Como acessar o site:</h3>
        <h3>Processo de login e criação de conta:</h3>
        <p>Em seguida é necessário efetuar o login da empresa. Ao clicar no botão de “ENTRAR”, será direcionado para o login de funcionários da empresa.</p>
        <h3>2.1 Criar uma nova conta:</h3>
        <p>Se você ainda não tem uma conta, clique em Criar Conta para iniciar o processo de registro. Para criar uma nova conta, clique no botão Criar Conta na tela de login.</p>
        <h3>3. Primeiro Acesso:</h3>
        <h3>4. Visão Geral Página Principal do Acesso do Funcionário:</h3>
        <h3>5. Cadastros:</h3>
        <p>Se você ainda não tem uma conta, clique em Criar Conta para iniciar o processo de registro. Para criar uma nova conta, clique no botão Criar Conta na tela de login. Preencha os campos obrigatórios com suas informações pessoais, como nome completo, nome de usuário, CPF, gênero, número de telefone, e-mail, escolha uma senha segura, e se for de sua escolha, adicionar uma foto de perfil. Clique em Cadastrar-se para finalizar o processo. Após confirmar sua conta, volte à tela de login. Insira seu nome de usuário e senha, e clique em Entrar. Quando já estiver logado, entrará na página principal e aparecerá a mensagem Bem Vindo ao Sistema de Gestão Online, logo abaixo tem um feedback e três partes com botões e cada um direciona para mais links dentro do site:</p>
        <h3>Cadastros:</h3>
        <p>Cadastrar Produtos, Cadastrar Empresas, Níveis de Acesso e Gestão de RH;</p>
        <h3>Controles:</h3>
        <p>Controle de Estoque, Controle Fiscal, Controle Frota, Controle Empresa, Realizar Solicitações e Solicitações Atendidas;</p>
        <h3>Informações:</h3>
        <p>Política de Privacidade, Página de Contato e Sobre.</p>
        <p>Abaixo dessa parte da página tem um botão que tem a função de logout da página, assim você poderá sair da sua conta. Ao clicar no primeiro botão “Cadastrar Produtos” redireciona para a página. Nela contém os seguintes itens para cadastrar seu produto: Nome do Produto, Quantidade, Preço, Tipo, Data, Fornecedor e Imagem. No canto esquerdo da página o usuário consegue ver também os produtos cadastrados e se quiser pode os atualizar e deletar. Ao clicar no segundo botão “Cadastrar Empresas” redireciona para a página. Nela contém os seguintes itens para cadastrar sua empresa: Nome da Empresa, Serviços, CNPJ, Senha, CEP, Estado, Rua e Número. No canto esquerdo da página o CEO da empresa consegue ver também as empresas cadastradas e se quiser pode os atualizar e deletar. Ao clicar no terceiro botão “Níveis de Acesso” redireciona para a página. Nela contém os seguintes itens para cadastrar sua empresa: Se o usuário for o CEO a numeração será 1 permitirá que esse usuário entre em todas as páginas do programa; se for o Gerente Geral a numeração será 2 e o nível de permissão permitirá que esse usuário entre nas páginas: Cadastrar Produtos, Controle Estoque, Controle Fiscal, Controle de Frotas, Sobre, Política de Privacidade, Contato e Realizar solicitações; Se for o Gerente Comercial a numeração será 3 e o nível de permissão permitirá que esse usuário entre nas páginas: Cadastrar Produtos, Controle Estoque, Controle Fiscal, Política de Privacidade, Sobre, Contato e Realizar solicitações; Se for o Gerente de RH a numeração será 4 e o nível de permissão permitirá que esse usuário entre nas páginas: Controle de RH, Política de Privacidade, Sobre, Contato e Realizar solicitações; Se for o Estagiário a numeração será 5 e o nível de permissão permitirá que esse usuário entre nas páginas: Sobre, Política de Privacidade, Contato e Realizar solicitações; Ao clicar no quarto botão “Gestão de RH” redireciona para a página. Nela contém os seguintes itens para cadastrar as pessoas e assim fazer a gestão: Nome Completo, Nome de Usuário, Data de Nascimento, CPF, Gênero, Telefone, Email, Senha, Categoria de Funcionário, CEP, Cidade, Rua, Número, Complemento, Hora de Entrada, Hora de Saída, Carga Horária, Remuneração, Data de Contrato e Foto de Perfil. Se for o CEO e Gerente de RH poderá ver os funcionários cadastrados. “EDITAR”: todos os dados apareceram para você mudar caso for necessário; “DELETAR”: aparecerá uma notificação perguntando se você realmente quer deletar essa informação, podendo escolher entre “OK” e “CANCELAR”.</p>
        <h3>Realizar solicitações:</h3>
        <p>Página destinada para que funcionários possam solicitar algo para os chefes. Nele tem campos para serem preenchidos (Nome do solicitante, responsável, tipo de pedido e a situação), clicando em criar, sua solicitação será enviada para o chefe. Ao lado esquerdo, temos um menu, com as solicitações que estão pendentes. Dentro dessas solicitações pendentes, tem as solicitações já atendidas.</p>
        <h3>Solicitações atendidas:</h3>
        <p>Controle de solicitações que já foram respondidas pelos chefes. Sem ser possível editar em nenhuma informação.</p>
        <h3>Informações</h3>
        <p>Política de privacidade: Ao clicar no botão “política de privacidade” você é direcionado à uma página que lhe informará as políticas que usamos para proteger seus dados pessoais e suas garantias de segurança perante o nosso sistema. Ao pressionar o botão “voltar” você retornara a página inicial.</p>
        <p>Página de contato: Ao clicar no botão “página de contato” você é direcionado à uma página que lhe informará nosso contato de e-mail e 0800, se acaso precise tirar alguma dúvida ou precisar de alguma informação extra. Ao pressionar o botão “voltar” você retornara a página inicial.</p>
        <p>Página de sobre: Ao clicar no botão “página de sobre” você é direcionado à uma página que lhe informará sobre nossa empresa, nossos princípios, como trabalhamos e como utilizamos a tecnologia para facilitar seu negócio. Ao pressionar o botão “voltar” você retornara a página inicial.</p>
    </div>
    ";

    // Adiciona o conteúdo da tabela à variável principal
    $tablesContent .= $tableContent;
}

$dompdf->loadHtml($tablesContent);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>