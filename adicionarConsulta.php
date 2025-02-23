<?php
    session_start();
    require_once "configs/BancoDados.php";
    require_once "configs/Medicos.php";
    require_once "configs/Pacientes.php";

    if (!isset($_SESSION["login_user"])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" type="imagem/png" href="styles/logo-clinica.png" />
    <title>Document</title>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <nav id="navbar-example2" class="navbar navbar-light bg-light px-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <img src="styles/logo-clinica.png" alt="logo">
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pacientes</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="listarPacientes.php">Listar</a></li>
                    <li><a class="dropdown-item" href="cadastrarPacientes.php">Cadastrar</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Medicos</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="listarMedicos.php">Listar</a></li>
                    <li><a class="dropdown-item" href="cadastrarMedicos.php">Cadastrar</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adicionarConsulta.php">Adicionar consulta</a>
            </li>
        </ul>
        <a class="nav-link" href='index.php?op=logout'><button class="btn btn-primary sair">Sair</button></a>
    </nav>
    <?php
        require_once "configs/adicionarConsultaBD.php";
    ?>

    <div class="container">
        <form method="POST" action="adicionarConsulta.php">
            <div class="mb-3 center">
                <h3>Cadastrar nova consulta</h3>
            </div>
            <div class="mb-3">
                <label for="inputSelect" class="form-label">Medicos</label>
                <select required class="form-select" aria-label="Default select example" name="idMedico" id="inputSelect">
                <option selected></option>
                <?php
                    $listaMedicos = Medicos::listaMedicos();
                    foreach ($listaMedicos as $medicos) {
                        echo "<option value=".$medicos["id"].">".$medicos['nome']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputSelectPacient" class="form-label">Pacientes</label>
                <select required class="form-select" aria-label="Default select example" name="idPaciente" id="inputSelectPacient">
                <option selected></option>
                <?php
                    $listaPacientes = Pacientes::listaPacientes();
                    foreach ($listaPacientes as $pacientes) {
                        echo "<option value=".$pacientes["id"].">".$pacientes['nome']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputData" class="form-label">Data da consulta</label>
                <input required name="data" type="date" class="form-control" id="inputData">
            </div>
            <div class="mb-3">
                <label for="inputTime" class="form-label">Hora da consulta</label>
                <input required name="time" type="time" class="form-control" id="inputTime">
            </div>
            <button name="cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Ação para ocultar a div depois de 5 segundos -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $(".alert").fadeIn('slow').empty(); 
                $(".alert").css({'border': 'none'});
                $(".alert-success").css({'background-color': 'unset'});
                $(".alert-danger").css({'background-color': 'unset'});
            }, 3000);
        }, false);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
