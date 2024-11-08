<?php
function FiltroAccss()
{
    //ADM
    if ($_SESSION['tipo_funcionario'] == 1) {

        $tf1 = <<<'HTML'
<div class="feature-cards">
        <div class="card">
            <div class="info">   
                <i class='bx bxs-devices'></i>
                <h1>Cadastros</h1>
                    <a href="../MVC/Views/EstoqueViews.php">Cadastrar Produtos</a>
                    <a href="../php/cadastrar_empresa.php">Cadastrar Empresas</a>
                    <a href="../MVC/Views/VendasViews.php">Cadastrar Vendas</a>
                    <a href="../MVC/Views/FiscalViews.php">Cadastrar Fatura</a>
                    <a href="../php/cadastrar_processo.php">Cadastrar Processos</a>
                    <a href="../php/niveis_acesso.php">Niveis de Acesso</a>
                    <a href="../php/gestaorh.php">Gestão de RH</a>
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bx-code-alt'></i>

                <h1>Controles</h1>
            
                <a href="../php/controle_estoque.php">Controle Estoque</a>
                <a href="../php/controle_fiscal.php">Controle Fiscal</a>
                <a href="../php/controle_frota.php">Controle Frota</a>
                <a href="../php/controle_empresa.php">Controle Empresa</a>
                <a href="../php/solicitacao.php">Realizar solicitações</a>  
                <a href="../php/solicitacaoatendidas.php">Recibo das Solicitações </a>
                <a href="../php/ver-situação.php">Ver Solicitações</a>
                <a href="../php/listar_processos.php">Ver Processos</a>
                
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bxs-component'></i>
                <h1>informações</h1>
                
                <a href="../Portifolio/politica_adm.php">Politica de Privacidade</a>
                <a href="../Portifolio/contato_adm.php">Página de Contato</a>
                <a href="../Portifolio/sobre_adm.php">Sobre</a>
                
                
            </div>
        </div>
    </div>
HTML;

        echo $tf1;
    }


    //GERENTE
    elseif ($_SESSION['tipo_funcionario'] == 2) {

        $tf2 = <<<'HTML'
<div class="feature-cards">
        <div class="card">
            <div class="info">   
                <i class='bx bxs-devices'></i>
                <h1>Cadastros</h1>
                    <a href="../MVC/Views/EstoqueViews.php">Cadastrar Produtos</a>
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bx-code-alt'></i>

                <h1>Controles</h1>
            
                <a href="gerenciar_estoque.php">Controle Estoque</a>
                <a href="../cadastrar_empresa.php">Controle Fiscal</a>
                <a href="../php/controle_frota.php">Controle Frota</a>
                <a href="../php/solicitacao.php">Realizar solicitações</a>             

                
    </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bxs-component'></i>
                <h1>informações</h1>
                
                <a href="../Portifolio/politica_adm.php">Politica de Privacidade</a>
                <a href="../Portifolio/contato_adm.php">Página de Contato</a>
                <a href="../Portifolio/sobre_adm.php">Sobre</a>
                
                
            </div>
        </div>
    </div>
HTML;

        echo $tf2;
    }

    //Funcionario Comercial
    elseif ($_SESSION['tipo_funcionario'] == 3) {

        $tf3 = <<<'HTML'
<div class="feature-cards">
        <div class="card">
            <div class="info">   
                <i class='bx bxs-devices'></i>
                <h1>Cadastros</h1>
                    <a href="../MVC/Views/EstoqueViews.php">Cadastrar Produtos</a>
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bx-code-alt'></i>

                <h1>Controles</h1>
                <a href="gerenciar_estoque.php">Controle Estoque</a>
                <a href="../cadastrar_fiscal.php">Controle Fiscal</a>   
                <a href="../php/solicitacao.php">Realizar solicitações</a>                          
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bxs-component'></i>
                <h1>informações</h1>
                
                <a href="../Portifolio/politica_adm.php">Politica de Privacidade</a>
                <a href="../Portifolio/contato_adm.php">Página de Contato</a>
                <a href="../Portifolio/sobre_adm.php">Sobre</a>
                
                
            </div>
        </div>
    </div>
HTML;

        echo $tf3;
    }

    //RH
    elseif ($_SESSION['tipo_funcionario'] == 4) {
        $tf4 = <<<'HTML'
<div class="feature-cards">
        <div class="card">
            <div class="info">   
                <i class='bx bxs-devices'></i>
                <h1>Cadastros</h1>
                    <a href="../php/gestaorh.php">Gestão de RH</a>
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bx-code-alt'></i>

                <h1>Controles</h1>
                <a href="../php/solicitacao.php">Realizar solicitações</a>             
            </div>
        </div>
        <div class="card">
            <div class="info">
                <i class='bx bxs-component'></i>
                <h1>informações</h1>
                
                <a href="../Portifolio/politica_adm.php">Politica de Privacidade</a>
                <a href="../Portifolio/contato_adm.php">Página de Contato</a>
                <a href="../Portifolio/sobre_adm.php">Sobre</a>
                
                
            </div>
        </div>
    </div>
HTML;
        echo $tf4;
    }

    //Funcionario Comum
    elseif ($_SESSION['tipo_funcionario'] == 5) {
        $tf5 = <<<'HTML'
        <div class="feature-cards">
                <div class="card">
                    <div class="info">
                        <i class='bx bx-code-alt'></i>
        
                        <h1>Controles</h1>
                    
                        <a href="../php/solicitacao.php">Realizar solicitações</a>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="info">
                        <i class='bx bxs-component'></i>
                        <h1>informações</h1>
                        
                        <a href="../Portifolio/politica_adm.php">Politica de Privacidade</a>
                        <a href="../Portifolio/contato_adm.php">Página de Contato</a>
                        <a href="../Portifolio/sobre_adm.php">Sobre</a>
                        
                        
                    </div>
                </div>
            </div>
        HTML;

        echo $tf5;
    }
}
//FILTRO DE ACESSO AS PÁGINAS

function FiltroPessoas()
{

    if ($_SESSION['tipo_funcionario'] == 3) {
        header('Location: ../pg.php');
    }
}

function FiltroComercial()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroContas()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroEmpresa()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroEstoque()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroFiscal()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroFrota()
{

    if ($_SESSION['tipo_funcionario'] == 4) {
        header('Location: ../pg.php');
    }
}

function FiltroRh()
{

    if ($_SESSION['tipo_funcionario'] == 3) {
        header('Location: ../pg.php');
    }
}

//FILTRO DE ACESSO AS FUNÇÔES

function FiltroCadastro()
{

    if ($_SESSION['tipo_funcionario'] != 5) {
        echo '<button type="submit">Criar</button>';
    }
}

function FiltroAtualizar()
{

    if ($_SESSION['tipo_funcionario'] != 5) {
        echo '';
    }
}

function FiltroDeletar()
{

    if ($_SESSION['tipo_funcionario'] != 5) {
        echo '';
    }
}
