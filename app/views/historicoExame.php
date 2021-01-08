<link rel="stylesheet" href="<?php echo $path; ?>public/css/autocomplete.css">
<br>
<div class="card">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $path ?>Home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Visualizar Exames</li>
            </ol>
        </nav>
        <h5 class="card-title text-center">Visualizar Exames</h5>
        <?php

        if ($_SESSION['tipo'] != 'paciente') echo pacientform($path, 'exame');
        if (count($dadosModel) > 0) {
            for ($i = 0; $i < count($dadosModel); $i++) {
                echo '<div id="accordion' . $i . '">
                    <div class="card">
                        <div class="card-header" id="heading' . $i . '">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <h5>' . date("d/m/Y", strtotime($dadosModel[$i]->consulta_exame->data)) . ' - ' . $dadosModel[$i]->paciente->nome . ' - ' . $dadosModel[$i]->medico->nome . ' - ' . $dadosModel[$i]->laboratorio->nome . '</h5>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="text-right">
                                        <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">
                                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                        </button>' .
                    obter_edit_button($_SESSION['tipo'], $dadosModel[$i]->consulta_exame->_id, $path)
                    . '</div>
                                </div>
                            </div>
                            <div id="collapse' . $i . '" class="collapse" aria-labelledby="heading' . $i . '" data-parent="#accordion' . $i . '">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">Data:</div>
                                        <div class="col-4">' . $dadosModel[$i]->consulta_exame->data . '</div>
                                        <div class="col-2">Hora:</div>
                                        <div class="col-4">' . $dadosModel[$i]->consulta_exame->hora . '</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Exames:</div>
                                        <div class="col-4">' . $dadosModel[$i]->consulta_exame->tipoexame . '</div>
                                        <div class="col-2">Outro Exame:</div>
                                        <div class="col-4">' . $dadosModel[$i]->consulta_exame->outro . '</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Resultado:</div>
                                        <div class="col-4">' . $dadosModel[$i]->consulta_exame->resultado . '</div>
                                    </div>
                                    ' . obter_observacao($_SESSION['tipo'], $dadosModel[$i]->consulta_exame->observacao) . '
                                    <br/>
                                    <div id="accordion1_' . $i . '">
                                        <div class="card">
                                            <div class="card-header" id="heading1_' . $i . '">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados do médico</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse1_' . $i . '" aria-expanded="false" aria-controls="collapse1_' . $i . '">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse1_' . $i . '" class="collapse" aria-labelledby="heading1_' . $i . '" data-parent="#accordion1_' . $i . '">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">Nome:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->medico->nome . '</div>
                                                        <div class="col-2">CRM:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->medico->crm . '</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">Telefone:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->medico->telefone . '</div>
                                                        <div class="col-2">E-mail:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->medico->email . '</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">Especialidade:</div>
                                                        <div class="col-10">' . $dadosModel[$i]->medico->especialidade . '</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion2_' . $i . '">
                                        <div class="card">
                                            <div class="card-header" id="heading2_' . $i . '">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados do paciente</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse2_' . $i . '" aria-expanded="false" aria-controls="collapse2_' . $i . '">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse2_' . $i . '" class="collapse" aria-labelledby="heading2_' . $i . '" data-parent="#accordion2_' . $i . '">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">Nome:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->paciente->nome . '</div>
                                                        <div class="col-2">Data Nascimento:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->paciente->datanascimento . '</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">Telefone:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->paciente->telefone . '</div>
                                                        <div class="col-2">Email:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->paciente->email . '</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion3_' . $i . '">
                                        <div class="card">
                                            <div class="card-header" id="heading3_' . $i . '">
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <h6>Dados sobre o laboratório</h6>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapse3_' . $i . '" aria-expanded="false" aria-controls="collapse3_' . $i . '">
                                                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse3_' . $i . '" class="collapse" aria-labelledby="heading3_' . $i . '" data-parent="#accordion3_' . $i . '">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">Nome:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->laboratorio->nome . '</div>
                                                        <div class="col-2">CNPJ:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->laboratorio->cnpj . '</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">Telefone:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->laboratorio->telefone . '</div>
                                                        <div class="col-2">E-mail:</div>
                                                        <div class="col-4">' . $dadosModel[$i]->laboratorio->email . '</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">Exames:</div>
                                                        <div class="col-10">' . $dadosModel[$i]->laboratorio->tipoexame . '</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo  '<div class="card">
                <div class="card-body" id="heading">Não há registros a serem apresentados</div></div>';
        }
        ?>
    </div>
</div>
<script src="<?php echo $path; ?>public/js/historico.js"></script>