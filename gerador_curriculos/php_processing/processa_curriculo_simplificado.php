<?php
// php_processing/processa_curriculo_simplificado.php

// Função simples para sanitizar output (evitar XSS básico)
function sanitize_output($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// --- Configurações de Upload ---
$uploadDir = '../uploads_simplificado/'; // Relativo ao script processa_curriculo_simplificado.php
$allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'jpeg' => 'image/jpeg'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

// --- Coleta de dados do formulário ---
$nomeCompleto = isset($_POST['nomeCompleto']) ? sanitize_output($_POST['nomeCompleto']) : 'Não informado';
$email = isset($_POST['email']) ? sanitize_output($_POST['email']) : 'Não informado';
$telefone = isset($_POST['telefone']) ? sanitize_output($_POST['telefone']) : 'Não informado';
$linkedin = isset($_POST['linkedin']) ? sanitize_output($_POST['linkedin']) : '';
$endereco = isset($_POST['endereco']) ? sanitize_output($_POST['endereco']) : 'Não informado';
$resumo = isset($_POST['resumo']) ? nl2br(sanitize_output($_POST['resumo'])) : '';
$habilidadesTexto = isset($_POST['habilidadesTexto']) ? nl2br(sanitize_output($_POST['habilidadesTexto'])) : '';

// --- Processamento da Foto ---
$fotoPathParaDisplay = '';
$uploadMessage = '';

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = $_FILES['foto']['name'];
    $fileSize = $_FILES['foto']['size'];
    $fileType = $_FILES['foto']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    if (!in_array($fileExtension, array_keys($allowedTypes)) || !in_array($fileType, $allowedTypes)) {
        $uploadMessage = "Erro: Tipo de arquivo não permitido.";
    } elseif ($fileSize > $maxFileSize) {
        $uploadMessage = "Erro: Arquivo muito grande. Máximo de 2MB.";
    } else {
        $dest_path = $uploadDir . $newFileName;
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $fotoPathParaDisplay = $dest_path;
        } else {
            $uploadMessage = "Erro ao mover o arquivo enviado.";
        }
    }
} elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE && $_FILES['foto']['error'] != UPLOAD_ERR_OK) {
    $uploadMessage = "Erro no upload do arquivo: Código " . $_FILES['foto']['error'];
}

// --- Experiências Profissionais ---
$experiencias = [];
if (isset($_POST['exp_cargo']) && is_array($_POST['exp_cargo'])) {
    for ($i = 0; $i < count($_POST['exp_cargo']); $i++) {
        $cargo = isset($_POST['exp_cargo'][$i]) ? sanitize_output($_POST['exp_cargo'][$i]) : '';
        $empresa = isset($_POST['exp_empresa'][$i]) ? sanitize_output($_POST['exp_empresa'][$i]) : '';
        if (!empty($cargo) || !empty($empresa)) {
            $experiencias[] = [
                'cargo' => $cargo,
                'empresa' => $empresa,
                'local' => isset($_POST['exp_local'][$i]) ? sanitize_output($_POST['exp_local'][$i]) : '',
                'periodo' => isset($_POST['exp_periodo'][$i]) ? sanitize_output($_POST['exp_periodo'][$i]) : '',
                'descricao' => isset($_POST['exp_descricao'][$i]) ? nl2br(sanitize_output($_POST['exp_descricao'][$i])) : ''
            ];
        }
    }
}

// --- Formações Acadêmicas ---
$formacoes = [];
if (isset($_POST['form_curso']) && is_array($_POST['form_curso'])) {
    for ($i = 0; $i < count($_POST['form_curso']); $i++) {
        $curso = isset($_POST['form_curso'][$i]) ? sanitize_output($_POST['form_curso'][$i]) : '';
        $instituicao = isset($_POST['form_instituicao'][$i]) ? sanitize_output($_POST['form_instituicao'][$i]) : '';
        if (!empty($curso) || !empty($instituicao)) {
            $formacoes[] = [
                'curso' => $curso,
                'instituicao' => $instituicao,
                'local' => isset($_POST['form_local'][$i]) ? sanitize_output($_POST['form_local'][$i]) : '',
                'periodo' => isset($_POST['form_periodo'][$i]) ? sanitize_output($_POST['form_periodo'][$i]) : ''
            ];
        }
    }
}

// --- Idiomas ---
$idiomas = [];
if (isset($_POST['idioma_nome']) && is_array($_POST['idioma_nome'])) {
    for ($i = 0; $i < count($_POST['idioma_nome']); $i++) {
        $nome_idioma = isset($_POST['idioma_nome'][$i]) ? sanitize_output($_POST['idioma_nome'][$i]) : '';
        if (!empty($nome_idioma)) {
            $idiomas[] = [
                'nome' => $nome_idioma,
                'nivel' => isset($_POST['idioma_nivel'][$i]) ? sanitize_output($_POST['idioma_nivel'][$i]) : ''
            ];
        }
    }
}

// --- Cursos Complementares ---
$cursos_comp = [];
if (isset($_POST['curso_nome']) && is_array($_POST['curso_nome'])) {
    for ($i = 0; $i < count($_POST['curso_nome']); $i++) {
        $nome_curso = isset($_POST['curso_nome'][$i]) ? sanitize_output($_POST['curso_nome'][$i]) : '';
        if(!empty($nome_curso)){
            $cursos_comp[] = [
                'nome' => $nome_curso,
                'instituicao' => isset($_POST['curso_instituicao'][$i]) ? sanitize_output($_POST['curso_instituicao'][$i]) : '',
                'ano' => isset($_POST['curso_ano'][$i]) ? sanitize_output($_POST['curso_ano'][$i]) : ''
            ];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Currículo - <?php echo $nomeCompleto; ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Incluindo html2pdf.js via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            background-color: #fff; /* Fundo branco para impressão */
        }
        .download-pdf-btn-container {
            text-align: center; /* Centraliza o botão */
            margin-top: 50px; /* Espaço acima do botão aumentado */
            margin-bottom: 30px; /* Espaço abaixo do botão */
        }
        .download-pdf-btn {
            display: inline-block; /* Para permitir margem auto e padding */
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        @media print {
            .download-pdf-btn-container {
                display: none !important;
            }
        }
    </style>
</head>
<body class="visualizacao-body"> 

    <div id="curriculoParaPdf" class="curriculo-visualizacao-container">
        <?php if (!empty($uploadMessage)): ?>
            <p style="color: red; text-align: center;"><?php echo $uploadMessage; ?></p>
        <?php endif; ?>

        <header class="cv-header">
            <?php if (!empty($fotoPathParaDisplay)): ?>
                <img src="<?php echo $fotoPathParaDisplay; ?>" alt="Foto de Perfil" class="cv-foto">
            <?php endif; ?>
            <h1><?php echo $nomeCompleto; ?></h1>
            <p>
                <?php 
                $contatoInfo = [];
                if($email !== 'Não informado' && !empty($email)){ $contatoInfo[] = $email; }
                if($telefone !== 'Não informado' && !empty($telefone)){ $contatoInfo[] = $telefone; }
                if($endereco !== 'Não informado' && !empty($endereco)){ $contatoInfo[] = $endereco; }
                echo implode(' | ', $contatoInfo);
                ?>
            </p>
            <p>
                <?php if(!empty($linkedin)): ?><a href="<?php echo $linkedin; ?>" target="_blank">LinkedIn</a><?php endif; ?>
            </p>
        </header>

        <?php if(!empty(trim($resumo))): ?>
        <section class="cv-section">
            <h4>Resumo Profissional</h4>
            <p><?php echo $resumo; ?></p>
        </section>
        <?php endif; ?>

        <?php if(!empty($experiencias)): ?>
        <section class="cv-section">
            <h4>Experiência Profissional</h4>
            <?php foreach($experiencias as $exp): ?>
                <div class="cv-item">
                    <h5><?php echo $exp['cargo']; ?><?php if(!empty($exp['empresa'])) echo ' - ' . $exp['empresa']; ?></h5>
                    <p class="periodo">
                        <?php 
                        $expLocalPeriodo = [];
                        if(!empty($exp['local'])) { $expLocalPeriodo[] = $exp['local']; }
                        if(!empty($exp['periodo'])) { $expLocalPeriodo[] = $exp['periodo']; }
                        echo implode(' | ', $expLocalPeriodo);
                        ?>
                    </p>
                    <?php if(!empty($exp['descricao'])): ?><p><?php echo $exp['descricao']; ?></p><?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php if(!empty($formacoes)): ?>
        <section class="cv-section">
            <h4>Formação Acadêmica</h4>
            <?php foreach($formacoes as $form): ?>
                <div class="cv-item">
                    <h5><?php echo $form['curso']; ?><?php if(!empty($form['instituicao'])) echo ' - ' . $form['instituicao']; ?></h5>
                    <p class="periodo">
                        <?php 
                        $formLocalPeriodo = [];
                        if(!empty($form['local'])) { $formLocalPeriodo[] = $form['local']; }
                        if(!empty($form['periodo'])) { $formLocalPeriodo[] = $form['periodo']; }
                        echo implode(' | ', $formLocalPeriodo);
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php if(!empty(trim($habilidadesTexto))): ?>
        <section class="cv-section">
            <h4>Habilidades</h4>
            <p><?php echo $habilidadesTexto; ?></p>
        </section>
        <?php endif; ?>

        <?php if(!empty($idiomas)): ?>
        <section class="cv-section">
            <h4>Idiomas</h4>
            <?php foreach($idiomas as $idioma): ?>
                <p><?php echo $idioma['nome']; ?><?php if(!empty($idioma['nivel'])) echo ' - ' . $idioma['nivel']; ?></p>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php if(!empty($cursos_comp)): ?>
        <section class="cv-section">
            <h4>Cursos Complementares / Certificações</h4>
            <?php foreach($cursos_comp as $curso): ?>
                 <div class="cv-item">
                    <p>
                        <strong><?php echo $curso['nome']; ?></strong>
                        <?php if(!empty($curso['instituicao'])) echo ' - ' . $curso['instituicao']; ?>
                        <?php if(!empty($curso['ano'])) echo ' (' . $curso['ano'] . ')'; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

    </div>

    <div class="download-pdf-btn-container">
        <button id="downloadPdfBtn" class="download-pdf-btn">Download PDF</button>
    </div>

    <script>
        document.getElementById('downloadPdfBtn').addEventListener('click', function () {
            const element = document.getElementById('curriculoParaPdf');
            const opt = {
                margin:       [0.5, 0.5, 0.5, 0.5], // top, left, bottom, right in inches
                filename:     'curriculo_<?php echo str_replace(" ", "_", $nomeCompleto); ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true }, // useCORS para imagens externas, se houver
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>
</html>

