<br>
<div class="card">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $path ?>Home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Estatísticas</li>
            </ol>
        </nav>
        <h5 class="card-title text-center">Visualização dos Contadores</h5>
        <br>
        <?php
        if ($_SESSION['tipo'] == 'admin') {
            print_r(
                "<h6>Contador de Usuários</h6>
                                    <table class='table table-hover'>
                                    <tbody><tr>
                                    <th scope='col'>Tipo Usuário</th>
                                    <th scope='col'>Quantidade</th>
                                    </tr>"
            );
            foreach ($dadosModel['users'] as $itera) {
                print_r("
                                    <tr>
                                    <td scope='row'>" . $itera['tipo'] . "</td>
                                    <td scope='row'>" . $itera['qtd'] . "</td>
                                    </tr>");
            }
            print_r(
                "</tbody>
                                    </table>"
            );
        }

        print_r(
            "<h6>Contador de Exames e Consultas</h6>
                                <table class='table table-hover'>
                                <tbody><tr>
                                <th scope='col'>Nome</th>
                                <th scope='col'>Tipo</th>
                                <th scope='col'>Quantidade</th>
                                <th scope='col'>Ano - Mês</th>
                                </tr>"
        );
        foreach ($dadosModel['consultas_exames'] as $itera) {
            $nome = $itera['nome'];
            $tipo = $itera['tipo'];
            foreach ($itera['reg'] as $item) {
                print_r("
                                    <tr>
                                    <td scope='row'>" . $nome . "</td>
                                    <td scope='row'>" . $tipo . "</td>
                                    <td scope='row'>" . $item['qtd'] . "</td>
                                    <td scope='row'>" . $item['mes'] . "</td>
                                    </tr>");
            }
        }
        echo "</tbody>
                            </table>";
        ?>
    </div>
</div>