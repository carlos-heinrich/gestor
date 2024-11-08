    <?php
    require_once '../vendor/autoload.php';
    require_once '../config/config.php';
    require 'verificar_permissao.php';

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

    // Recuperar dados da tabela controlefiscal
    try {
        $sql = "SELECT * FROM controlefiscal";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $dadosControleFiscal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calcular o total dos gastos
        $totalGastos = 0;
        foreach ($dadosControleFiscal as $dado) {
            $totalGastos += $dado['orcamentos'];
        }
    } catch (PDOException $e) {
        die("Erro ao recuperar dados: " . $e->getMessage());
    }

    // Recuperar dados da tabela cadastro_empresa
    $dadosCadastroEmpresa = [];
    try {
        $sql = "SELECT * FROM cadastro_empresa";
        $stmt = $pdo->query($sql);
        $dadosCadastroEmpresa = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao recuperar dados da tabela cadastro_empresa: " . $e->getMessage());
    }

    // Iniciar o Dompdf
    $dompdf = new Dompdf();
        
    // Construir o conteúdo HTML para o PDF
    $tablesContent = '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Exibir Dados Fiscais</title>
        <style>
            body { font-family: Arial, sans-serif; }
            h1.titulo { text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            table, th, td { border: 1px solid black; }
            th, td { padding: 8px; text-align: left; }
            .boleto { border: 1px solid #000; padding: 15px; }
            .boleto-header, .boleto-section { display: flex; justify-content: space-between; }
            .banco { font-size: 24px; font-weight: bold;color:purple; }
            .barcode { font-size: 18px; letter-spacing: 3px; margin-top: 20px; text-align: center; }
            .rodape { text-align: center; margin-top: 10px; }
            .section-title { font-weight: bold; margin-bottom: 10px; }
            a.nu {
                color: purple   ; /* cor do texto */
                text-decoration: none; /* remove o sublinhado */
                font-weight: bold; /* torna o texto em negrito */
            }
            
            a.nu:hover {
                color: #45a049; /* cor do texto ao passar o mouse */
            }
            
        </style>
    </head>
    <body>
    <h1 class="titulo">Sistema De Gestão ERP+controle de empresas e de pessoas</h1>
    <table>
        <tr>
            <th>Nome Da Empresa</th>
            <th>Serviços</th>
            <th>CNPJ</th>
            <th>CEP</th>
            <th>Estado</th>
            <th>Rua</th>
            <th>Número</th>
        </tr>';

    foreach ($dadosCadastroEmpresa as $row) {
        $tablesContent .= '<tr>';
        $tablesContent .= '<td>' . htmlspecialchars($row['nome']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['servicos']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['cnpj']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['cep']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['estado']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['rua']) . '</td>';
        $tablesContent .= '<td>' . htmlspecialchars($row['numero']) . '</td>';
        $tablesContent .= '</tr>';
    }

    $tablesContent .= '
        <tr>
            <td colspan="6"><strong>A Pagar:</strong></td>
            <td><strong>R$ ' . htmlspecialchars(number_format($totalGastos, 2, ',', '.')) . '</strong></td>
        </tr>
    </table>';

    foreach ($dadosCadastroEmpresa as $row) {
        $tablesContent .= '
        <div class="boleto">
            <div class="boleto-header">
                <div class="banco">Nu Pagamentos</div>
                <div>
                    <div>Linha Digitável</div>
                    <div>00190.00009 01234.567890 12345.678901 7 89123456789012</div>
                </div>
            </div>
            <div class="boleto-section">
                <div>
                    <div class="section-title">Pagador</div>
                    <div>' . htmlspecialchars($row['nome']) . '</div>
                    <div>' . htmlspecialchars($row['rua']) . ', ' . htmlspecialchars($row['numero']) . '</div>
                    <div>' . htmlspecialchars($row['estado']) . ' - ' . htmlspecialchars($row['cep']) . '</div>
                    <div>CNPJ: ' . htmlspecialchars($row['cnpj']) . '</div>
                </div>
                <div>
                    <div class="section-title">Beneficiário</div>
                    <div>Sistema De Gestão ERP</div>
                    <div> Rua Pref. José Deliberador, 300 - Vila Thaide</div>
                    <div>Paraguaçu Paulista - SP, 19703-042</div>
                </div>
            </div>
            <div class="boleto-section">
                <div>
                    <div class="section-title">Valor do Boleto</div>
                    <div>R$ ' . htmlspecialchars(number_format($totalGastos, 2, ',', '.')) . '</div>
                </div>
                <div>
                    <div class="section-title">Vencimento</div>
                    <div>15/12/2024</div>
                </div>
            </div>
            <div class="boleto-section">
                <div>
                    <div class="section-title">Nosso Número</div>
                    <div> (18) 3361-2573</div>
                </div>
                <div>
                    <div class="section-title">Número do Documento</div>
                    <div>758-644-587-01</div>
                </div>
            </div>
            <div class="barcode">||| |||| ||| ||||| ||||| |||| ||| ||||| ||||| |||| ||| ||||| || |||| </div>
            <div class="rodape">
                000000000-1
            </div>
        </div>';
    }

    $tablesContent .= '
    <a class="nu" href="https://nubank.com.br/" target="_blank">NuBank</a>

    </body>
    </html>';

    // Carregar o conteúdo HTML no Dompdf
    $dompdf->loadHtml($tablesContent);

    // (Opcional) Definir o tamanho e a orientação do papel
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar o HTML como PDF
    $dompdf->render();

    // Enviar o PDF gerado para o navegador
    $dompdf->stream("boleto.pdf", array("Attachment" => false));
    ?>
