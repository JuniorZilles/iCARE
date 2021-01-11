
<?php
function makecardsadmin($path)
{
    return '
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/medico.jpg" alt="Cadastrar Médico">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Médico</h5>
                    <p class="card-text">O cadastro de um novo médico é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'cadastro/pessoa/medico"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/paciente.jpg" alt="Cadastrar Paciente">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Paciente</h5>
                    <p class="card-text">O cadastro de novos pacientes é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'cadastro/pessoa/paciente"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/laboratorio.jpg" alt="Cadastrar Laboratório">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Laboratório</h5>
                    <p class="card-text">O cadastro de um novo laboratório é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'cadastro/pessoa/laboratorio"></a>
                </div>
            </div>
        </div>
        </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/editarcadastro.png" alt="Alterar Cadastro">
                <div class="card-body">
                    <h5 class="card-title">Alterar Cadastro</h5>
                    <p class="card-text">Alterar senha e outros dados de perfil pode ser feito por aqui</p>
                    <a class="stretched-link" href="'.$path.'visualizacao"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/informacoes.jpg" alt="Estatisticas gerais">
                <div class="card-body">
                    <h5 class="card-title">Estatisticas Gerais</h5>
                    <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'estatisticas"></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/consulta.png" alt="Visualizar Consultas">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Consultas</h5>
                    <p class="card-text">A visualização das consultas realizadas é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'historico/consulta"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/exame.jpg" alt="Visualizar Exames">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Exames</h5>
                    <p class="card-text">A visualização dos exames realizados é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'historico/exame"></a>
                </div>
            </div>
        </div>
    </div>';
}

function makecardspaciente($path)
{
    return '
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/consulta.png" alt="Visualizar minhas consultas">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Consultas</h5>
                    <p class="card-text">A visualização das consultas realizadas é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'historico/consulta"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/exame.jpg" alt="Visualizar meus exames">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Exames</h5>
                    <p class="card-text">A visualização dos exames realizados é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'historico/exame"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <img class="card-img-top" src="public/images/informacoes.jpg" alt="Visualizar minhas consultas">
                <div class="card-body">
                    <h5 class="card-title">Visualizar a Quantidade de Consultas</h5>
                    <p class="card-text">A visualização da quantidade das consultas realizadas é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'estatisticas"></a>
                </div>
            </div>
    </div>
';
}

function makecardsmedico($path)
{
    return '
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/consulta.png" alt="Visualizar Consultas">
                <div class="card-body">
                    <h5 class="card-title">Visualizar Consultas</h5>
                    <p class="card-text">A visualização dos consultas cadastrados é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'historico/consulta"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/cadastroconsulta.jpg" alt="Cadastrar Consultas">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Consultas</h5>
                    <p class="card-text">O cadastro de consultas é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'cadastro/consulta"></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/editarcadastro.png" alt="Alterar meu Cadastro">
                <div class="card-body">
                    <h5 class="card-title">Alterar meu Cadastro</h5>
                    <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                    <a class="stretched-link" href="'.$path.'cadastro/getPessoa"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/informacoes.jpg" alt="Estatisticas gerais">
                <div class="card-body">
                    <h5 class="card-title">Estatisticas Gerais</h5>
                    <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'estatisticas"></a>
                </div>
            </div>
        </div>
    </div>
';
}

function makecardslaboratorio($path)
{
    return '
    <div class="row">
        <div class="col-sm-6">
        <div class="card">
            <img class="card-img-top" src="public/images/exame.jpg" alt="Visualizar Exames">
            <div class="card-body">
                <h5 class="card-title">Visualizar Exames</h5>
                <p class="card-text">A visualização dos exames cadastrados é feita por aqui!</p>
                <a class="stretched-link" href="'.$path.'historico/exame"></a>
            </div>
        </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/cadastroconsulta.jpg" alt="Cadastrar Exames">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Exames</h5>
                    <p class="card-text">O cadastro de exames é feito por aqui!</p>
                    <a class="stretched-link" href="'.$path.'cadastro/exame"></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/editarcadastro.png" alt="Alterar meu Cadastro">
                <div class="card-body">
                    <h5 class="card-title">Alterar Cadastro</h5>
                    <p class="card-text">Alterar sua senha e outros dados do seu perfil pode ser feito por aqui</p>
                    <a class="stretched-link" href="'.$path.'cadastro/getPessoa"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img class="card-img-top" src="public/images/informacoes.jpg" alt="Estatisticas gerais">
                <div class="card-body">
                    <h5 class="card-title">Estatisticas Gerais</h5>
                    <p class="card-text">A visualização dos gráficos de cada categoria é feita por aqui!</p>
                    <a class="stretched-link" href="'.$path.'estatisticas"></a>
                </div>
            </div>
        </div>
    </div>';
}
?>