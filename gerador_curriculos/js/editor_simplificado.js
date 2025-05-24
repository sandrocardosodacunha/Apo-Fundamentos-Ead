$(document).ready(function() {
    // Função genérica para adicionar itens dinâmicos
    function adicionarItem(containerId, templateHtml) {
        $(containerId).append(templateHtml);
    }

    // Função genérica para remover itens dinâmicos (o item pai do botão remover)
    $(document).on("click", ".remover-item", function() {
        $(this).closest(".border.rounded").remove();
    });

    // Adicionar Experiência
    $("#addExperienciaSimplificado").click(function() {
        const templateExperiencia = `
        <div class="experiencia-item mb-3 p-3 border rounded">
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
        </div>`;
        adicionarItem("#experienciasContainerSimplificado", templateExperiencia);
    });

    // Adicionar Formação
    $("#addFormacaoSimplificado").click(function() {
        const templateFormacao = `
        <div class="formacao-item mb-3 p-3 border rounded">
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
        </div>`;
        adicionarItem("#formacoesContainerSimplificado", templateFormacao);
    });

    // Adicionar Idioma
    $("#addIdiomaSimplificado").click(function() {
        const templateIdioma = `
        <div class="idioma-item mb-3 p-3 border rounded">
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
        </div>`;
        adicionarItem("#idiomasContainerSimplificado", templateIdioma);
    });

    // Adicionar Curso
    $("#addCursoSimplificado").click(function() {
        const templateCurso = `
        <div class="curso-item mb-3 p-3 border rounded">
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
                    <input type="text" class="form-control" name="curso_ano[]" placeholder="Ex: 2023">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm remover-item"><i class="bi bi-trash"></i> Remover</button>
            <hr>
        </div>`;
        adicionarItem("#cursosContainerSimplificado", templateCurso);
    });

    // Validação do formulário
    $("#curriculoFormSimplificado").on("submit", function(event) {
        let isValid = true;

        // Validação Nome Completo (obrigatório)
        const nomeCompleto = $("#nomeCompleto").val().trim();
        if (nomeCompleto === "") {
            alert("O campo Nome Completo é obrigatório.");
            $("#nomeCompleto").focus();
            isValid = false;
        }

        // Validação Email
        const emailInput = $("#email");
        const emailError = $("#emailError");
        const emailRegex = /^\S+@\S+\.\S+$/;
        if (emailInput.val().trim() !== "" && !emailRegex.test(emailInput.val().trim())) {
            emailInput.addClass("is-invalid");
            emailError.text("Por favor, insira um e-mail válido.");
            isValid = false;
        } else {
            emailInput.removeClass("is-invalid");
            emailError.text("");
        }

        // Validação Telefone (permite formatos brasileiros comuns)
        const telefoneInput = $("#telefone");
        const telefoneError = $("#telefoneError");
        const telefoneRegex = /^(\(\d{2}\)\s?)?(\d{4,5}-?\d{4})$/;
        if (telefoneInput.val().trim() !== "" && !telefoneRegex.test(telefoneInput.val().trim())) {
            telefoneInput.addClass("is-invalid");
            telefoneError.text("Telefone inválido. Use um formato brasileiro válido: (XX) XXXXX-XXXX ou XX XXXXX-XXXX.");
            isValid = false;
        } else {
            telefoneInput.removeClass("is-invalid");
            telefoneError.text("");
        }

        if (!isValid) {
            event.preventDefault(); // Impede o submit do formulário
        }
        return isValid; // Permite o submit se tudo estiver válido
    });

});

