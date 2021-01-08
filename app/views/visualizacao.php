<br>
<div class="card">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $path ?>Home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuários Cadastrados</li>
            </ol>
        </nav>
        <h5 class="card-title text-center">
            Usuários Cadastrados
        </h5>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($dadosModel[0]) > 0) {
                    $count = 1;
                    foreach ($dadosModel[0] as $item) {
                        $tipo = '';
                        if ($item['tipo'] == 'paciente')  $tipo = 'Paciente';
                        else if ($item['tipo'] == 'medico')  $tipo = 'Médico';
                        else $tipo = 'Laboratório';
                        echo '<tr>
                                <th scope="row">' . $count . '</th>
                                    <td>' . $item['nome'] . '</td>
                                    <td>' . $tipo . '</td>
                                    <td>' . $item['telefone'] . '</td>
                                    <td>' . $item['email'] . '</td>
                                    <td><a href="' . $path . 'cadastro/getPessoa/' . $item['_id'] . '" class="btn btn-outline-warning"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
                                </tr>';
                        $count++;
                    }
                } else {
                    echo '<tr colspan="6">
                                    <td>Não há registros presentes!</td>
                                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>