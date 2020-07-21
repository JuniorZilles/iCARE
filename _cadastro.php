<?php
session_start();

require_once '_utilities.php';
require_once '_pessoa_model.php';

//lógica do cadastro de médico/paciente/laboratório
try {

    $_email = $_senha = $_id = $_tipo =
        $_nome =
        $_telefone =
        $_rua =
        $_numero =
        $_bairro =
        $_complemento =
        $_cidade =
        $_estado =
        $_cep =
        $_genero =
        $_datanascimento =
        $_cpf =
        $_tipoexame =
        $_cnpj =
        $_especialidade =
        $_crm = '';
    $_objeto = null;    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['tipo'] != 'admin') {
        $xml = simplexml_load_file('dados.xml');

        $users = $xml->users->children();
        foreach ($users as $child) {
            if ($child['id'] == $_SESSION['user']){
                $_objeto = obter_usuario($child);
            }
        }
        $_SESSION['registro'] = $_objeto;
        header("Location: cadastro_pessoa.php");
    }
} catch (Throwable $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: home.php");
} catch (Exception $e) {
    $_SESSION['erro'] = maketoast('Erro de execução', $e->getMessage() . PHP_EOL);
    header("Location: home.php");
}
