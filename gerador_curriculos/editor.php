<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de Currículo - Gerador Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="bg-light py-3 mb-4">
        <div class="container text-center">
            <h1>Editor de Currículo</h1>
        </div>
    </header>

    <main class="container mt-4">
        <form id="curriculoFormSimplificado" action="php_processing/processa_curriculo_simplificado.php" method="POST" enctype="multipart/form-data" target="_blank"> <!-- target="_blank" para abrir em nova guia -->

            <!-- Abas de Navegação -->
            <ul class="nav nav-tabs mb-3" id="editorTabsSimplificado" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="dados-pessoais-simplificado-tab" data-bs-toggle="tab" data-bs-target="#dados-pessoais-simplificado" type="button" role="tab" aria-controls="dados-pessoais-simplificado" aria-selected="true">Dados Pessoais</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="resumo-profissional-simplificado-tab" data-bs-toggle="tab" data-bs-target="#resumo-profissional-simplificado" type="button" role="tab" aria-controls="resumo-profissional-simplificado" aria-selected="false">Resumo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="experiencia-simplificado-tab" data-bs-toggle="tab" data-bs-target="#experiencia-simplificado" type="button" role="tab" aria-controls="experiencia-simplificado" aria-selected="false">Experiência</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="formacao-simplificado-tab" data-bs-toggle="tab" data-bs-target="#formacao-simplificado" type="button" role="tab" aria-controls="formacao-simplificado" aria-selected="false">Formação</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="habilidades-simplificado-tab" data-bs-toggle="tab" data-bs-target="#habilidades-simplificado" type="button" role="tab" aria-controls="habilidades-simplificado" aria-selected="false">Habilidades</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="idiomas-simplificado-tab" data-bs-toggle="tab" data-bs-target="#idiomas-simplificado" type="button" role="tab" aria-controls="idiomas-simplificado" aria-selected="false">Idiomas</button>
                </li>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cursos-simplificado-tab" data-bs-toggle="tab" data-bs-target="#cursos-simplificado" type="button" role="tab" aria-controls="cursos-simplificado" aria-selected="false">Cursos</button>
                </li>
            </ul>

            <!-- Conteúdo das Abas -->
            <div class="tab-content" id="editorTabsSimplificadoContent">
                <!-- Dados Pessoais -->
                <div class="tab-pane fade show active" id="dados-pessoais-simplificado" role="tabpanel" aria-labelledby="dados-pessoais-simplificado-tab">
                    <h4 class="mb-3">Dados Pessoais</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomeCompleto" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone">
                            <div class="invalid-feedback" id="telefoneError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="linkedin" class="form-label">LinkedIn (URL)</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço Completo</label>
                        <input type="text" class="form-control" id="endereco" name="endereco">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto (opcional)</label>
                        <input class="form-control" type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg">
                    </div>
                </div>

                <!-- Resumo Profissional -->
                <div class="tab-pane fade" id="resumo-profissional-simplificado" role="tabpanel" aria-labelledby="resumo-profissional-simplificado-tab">
                    <h4 class="mb-3">Resumo Profissional / Objetivo</h4>
                    <textarea class="form-control" id="resumo" name="resumo" rows="5"></textarea>
                </div>

                <!-- Experiência Profissional -->
                <div class="tab-pane fade" id="experiencia-simplificado" role="tabpanel" aria-labelledby="experiencia-simplificado-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Experiência Profissional</h4>
                        <button type="button" class="btn btn-success btn-sm" id="addExperienciaSimplificado"><i class="bi bi-plus-circle"></i> Adicionar Experiência</button>
                    </div>
                    <div id="experienciasContainerSimplificado">
                        <!-- Template para Experiência (será clonado por JS) -->
                        <div class="experiencia-item-template mb-3 p-3 border rounded" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Cargo/Função</label>
                                    <input type="text" class="form-control" name="exp_cargo[]">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Empresa</label>
                                    <input type="text" class="form-control" name="exp_empresa[]">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Localidade (Cidade/Estado)</label>
                                    <input type="text" class="form-control" name="exp_local[]">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Período (Ex: Jan 2020 - Dez 2022)</label>
                                    <input type="text" class="form-control" name="exp_periodo[]">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Descrição das Responsabilidades</label>
                                <textarea class="form-control" name="exp_descricao[]" rows="3"></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remover-item"><i class="bi bi-trash"></i> Remover</button>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Formação Acadêmica -->
                <div class="tab-pane fade" id="formacao-simplificado" role="tabpanel" aria-labelledby="formacao-simplificado-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Formação Acadêmica</h4>
                        <button type="button" class="btn btn-success btn-sm" id="addFormacaoSimplificado"><i class="bi bi-plus-circle"></i> Adicionar Formação</button>
                    </div>
                    <div id="formacoesContainerSimplificado">
                         <!-- Template para Formacao (será clonado por JS) -->
                        <div class="formacao-item-template mb-3 p-3 border rounded" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Curso/Título Obtido</label>
                                    <input type="text" class="form-control" name="form_curso[]">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Instituição de Ensino</label>
                                    <input type="text" class="form-control" name="form_instituicao[]">
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Localidade</label>
                                    <input type="text" class="form-control" name="form_local[]">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Período (Ex: 2018 - 2022 ou Cursando)</label>
                                    <input type="text" class="form-control" name="form_periodo[]">
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remover-item"><i class="bi bi-trash"></i> Remover</button>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Habilidades -->
                <div class="tab-pane fade" id="habilidades-simplificado" role="tabpanel" aria-labelledby="habilidades-simplificado-tab">
                    <h4 class="mb-3">Habilidades</h4>
                    <p><small>Liste suas principais habilidades. Separe por vírgula ou adicione uma por linha.</small></p>
                    <textarea class="form-control" id="habilidadesTexto" name="habilidadesTexto" rows="5"></textarea>
                </div>

                <!-- Idiomas -->
                <div class="tab-pane fade" id="idiomas-simplificado" role="tabpanel" aria-labelledby="idiomas-simplificado-tab">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Idiomas</h4>
                        <button type="button" class="btn btn-success btn-sm" id="addIdiomaSimplificado"><i class="bi bi-plus-circle"></i> Adicionar Idioma</button>
                    </div>
                    <div id="idiomasContainerSimplificado">
                        <!-- Template para Idioma (será clonado por JS) -->
                        <div class="idioma-item-template mb-3 p-3 border rounded" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Idioma</label>
                                    <input type="text" class="form-control" name="idioma_nome[]">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Nível de Proficiência</label>
                                    <select class="form-select" name="idioma_nivel[]">
                                        <option value="Básico">Básico</option>
                                        <option value="Intermediário">Intermediário</option>
                                        <option value="Avançado">Avançado</option>
                                        <option value="Fluente">Fluente</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remover-item"><i class="bi bi-trash"></i> Remover</button>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Cursos Complementares -->
                <div class="tab-pane fade" id="cursos-simplificado" role="tabpanel" aria-labelledby="cursos-simplificado-tab">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Cursos Complementares / Certificações</h4>
                        <button type="button" class="btn btn-success btn-sm" id="addCursoSimplificado"><i class="bi bi-plus-circle"></i> Adicionar Curso</button>
                    </div>
                    <div id="cursosContainerSimplificado">
                        <!-- Template para Curso (será clonado por JS) -->
                        <div class="curso-item-template mb-3 p-3 border rounded" style="display: none;">
                            <div class="row">
                                <div class="col-md-7 mb-2">
                                    <label class="form-label">Nome do Curso/Certificação</label>
                                    <input type="text" class="form-control" name="curso_nome[]">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Instituição</label>
                                    <input type="text" class="form-control" name="curso_instituicao[]">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Ano</label>
                                    <input type="text" class="form-control" name="curso_ano[]">
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remover-item"><i class="bi bi-trash"></i> Remover</button>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> Voltar ao Início</a>
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-eye"></i> Gerar Currículo para Visualização</button>
            </div>
        </form>
    </main>

    <footer class="bg-light text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 Gerador de Currículos Online.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script Personalizado -->
    <script src="js/editor_simplificado.js"></script>
</body>
</html>
