<?php

if (isset($_SESSION['tipo'])) {
    $menu = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="'.$path.'Home">iCARE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="'.$path.'Home">Home</a>
            </li>';
    if ($_SESSION['tipo'] == 'admin') {
        $menu .= makemenuadmin($path);
    } else if ($_SESSION['tipo'] == 'paciente') {
        $menu .= makemenupaciente($path);
    } else if ($_SESSION['tipo'] == 'laboratorio') {
        $menu .= makemenulaboratorio($path);
    } else if ($_SESSION['tipo'] == 'medico') {
        $menu .= makemenumedico($path);
    }
    $menu .= '</ul>
        <ul class="nav navbar-nav ml-auto justify-content-end">
            <li class="nav-item" style="align">
                <a class="nav-link" href="'.$path.'Logout">Logout <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>';
echo $menu;
}
