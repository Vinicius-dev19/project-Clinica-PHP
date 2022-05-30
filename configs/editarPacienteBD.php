<?php
    require_once "configs/Pacientes.php";
    if (isset($_POST["cadastrar"])) {
        if (isset($_POST["id"]) and !empty($_POST["id"]) and isset($_POST["nome"]) and !empty($_POST["nome"]) and isset($_POST["data"])
        and !empty($_POST["data"]) and isset($_POST["idEspecialidade"]) and !empty($_POST["idEspecialidade"])) {
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $dataNasc = $_POST["data"];
            $especialidade = $_POST["idEspecialidade"];
            $_GET["id"] = $_POST["id"];
            $res = Pacientes::updatePaciente($id, $nome, $especialidade);
            if ($res) {
                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                        <div>
                            Medico editado com sucesso
                        </div>
                </div>";
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                        <div>
                            Erro ao editar paciente
                        </div>
                </div>";
            }
        }
    }
    
    if (isset($_GET["id"]) and !empty($_GET["id"])) {
        $id = $_GET["id"];
        $paciente = Pacientes::getPessoa($id);
        if ($paciente == null) {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Medico não encontrado
                    </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Medico não encontrado
                </div>
        </div>";
        exit;
    }
?>