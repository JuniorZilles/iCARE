
<?php 
function makecardsadmin(){
    return '<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a class="nav-link" href="cadastro_medico.php">
                <div class="card">
                    <img class="card-img-top" src="images/medico.jpg" alt="Cadastrar Médico">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Médico</h5>
                        <p class="card-text">O cadastro de um novo médico é feito por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="cadastro_paciente.php">
                <div class="card">
                    <img class="card-img-top" src="images/paciente.jpg" alt="Cadastrar Paciente">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Paciente</h5>
                        <p class="card-text">O cadastro de novos pacientes é feito por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <a href="cadastro_laboratorio.php">
                <div class="card">
                    <img class="card-img-top" src="images/laboratorio.jpg" alt="Cadastrar Laboratório">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Laboratório</h5>
                        <p class="card-text">O cadastro de um novo laboratório é feito por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="estatisticas.php">
                <div class="card">
                    <img class="card-img-top" src="images/informacoes.jpg" alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>';
}

function makecardspaciente(){
    return '<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href="historico_consultas.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Visualizar minhas consultas">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar Consultas</h5>
                        <p class="card-text">A visualização das consultas realizadas é feita por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="historico_exames.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Visualizar meus exames">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar Exames</h5>
                        <p class="card-text">A visualização dos exames realizados é feito por aqui!</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>';
}

function makecardsmedico(){
    return '<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href="historico_consultas.php">
                <div class="card">
                    <img class="card-img-top" src="images/consulta.png" alt="Visualizar Consultas">
                    <div class="card-body">
                        <h5 class="card-title">Visualizar Consultas</h5>
                        <p class="card-text">A visualização dos consultas cadastrados é feita por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="cadastro_consulta.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Cadastrar Consultas">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Consultas</h5>
                        <p class="card-text">O cadastro de consultas é feito por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <a href="cadastro_medico.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Alterar meu Cadastro">
                    <div class="card-body">
                        <h5 class="card-title">Alterar meu Cadastro</h5>
                        <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="estatisticas.php">
                <div class="card">
                    <img class="card-img-top" src="images/informacoes.jpg" alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>';
}

function makecardslaboratorio(){
    return '<div class="container">
    <div class="row">
        <div class="col-sm-6">
        <a href="historico_exames.php">
            <div class="card">
                <img class="card-img-top" src="images/" alt="Visualizar Exames">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Exames</h5>
                    <p class="card-text">A visualização dos exames cadastrados é feita por aqui!</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="cadastro_exame.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Cadastrar Exames">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Exames</h5>
                        <p class="card-text">O cadastro de exames é feito por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <a href="cadastro_laboratorio.php">
                <div class="card">
                    <img class="card-img-top" src="images/" alt="Alterar meu Cadastro">
                    <div class="card-body">
                        <h5 class="card-title">Alterar Cadastro</h5>
                        <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="estatisticas.php">
                <div class="card">
                    <img class="card-img-top" src="images/informacoes.jpg" alt="Estatisticas gerais">
                    <div class="card-body">
                        <h5 class="card-title">Estatisticas Gerais</h5>
                        <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>';
}
?>