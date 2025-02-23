<?php
    session_start();
    require_once "configs/BancoDados.php";
    require_once "configs/Pacientes.php";
    require_once "configs/Medicos.php";
    require_once "configs/Consultas.php";
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
    <title>Pacientes</title>
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
        require_once "configs/funcs.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data de nascimento</th>
                            <th>Data de cadastro</th>
                            <th>Consultas</th>
                            <th>Deletar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listaPessoas = Pacientes::listaPacientes();
                            foreach ($listaPessoas as $paciente) {
                                echo "<tr>";
                                echo "<td>". $paciente["id"]. "</td>";
                                echo "<td>". $paciente["nome"]. "</td>";
                                echo "<td>". $paciente["dataNascimento"]. "</td>";
                                echo "<td>". $paciente["dataCadastro"]. "</td>";
                                echo "<td><a href='listarPacientes.php?consultas=".$paciente["id"]."'><button id=".$paciente["id"]." name='consulta' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal' class='btn btn-primary consultas'>Ver consultas consultas</button>"."</td>";
                                echo "<td><a href='listarPacientes.php?deletarPaciente=".$paciente["id"]."'><button class='btn btn-primary deletar'>Deletar Pessoa</button></a>"."</td>";
                                echo "<td><a href='editarPaciente.php?id=".$paciente["id"]."'><button class='btn btn-primary editar'>Editar Pessoa</button></a>"."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Consultas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Medico</th>
                            <th>Paciente</th>
                            <th>Data</th>
                            <th>Cancelar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_GET["consultas"]) and !empty($_GET["consultas"])) {
                                if (Consulta::verificaSeExisteIdPaciente($_GET["consultas"])) {
                                    $listaConsulta = Consulta::listaConsultas($_GET["consultas"]);
                                    $nomePaciente = Pacientes::getPessoa($_GET["consultas"]);
                                    foreach ($listaConsulta as $consulta) {
                                        $nomeMedico = Medicos::getMedico($consulta["idMedico"]);
                                        echo "<tr>";
                                        echo "<td>". $nomeMedico["nome"]. "</td>";
                                        echo "<td>". $nomePaciente["nome"]. "</td>";
                                        echo "<td>". $consulta["data"]. "</td>";
                                        echo "<td><a href='listarPacientes.php?deletarConsulta=".$consulta["id"]."'><button class='btn btn-primary deletar'>Deletar Consulta</button></a>"."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='4'><h4>Nenhuma consulta</h4></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Ação para ocultar a div depois de 5 segundos -->
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#exampleModal').modal('show'); });
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $(".alert").fadeOut().empty(); 
                $(".alert").css({'border': 'none'});
                $(".alert-success").css({'background-color': 'unset'});
                $(".alert-danger").css({'background-color': 'unset'});
            }, 3000);
        }, false);
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>