<br>
<?php
require_once 'app/tools/utilities.php';
require_once 'app/tools/menu.php';
require_once 'app/tools/cards.php';

if ($_SESSION['tipo'] == 'admin') {
    echo makecardsadmin($path);
} else if ($_SESSION['tipo'] == 'paciente') {
    echo makecardspaciente($path);
} else if ($_SESSION['tipo'] == 'laboratorio') {
    echo makecardslaboratorio($path);
} else if ($_SESSION['tipo'] == 'medico') {
    echo makecardsmedico($path);
}
?>