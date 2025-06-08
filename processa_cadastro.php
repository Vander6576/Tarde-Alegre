<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');

// Conexão com o banco
$host = "localhost";
$user = "root";
$senha = "";  // Atualize conforme necessário
$banco = "depin_occ";

$conn = new mysqli($host, $user, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Recebe os dados do formulário
$dados = [
    'nome_completo' => $_POST['nome_completo'] ?? '',
    'idade' => intval($_POST['idade'] ?? 0),
    'endereco' => $_POST['endereco'] ?? '',
    'responsavel' => $_POST['responsavel'] ?? '',
    'telefone_responsavel' => $_POST['telefone_responsavel'] ?? '',
    'alergias' => $_POST['alergias'] ?? '',
    'informacoes_importantes' => $_POST['informacoes_importantes'] ?? '',
    'relacao_igreja' => $_POST['relacao_igreja'] ?? '',
    'pedido_oracao' => $_POST['pedido_oracao'] ?? '',
    'crianca_sede' => $_POST['crianca_sede'] ?? '',
    'idade_crianca_sede' => intval($_POST['idade_crianca_sede'] ?? 0),
    'quantidade_visitantes' => intval($_POST['quantidade_visitantes'] ?? 0),
    'visitante1_nome' => $_POST['visitante1_nome'] ?? '',
    'visitante1_idade' => intval($_POST['visitante1_idade'] ?? 0),
    'visitante1_endereco' => $_POST['visitante1_endereco'] ?? '',
    'visitante1_telefone' => $_POST['visitante1_telefone'] ?? '',
    'visitante1_situacao' => $_POST['visitante1_situacao'] ?? '',
    'visitante1_alergias' => $_POST['visitante1_alergias'] ?? '',
    'visitante1_info_extra' => $_POST['visitante1_info_extra'] ?? '',
    'visitante2_nome' => $_POST['visitante2_nome'] ?? '',
    'visitante2_idade' => intval($_POST['visitante2_idade'] ?? 0),
    'visitante2_endereco' => $_POST['visitante2_endereco'] ?? '',
    'visitante2_telefone' => $_POST['visitante2_telefone'] ?? '',
    'visitante2_situacao' => $_POST['visitante2_situacao'] ?? '',
    'visitante2_alergias' => $_POST['visitante2_alergias'] ?? '',
    'visitante2_info_extra' => $_POST['visitante2_info_extra'] ?? '',
    'nome_autor' => $_POST['nome_autor'] ?? '',
    'termo_assinado' => isset($_POST['termo']) && $_POST['termo'] === 'sim' ? 1 : 0
];

// Prepara a query com placeholders
$sql = "INSERT INTO visitantes (
    nome_completo, idade, endereco, responsavel, telefone_responsavel,
    alergias, informacoes_importantes, relacao_igreja, pedido_oracao,
    crianca_sede, idade_crianca_sede, quantidade_visitantes,
    visitante1_nome, visitante1_idade, visitante1_endereco, visitante1_telefone,
    visitante1_situacao, visitante1_alergias, visitante1_info_extra,
    visitante2_nome, visitante2_idade, visitante2_endereco, visitante2_telefone,
    visitante2_situacao, visitante2_alergias, visitante2_info_extra,
    nome_autor, termo_assinado
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

// Prepara a execução
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erro na preparação: " . $conn->error);
}

// Bind dos valores
$stmt->bind_param(
    'sissssssssiiisisssisssssssii',
    $dados['nome_completo'],
    $dados['idade'],
    $dados['endereco'],
    $dados['responsavel'],
    $dados['telefone_responsavel'],
    $dados['alergias'],
    $dados['informacoes_importantes'],
    $dados['relacao_igreja'],
    $dados['pedido_oracao'],
    $dados['crianca_sede'],
    $dados['idade_crianca_sede'],
    $dados['quantidade_visitantes'],
    $dados['visitante1_nome'],
    $dados['visitante1_idade'],
    $dados['visitante1_endereco'],
    $dados['visitante1_telefone'],
    $dados['visitante1_situacao'],
    $dados['visitante1_alergias'],
    $dados['visitante1_info_extra'],
    $dados['visitante2_nome'],
    $dados['visitante2_idade'],
    $dados['visitante2_endereco'],
    $dados['visitante2_telefone'],
    $dados['visitante2_situacao'],
    $dados['visitante2_alergias'],
    $dados['visitante2_info_extra'],
    $dados['nome_autor'],
    $dados['termo_assinado']
);

// Executa
if ($stmt->execute()) {
    echo "<h3>✅ Cadastro realizado com sucesso!</h3>";
} else {
    echo "<h3>❌ Erro ao cadastrar: " . $stmt->error . "</h3>";
}

$stmt->close();
$conn->close();
?>
