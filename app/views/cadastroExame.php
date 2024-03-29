<link rel="stylesheet" href="<?php echo $path; ?>public/css/autocomplete.css">
<br>
<?php
$_exame;
if (count($dadosModel) > 0) {
    $_exame = $dadosModel[0];
}
?>
<div class="card">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $path ?>Home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php
                                                                        if (isset($_exame->id)) {
                                                                            echo 'Editar Exame';
                                                                        } else {
                                                                            echo 'Cadastro de Exame';
                                                                        }
                                                                        ?></li>
            </ol>
        </nav>
        <h5 class="card-title text-center"><?php
                                            if (isset($_exame->id)) {
                                                echo 'Editar Exame';
                                            } else {
                                                echo 'Cadastro de Exame';
                                            }
                                            ?></h5>
        <form action="<?php
                        echo $path . 'cadastro/postExame';
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
            <input type="hidden" id="labinfo" name="labinfo" value="<?php if (isset($_SESSION['user']))  echo $_SESSION['user']; ?>">
            <input type="hidden" id="identificadorexame" name="identificadorexame" value="<?php if (isset($_exame->_id))  echo $_exame->_id; ?>">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="pacienteauto">Nome do Paciente</label>
                    <input type="text" class="form-control" id="pacienteauto" name="pacienteauto" placeholder="Nome do Paciente" value="">
                    <input type="hidden" id="pacienteid" name="pacienteid" value="<?php if (isset($_exame->pacienteid)) echo $_exame->pacienteid; ?>">
                    <div class="invalid-feedback" id="invalidpacienteauto"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="datanascimento">Data Nascimento Paciente</label>
                    <input type="date" class="form-control" maxlength="10" id="datanascimento" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="medicoauto">Médico Responsável</label>
                    <input type="text" class="form-control" id="medicoauto" name="medicoauto" placeholder="Nome do Médico Responsável" value="">
                    <input type="hidden" id="medicoid" name="medicoid" value="<?php if (isset($_exame->medicoid)) echo $_exame->medicoid; ?>">
                    <div class="invalid-feedback" id="invalidmedicoauto"> </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="especialidade">Especialidade</label>
                    <input type="text" class="form-control" id="especialidade" placeholder="Especialidade do médico" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="crm">CRM</label>
                    <input type="text" class="form-control" id="crm" placeholder="CRM do médico" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" placeholder="Telefone do médico" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exameauto">Exames a serem realizados</label>
                    <input type="text" class="form-control" id="exameauto" placeholder="Busque o tipo de exame">
                    <div class="invalid-feedback" id="invalidexame"> </div>
                    <input type="hidden" name="exame" id="exame" value="<?php if (isset($_exame->tipoexame)) echo $_exame->tipoexame; ?>">
                    <input type="hidden" name="tipoexame" id="tipoexame" value="<?php if (isset($_tipoexame)) echo $_tipoexame; ?>">

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="especifiqueoutro" name="outro" placeholder="Especifique se for outro exame" value="<?php if (isset($_exame->outro)) echo $_exame->outro; ?>">
                </div>
            </div>
            <div id="laboratoriobtn" class="form-row">
                <div id="tipoexamebtns">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dataexame">Data do Exame</label>
                    <input type="date" class="form-control" maxlength="10" id="dataexame" name="dataexame" placeholder="Data de realização do exame" value="<?php if (isset($_exame->data)) echo $_exame->data; ?>">
                    <div class="invalid-feedback" id="invaliddate"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="horarioexame">Horário do Exame</label>
                    <input type="time" class="form-control" maxlength="10" id="horarioexame" name="horarioexame" placeholder="Horário de realização ddo exame" value="<?php if (isset($_exame->hora)) echo $_exame->hora; ?>">
                    <div class="invalid-feedback" id="invalidhour"> </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="resultadoexame">Resultado do Exame</label>
                    <select id="resultadoexame" name="resultadoexame" class="form-control">
                        <option <?php if (!isset($_exame->resultado)) echo 'selected' ?>>Escolher...</option>
                        <option value="apto" <?php if (isset($_exame->resultado)) if ($_exame->resultado == 'apto') echo 'selected'; ?>>Apto</option>
                        <option value="inapto" <?php if (isset($_exame->resultado)) if ($_exame->resultado == 'inapto') echo 'selected'; ?>>Inapto</option>
                    </select>
                    <div class="invalid-feedback" id="invalidresultado"> </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea class="form-control" name="resultado" id="resultado" placeholder="Descrição detalhada dos resultados obtidos" rows="5"><?php if (isset($_exame->observacao)) echo $_exame->observacao; ?></textarea>
                    <div class="invalid-feedback" id="invalidtextresultado"> </div>
                </div>
            </div>
            <div class=text-right>
                <button type="reset" class="btn btn-outline-danger">Limpar</button>
                <button type="submit" id="btnregister" class="btn btn-outline-primary" disabled>Salvar</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo $path; ?>public/js/cadastro_exame.js"></script>