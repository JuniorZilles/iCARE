<link rel="stylesheet" href="<?php echo $path; ?>public/css/autocomplete.css">
<br>
<?php
$_consulta;
if (count($dadosModel)>0) {
    $_consulta = $dadosModel[0];
}
?>
<div class="card">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $path ?>Home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php
                                                                        if (isset($_consulta->id)) {
                                                                            echo 'Editar Consulta';
                                                                        } else {
                                                                            echo 'Cadastro de Consulta';
                                                                        }
                                                                        ?></li>
            </ol>
        </nav>
        <h5 class="card-title text-center"><?php
                                            if (isset($_exame->id)) {
                                                echo 'Editar Consulta';
                                            } else {
                                                echo 'Cadastro de Consulta';
                                            }
                                            ?></h5>
        <form action="<?php
                        echo $path . 'cadastro/postConsulta';
                        ?>" id="cadastroform" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <?php
                    if (isset($_SESSION['erroValidacao'])) {
                        echo '<div class="invalid-feedback" style="display:block;">' . $_SESSION['erroValidacao'] . '</div>';
                        unset($_SESSION['erroValidacao']);
                    }
                    ?>
                </div>
            </div>
            <input type="hidden" id="identificador" name="identificador" value="<?php if (isset($_consulta->_id)) echo $_consulta->_id; ?>">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="pacienteauto">Nome do Paciente</label>
                    <input type="text" class="form-control" id="pacienteauto" placeholder="Nome do Paciente" value="">
                    <input type="hidden" id="pacienteid" name="pacienteid" value="<?php if (isset($_consulta->pacienteid)) echo $_consulta->pacienteid; ?>">
                    <div class="invalid-feedback" id="invalidpacienteauto"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="datanascimento">Data Nascimento Paciente</label>
                    <input type="date" class="form-control" maxlength="10" id="datanascimento" placeholder="Data de realização da consulta" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Sintomas</label><br />
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="febre" name="febre" value="Febre" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Febre", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="febre">Febre </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dorcabeca" name="dorcabeca" value="Dor de Cabeça" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Dor de Cabeça", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="dorcabeca">Dor Cabeça </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dorcorpo" name="dorcorpo" value="Dor no Corpo" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Dor no Corpo", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="dorcorpo">Dor no Corpo </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dorpeito" name="dorpeito" value="Dor no Peito" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Dor no Peito", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="dorpeito"> Dor no Peito </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="formigamento" name="formigamento" value="Formigamento" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Formigamento", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="formigamento">Formigamento </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dorbarriga" name="dorbarriga" value="Dor de Barriga" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Dor de Barriga", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="dorbarriga"> Dor de Barriga</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vomito" name="vomito" value="Vômito" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Vômito", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="vomito">Vômito </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="nausea" name="nausea" value="Náusea" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Náusea", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="nausea">Náusea </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="perdapeso" name="perdapeso" value="Perda de Peso" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Perda de Peso", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="perdapeso">Perda de Peso </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ganhopeso" name="ganhopeso" value="Ganho de Peso" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Ganho de Peso", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="ganhopeso">Ganho de Peso </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cansaco" name="cansaco" value="Cansaço" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Cansaço", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="cansaco">Cansaço </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="outro" name="outro" value="Outro" <?php if (isset($_consulta->sintomas)) if (false !== array_search("Outro", $_consulta->sintomas)) echo 'checked' ?>> <label class="form-check-label" for="outro">Outro </label>
                    </div>
                    <div class="invalid-feedback" id="invalidcheck"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="dataconsulta">Data da Consulta</label>
                    <input type="date" class="form-control" maxlength="10" name="dataconsulta" id="dataconsulta" placeholder="Data de realização da consulta" value="<?php if (isset($_consulta->data)) echo $_consulta->data; ?>">
                    <div class="invalid-feedback" id="invaliddate"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="horarioconsulta">Horário da Consulta</label>
                    <input type="time" class="form-control" maxlength="8" name="horarioconsulta" id="horarioconsulta" placeholder="Horário de realização da consulta" value="<?php if (isset($_consulta->hora)) echo $_consulta->hora; ?>">
                    <div class="invalid-feedback" id="invalidhour"> </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="outro">Sintomas adicionais</label>
                    <textarea class="form-control" id="outrosintoma" name="outrosintoma" placeholder="Especifique os sintomas adicionais" rows="5"><?php if (isset($_consulta->outro)) echo $_consulta->outro; ?></textarea>
                    <div class="invalid-feedback" id="invalidoutro"> </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="receita">Receita</label>
                    <textarea class="form-control" name="receita" id="receita" placeholder="Receita e recomendações passadas ao paciente" rows="5"><?php if (isset($_consulta->receita)) echo $_consulta->receita; ?></textarea>
                    <div class="invalid-feedback" id="invalidreceita"> </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" name="observacoes" id="observacoes" placeholder="Observações adicionais sobre a consulta(essas informações não ficam disponíveis para o paciente)" rows="5"><?php if (isset($_consulta->observacao)) echo $_consulta->observacao; ?></textarea>
                    <div class="invalid-feedback" id="invalidobservacao"> </div>
                </div>
            </div>
            <div class=text-right>
                <button type="reset" class="btn btn-outline-danger">Limpar</button>
                <button type="submit" id="btnregister" class="btn btn-outline-primary" disabled>Salvar</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo $path; ?>public/js/cadastro_consulta.js"></script>