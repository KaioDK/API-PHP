<?php 
    header("Content-Type: application/json");

    $metodo = $_SERVER["REQUEST_METHOD"];

    echo "Método de requisição: " . $metodo;

    switch ($metodo) {
        case 'GET':
            echo "AQUI AÇÕES DO MÉTODO GET";
            break;
        case 'POST':
            echo "AQUI AÇÕES DO MÉTODO POST";
            break;
        default:
            echo "MÉTODO NÃO ENCONTRADO!";
            break;
    }

    // Exemplo de dados de usuários
    // $usuarios = [
    //     ["id" => 1, "nome" => "Fulano", "email" => "fulano@gmail.com"],
    //     ["id" => 2, "nome" => "Ciclano", "email" => "ciclano@gmail.com"],
    // ];

    // Converte para JSON e retorna
    // echo json_encode($usuarios);
?>