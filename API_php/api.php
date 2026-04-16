<?php 
    header("Content-Type: application/json");

    $metodo = $_SERVER["REQUEST_METHOD"];

    // echo "Método de requisição: " . $metodo;

    // recupera o arquivo json na mesma pasta do projeto
    $arquivo = 'usuarios.json';

    // verifica se o arquivo existe, se não, crioa um com um aray vazio
    if (!file_exists($arquivo)){
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    };

    // lê o conteudo do arquivo JSON
    $usuarios = json_decode(file_get_contents($arquivo), true);

    switch ($metodo) {
        case 'GET':
            // echo " AQUI AÇÕES DO MÉTODO GET";
            // converte para JSON e retorna
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;
        case 'POST':
            // echo " AQUI AÇÕES DO MÉTODO POST";
            // ler os dados no corpo da requisição
            $dados = json_decode(file_get_contents('php://input'), true);
            // print_r($dados);

            // verifica se os campos obrigatórios foram preenchidos
            if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])) {
                http_response_code(400);
                echo json_encode(["erro" => "Dados incompletos."], JSON_UNESCAPED_UNICODE);
                exit;
            }

            // cria novo usuário
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];
            // adiciona array de usuarios
            $usuarios[] = $novo_usuario;

            //salva o array atualizado no arquivo json
            file_put_contents($arquivo, json_encode($arquivo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            //retornar mensagem de sucesso
            echo json_encode(["mensagem" => "Usuário inserido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);

            // Adiciona o novo usuário ao array existente
            // array_push($usuarios, $novoUsuario);
            // echo json_encode('Uúsario inserido com sucesso!');
            // print_r($usuarios);

            break;
        default:
            // echo " MÉTODO NÃO ENCONTRADO!";
            http_response_code(405); //metodo não permitido
            echo json_encode(["erro" => "Método não permitido!"], JSON_UNESCAPED_UNICODE);
            break;
    }
?>