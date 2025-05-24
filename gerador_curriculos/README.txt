# Gerador de Currículos Online (Versão Simplificada)

Este projeto é uma aplicação web simples para criar currículos de forma rápida e direta, sem a necessidade de cadastro ou login. O usuário preenche seus dados em um editor intuitivo e pode visualizar o currículo formatado em uma nova guia, pronto para impressão ou para ser salvo como PDF diretamente pelo navegador.

## Funcionalidades Principais

*   **Criação Direta:** Acesse e comece a criar seu currículo imediatamente.
*   **Editor Intuitivo:** Interface organizada em abas para preenchimento de:
    *   Dados Pessoais (com opção de upload de foto)
    *   Resumo Profissional / Objetivo
    *   Experiência Profissional (com adição e remoção dinâmica de múltiplas entradas)
    *   Formação Acadêmica (com adição e remoção dinâmica de múltiplas entradas)
    *   Habilidades
    *   Idiomas (com adição e remoção dinâmica)
    *   Cursos Complementares / Certificações (com adição e remoção dinâmica)
*   **Upload de Foto:** Permite adicionar uma foto ao currículo (formatos JPG, PNG, JPEG, até 2MB).
*   **Visualização em Nova Guia:** Ao finalizar, o currículo é exibido em uma nova guia do navegador, formatado e pronto.
*   **Pronto para Impressão/PDF:** Utilize as funcionalidades do seu navegador (Ctrl+P ou Cmd+P) para imprimir ou salvar o currículo como PDF.
*   **Design Responsivo:** A interface do editor e a visualização do currículo são adaptáveis a diferentes tamanhos de tela.

## Tecnologias Utilizadas

*   **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript, jQuery
*   **Backend:** PHP (para processamento dos dados do formulário e geração da visualização do currículo)
*   **Ambiente de Desenvolvimento Sugerido:** XAMPP (Apache, PHP, MariaDB)

## Configuração e Execução (Usando XAMPP)

1.  **Pré-requisitos:**
    *   XAMPP instalado (ou qualquer outro servidor web com PHP).

2.  **Instalação:**
    *   Baixe os arquivos do projeto (geralmente em um arquivo .zip).
    *   Extraia a pasta do projeto (ex: `gerador_curriculos_simplificado`) para dentro da pasta `htdocs` da sua instalação do XAMPP.
        *   Exemplo no Windows: `C:\xampp\htdocs\gerador_curriculos_simplificado\`
        *   Exemplo no macOS: `/Applications/XAMPP/htdocs/gerador_curriculos_simplificado/`
        *   Exemplo no Linux: `/opt/lampp/htdocs/gerador_curriculos_simplificado/`
    *   Certifique-se de que a pasta `uploads_simplificado` dentro de `gerador_curriculos_simplificado` tenha permissão de escrita pelo servidor web. No XAMPP padrão, isso geralmente já está configurado, mas pode ser necessário ajustar em alguns sistemas.

3.  **Inicie o XAMPP:**
    *   Abra o Painel de Controle do XAMPP.
    *   Inicie os módulos **Apache**.

4.  **Acesse a Aplicação:**
    *   Abra seu navegador de internet.
    *   Digite a URL: `http://localhost/gerador_curriculos_simplificado/`
    *   Isso deve carregar a página inicial do Gerador de Currículos.

## Estrutura de Pastas

```
gerador_curriculos_simplificado/
├── css/
│   └── style.css             # Folha de estilos principal
├── js/
│   └── editor_simplificado.js # Scripts para campos dinâmicos e interações
├── php_processing/
│   └── processa_curriculo_simplificado.php # Script PHP para gerar o currículo
├── uploads_simplificado/       # Pasta para armazenar as fotos enviadas (requer permissão de escrita)
├── index.php                   # Página inicial
├── editor.php                  # Página do editor de currículo
└── README.md                   # Este arquivo
```

## Como Usar

1.  Acesse a página inicial (`index.php`).
2.  Clique em "Criar Meu Currículo Agora".
3.  Você será direcionado para o `editor.php`.
4.  Preencha todas as seções do formulário. Utilize os botões "Adicionar" para incluir múltiplas entradas em seções como Experiência e Formação.
5.  Se desejar, faça o upload de uma foto de perfil.
6.  Ao finalizar, clique em "Gerar Currículo para Visualização".
7.  Uma nova guia do navegador será aberta com seu currículo formatado.
8.  Use as opções do navegador (Arquivo > Imprimir, ou Ctrl+P/Cmd+P) para imprimir ou salvar como PDF.

## Observações

*   Este projeto é uma versão simplificada e não inclui funcionalidades como salvamento de currículos em banco de dados ou contas de usuário.
*   O upload de fotos é funcional, mas para um ambiente de produção, seriam necessárias medidas de segurança adicionais (validação mais robusta, sanitização de nomes de arquivo, etc.).

---

Desenvolvido como parte de um projeto de aprendizado.

