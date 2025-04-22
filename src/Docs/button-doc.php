<?php
// Carrega o autoloader
require_once '../autoLoad.php';
require_once '../Utils/Utils.php';

// Importa as classes necessárias
use PhpVue\Components\Button;
use PhpVue\Core\ComponentsLoader;

// Carrega o componente Button para poder acessar suas propriedades
ComponentsLoader::load([Button::class]);

// Função para formatar bloco de código
function formatCode($code) {
    return htmlspecialchars($code);
}

// Exemplo de uso simples do botão
$exampleSimple = '<vue-button text="Clique em mim" @click="minhaFuncao"></vue-button>';

// Exemplo com ícones
$exampleIcons = '<vue-button text="Confirmar" left-icon="check" @click="confirmar"></vue-button>
<vue-button text="Cancelar" type="cancel" right-icon="times" @click="cancelar"></vue-button>';

// Exemplo com estados
$exampleStates = '<vue-button text="Processando..." :loading="true"></vue-button>
<vue-button text="Indisponível" :disabled="true"></vue-button>';

// Exemplo com slots
$exampleSlots = '<vue-button @click="salvar">
    <!-- Slot padrão -->
    <span>Salvar Alterações</span>
    <span class="badge">Novo</span>
</vue-button>

<vue-button>
    <!-- Slot para ícone esquerdo -->
    <template v-slot:left-icon>
        <div class="custom-icon">✓</div>
    </template>
    Confirmar
</vue-button>';

// Exemplo completo
$exampleComplete = '// Carrega o componente Button
ComponentsLoader::load([Button::class]);

// No HTML
<div id="app">
    <vue-button
        text="Enviar"
        left-icon="paper-plane"
        :disabled="!formValido"
        :loading="enviando"
        @click="enviarFormulario"
    ></vue-button>
</div>

// Script para inicializar o Vue
<script type="module">
    <?php echo ComponentsLoader::renderVueComponents(); ?>

    // Criar aplicação Vue manualmente
    const { createApp, ref, computed } = Vue;

    // Criar e montar aplicação
    const minhaApp = createApp({
        components: {
            VueButton
        },
        setup() {
            // Estados
            const formValido = ref(true);
            const enviando = ref(false);

            // Métodos
            function enviarFormulario() {
                enviando.value = true;

                // Simulação de envio
                setTimeout(() => {
                    enviando.value = false;
                    alert("Formulário enviado com sucesso!");
                }, 2000);
            }

            return {
                formValido,
                enviando,
                enviarFormulario
            };
        }
    }).mount("#app");
</script>';

// Exemplo CSS para personalização de estilos
$styleExample = '/* Personalização de estilos */
.vue-button {
    background-color: #4CAF50; /* Verde */
    color: white;
    border-radius: 100px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.vue-button:hover:not(.disabled) {
    background-color: #3e8e41;
    transform: translateY(-2px);
}

.vue-button.cancel {
    background-color: #f44336;  /* Vermelho */
}';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação do Componente Button - PhpVue</title>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #dc3545;
            --background-color: #f5f5f5;
            --card-background: #ffffff;
            --text-color: #333333;
            --text-muted: #777777;
            --border-color: #e0e0e0;
            --code-background: #f8f9fa;
            --terminal-bg: #1e1e1e;
            --terminal-text: #f8f8f8;
            --terminal-header: #333333;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 30px 0;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .header p {
            font-size: 18px;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
        }

        .nav-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--text-color);
            text-decoration: none;
            border-radius: 100px;
            font-weight: bold;
        }

        .nav-link:hover {
            background-color: #e6ad00;
        }

        .section {
            background-color: var(--card-background);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .section h2 {
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .section h3 {
            margin-top: 25px;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        .props-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .props-table th,
        .props-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .props-table th {
            background-color: var(--code-background);
            font-weight: bold;
        }

        .props-table tr:hover {
            background-color: var(--code-background);
        }

        .type-tag {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            background-color: #e9ecef;
            font-family: monospace;
            font-size: 13px;
        }

        .example-container {
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .example-preview {
            padding: 20px;
            background-color: white;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-top: 15px;
        }

        .slots-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .slots-table th,
        .slots-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .slots-table th {
            background-color: var(--code-background);
            font-weight: bold;
        }

        .tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .tag.required {
            background-color: #ffc107;
            color: #333;
        }

        .tag.optional {
            background-color: #6c757d;
            color: white;
        }

        .events-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .events-table th,
        .events-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .events-table th {
            background-color: var(--code-background);
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .button-demo {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
            justify-content: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 6px;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px;
            font-size: 12px;
            margin-left: 5px;
        }

        .custom-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            color: #4CAF50;
        }

        /* Adicionar estilo para forçar os botões a ficarem em formato arredondado */
        .vue-button {
            border-radius: 100px !important;
        }

        /* Estilos para o terminal de código */
        .code-terminal {
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .code-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--terminal-header);
            padding: 8px 15px;
            color: #f0f0f0;
        }

        .language-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            color: #aaa;
        }

        .copy-button {
            background-color: transparent;
            border: 1px solid #555;
            border-radius: 4px;
            color: #f0f0f0;
            padding: 4px 10px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #777;
        }

        .copy-button i {
            margin-right: 5px;
        }

        .code-content {
            background-color: var(--terminal-bg);
            color: var(--terminal-text);
            padding: 15px;
            margin: 0;
            white-space: pre;
            overflow-x: auto;
            font-family: monospace;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Componente Button</h1>
            <p>Documentação completa do componente Button da biblioteca PhpVue</p>
            <a href="../../index.php" class="nav-link"><i class="fas fa-arrow-left"></i> Voltar para a página inicial</a>
        </div>

        <div id="app">
            <div class="section">
                <h2>Visão Geral</h2>
                <p>O componente <code>Button</code> é um botão interativo e altamente personalizável que pode ser utilizado em formulários, modais e interfaces diversas. Ele suporta diferentes estados (normal, desabilitado, carregando), ícones, e é completamente estilizável.</p>

                <div class="button-demo">
                    <vue-button text="Botão Padrão" @click="showMessage('Botão padrão clicado!')"></vue-button>
                    <vue-button text="Com Ícone" left-icon="check" @click="showMessage('Botão com ícone clicado!')"></vue-button>
                    <vue-button text="Cancelar" type="cancel" @click="showMessage('Botão cancelar clicado!')"></vue-button>
                    <vue-button text="Carregando" :loading="true"></vue-button>
                    <vue-button text="Desabilitado" :disabled="true"></vue-button>
                </div>
            </div>

            <div class="section">
                <h2>Propriedades (Props)</h2>
                <p>O componente <code>Button</code> aceita as seguintes propriedades:</p>

                <table class="props-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Padrão</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>text</td>
                            <td><span class="type-tag">String</span></td>
                            <td>"Button"</td>
                            <td>O texto a ser exibido no botão.</td>
                        </tr>
                        <tr>
                            <td>leftIcon</td>
                            <td><span class="type-tag">String</span></td>
                            <td>""</td>
                            <td>O nome do ícone do Font Awesome a ser exibido à esquerda do texto (sem o prefixo "fa-").</td>
                        </tr>
                        <tr>
                            <td>rightIcon</td>
                            <td><span class="type-tag">String</span></td>
                            <td>""</td>
                            <td>O nome do ícone do Font Awesome a ser exibido à direita do texto (sem o prefixo "fa-").</td>
                        </tr>
                        <tr>
                            <td>disabled</td>
                            <td><span class="type-tag">Boolean</span></td>
                            <td>false</td>
                            <td>Se o botão está desabilitado.</td>
                        </tr>
                        <tr>
                            <td>loading</td>
                            <td><span class="type-tag">Boolean</span></td>
                            <td>false</td>
                            <td>Se o botão está em estado de carregamento. Quando true, exibe um ícone de spinner e desabilita o botão.</td>
                        </tr>
                        <tr>
                            <td>type</td>
                            <td><span class="type-tag">String</span></td>
                            <td>"default"</td>
                            <td>O tipo do botão, afeta o estilo. Valores aceitos: "default", "cancel".</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>Slots</h2>
                <p>O componente <code>Button</code> suporta os seguintes slots para personalização:</p>

                <table class="slots-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>default</td>
                            <td>Conteúdo principal do botão. Substitui o texto padrão.</td>
                        </tr>
                        <tr>
                            <td>left-icon</td>
                            <td>Ícone personalizado à esquerda do texto. Só é renderizado se leftIcon não for definido.</td>
                        </tr>
                        <tr>
                            <td>right-icon</td>
                            <td>Ícone personalizado à direita do texto. Só é renderizado se rightIcon não for definido.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>Eventos</h2>
                <p>O componente <code>Button</code> emite os seguintes eventos:</p>

                <table class="events-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Parâmetros</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>click</td>
                            <td>event: MouseEvent</td>
                            <td>Emitido quando o botão é clicado. Não é emitido se o botão estiver desabilitado ou em estado de carregamento.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>Exemplos de Uso</h2>

                <h3>Uso Básico</h3>
                <?= createCodeBlock($exampleSimple, 'html') ?>
                <div class="example-preview" id="example-basic">
                    <vue-button text="Clique em mim" @click="minhaFuncao"></vue-button>
                </div>

                <h3>Com Ícones</h3>
                <?= createCodeBlock($exampleIcons, 'html') ?>
                <div class="example-preview" id="example-icons">
                    <vue-button text="Confirmar" left-icon="check" @click="confirmar"></vue-button>
                    <vue-button text="Cancelar" type="cancel" right-icon="times" @click="cancelar"></vue-button>
                </div>

                <h3>Estados</h3>
                <?= createCodeBlock($exampleStates, 'html') ?>
                <div class="example-preview">
                    <vue-button text="Processando..." :loading="true"></vue-button>
                    <vue-button text="Indisponível" :disabled="true"></vue-button>
                </div>

                <h3>Utilizando Slots</h3>
                <?= createCodeBlock($exampleSlots, 'html') ?>
                <div class="example-preview" id="example-slots">
                    <vue-button @click="salvar">
                        <span>Salvar Alterações</span>
                        <span class="badge">Novo</span>
                    </vue-button>

                    <vue-button>
                        <template v-slot:left-icon>
                            <div class="custom-icon">✓</div>
                        </template>
                        Confirmar
                    </vue-button>
                </div>

                <h3>Exemplo Completo</h3>
                <?= createCodeBlock($exampleComplete, 'html') ?>
            </div>

            <div class="section">
                <h2>Personalização de Estilos</h2>
                <p>O componente <code>Button</code> vem com estilos pré-definidos, mas você pode sobrescrever os estilos CSS para personalizar a aparência. Os principais seletores CSS são:</p>

                <ul>
                    <li><code>.vue-button</code> - O elemento base do botão</li>
                    <li><code>.vue-button.disabled</code> - Estilo aplicado quando o botão está desabilitado</li>
                    <li><code>.vue-button.loading</code> - Estilo aplicado quando o botão está em estado de carregamento</li>
                    <li><code>.vue-button.cancel</code> - Estilo aplicado para o tipo "cancel"</li>
                    <li><code>.vue-button .left-icon</code> - Estilo do ícone à esquerda</li>
                    <li><code>.vue-button .right-icon</code> - Estilo do ícone à direita</li>
                </ul>

                <p>Exemplo de personalização de estilos:</p>

                <?= createCodeBlock($styleExample, 'css') ?>
            </div>

            <div class="footer">
                <p>PhpVue - Documentação do Componente Button</p>
                <p><a href="index.php">Voltar para a página de documentação</a></p>
            </div>
        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php echo ComponentsLoader::renderVueComponents(); ?>

        // Criar aplicação Vue manualmente
        const { createApp, ref, computed } = Vue;

        // Criar e montar aplicação
        createApp({
            components: {
                VueButton
            },
            setup() {
                // Funções para demonstração
                function showMessage(message) {
                    alert(message);
                }

                function minhaFuncao() {
                    alert('Função básica executada!');
                }

                function confirmar() {
                    alert('Ação confirmada!');
                }

                function cancelar() {
                    alert('Ação cancelada!');
                }

                function salvar() {
                    alert('Alterações salvas!');
                }

                // Retornar todos os estados e funções
                return {
                    showMessage,
                    minhaFuncao,
                    confirmar,
                    cancelar,
                    salvar
                };
            }
        }).mount('#app');
    </script>
    <script src="../Utils/Utils.js"></script>
</body>
</html>