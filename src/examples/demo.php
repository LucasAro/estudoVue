<?php
require_once '../autoLoad.php';

// Importa as classes com namespace
use PhpVue\Components\Button;
use PhpVue\Components\Popup;
use PhpVue\Components\Input;
use PhpVue\Core\ComponentsLoader;
// Carrega os componentes que serão usados na página
ComponentsLoader::load(['Button', 'Popup']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstração de Componentes Vue em PHP</title>
    <!-- Font Awesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .demo-section {
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            padding-bottom: 30px;
        }
        .demo-section h2 {
            margin-bottom: 20px;
            color: #555;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        .code-block {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-family: monospace;
            white-space: pre-wrap;
            font-size: 14px;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Demonstração de Componentes Vue em PHP</h1>

        <div id="app">
            <!-- Seção de Demonstração de Botões -->
            <div class="demo-section">
                <h2>Componente Button</h2>
                <div class="button-container">
                    <vue-button text="Botão Padrão" @click="showMessage('Botão padrão clicado!')"></vue-button>
                    <vue-button text="Com Ícone" left-icon="check" @click="showMessage('Botão com ícone clicado!')"></vue-button>
                    <vue-button text="Cancelar" type="cancel" @click="showMessage('Botão cancelar clicado!')"></vue-button>
                    <vue-button text="Carregando" :loading="true"></vue-button>
                    <vue-button text="Desabilitado" :disabled="true"></vue-button>
                </div>

                <div class="code-block">
// Exemplo de uso do componente VueButton
&lt;vue-button text="Botão Padrão" @click="showMessage('Botão padrão clicado!')"&gt;&lt;/vue-button&gt;
&lt;vue-button text="Com Ícone" left-icon="check" @click="showMessage('Botão com ícone clicado!')"&gt;&lt;/vue-button&gt;
&lt;vue-button text="Cancelar" type="cancel" @click="showMessage('Botão cancelar clicado!')"&gt;&lt;/vue-button&gt;
&lt;vue-button text="Carregando" :loading="true"&gt;&lt;/vue-button&gt;
&lt;vue-button text="Desabilitado" :disabled="true"&gt;&lt;/vue-button&gt;
                </div>
            </div>

            <!-- Seção de Demonstração de Popup -->
            <div class="demo-section">
                <h2>Componente Popup</h2>
                <div class="button-container">
                    <vue-button text="Abrir Popup Simples" @click="openSimplePopup"></vue-button>
                    <vue-button text="Popup com HTML" @click="openHtmlPopup"></vue-button>
                    <vue-button text="Popup Personalizado" @click="openCustomPopup"></vue-button>
                </div>

                <!-- Popups de demonstração -->
                <vue-popup
                    title="Popup Simples"
                    message="Este é um popup básico com texto simples."
                    :show-popup="popupSimples"
                    @confirm="confirmSimplePopup"
                    @cancel="closeSimplePopup">
                </vue-popup>

                <vue-popup
                    title="Popup com HTML"
                    :use-html-content="true"
                    html-content="<h3>Conteúdo em HTML</h3><p>Este popup <strong>suporta</strong> conteúdo em <em>HTML</em>.</p><ul><li>Item 1</li><li>Item 2</li></ul>"
                    :show-popup="popupHtml"
                    @confirm="closeHtmlPopup"
                    @cancel="closeHtmlPopup">
                </vue-popup>

                <vue-popup
                    title="Configurações"
                    :use-html-content="true"
                    html-content="<p>Deseja salvar as configurações?</p>"
                    :show-popup="popupCustom"
                    confirm-text="Salvar Configurações"
                    cancel-text="Não Salvar"
                    @confirm="confirmCustomPopup"
                    @cancel="closeCustomPopup">
                </vue-popup>

                <div class="code-block">
// Exemplo de uso do componente VuePopup
&lt;vue-popup
    title="Popup Simples"
    message="Este é um popup básico com texto simples."
    :show-popup="popupSimples"
    @confirm="confirmPopup"
    @cancel="closePopup"&gt;
&lt;/vue-popup&gt;

// Popup com conteúdo HTML
&lt;vue-popup
    title="Popup com HTML"
    :use-html-content="true"
    html-content="&lt;h3&gt;Conteúdo em HTML&lt;/h3&gt;&lt;p&gt;Este popup suporta HTML.&lt;/p&gt;"
    :show-popup="popupHtml"
    @confirm="closePopup"
    @cancel="closePopup"&gt;
&lt;/vue-popup&gt;
                </div>
            </div>
        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php echo ComponentsLoader::renderVueApp('demoApp'); ?>

        // Personalização da aplicação Vue
        demoApp.config.globalProperties = {
            ...demoApp.config.globalProperties,

            // Estados para gerenciar os popups
            popupSimples: Vue.ref(false),
            popupHtml: Vue.ref(false),
            popupCustom: Vue.ref(false),

            // Funções para os botões
            showMessage(message) {
                alert(message);
            },

            // Funções para o popup simples
            openSimplePopup() {
                this.popupSimples.value = true;
            },

            confirmSimplePopup() {
                alert('Popup confirmado!');
                this.closeSimplePopup();
            },

            closeSimplePopup() {
                this.popupSimples.value = false;
            },

            // Funções para o popup com HTML
            openHtmlPopup() {
                this.popupHtml.value = true;
            },

            closeHtmlPopup() {
                this.popupHtml.value = false;
            },

            // Funções para o popup personalizado
            openCustomPopup() {
                this.popupCustom.value = true;
            },

            confirmCustomPopup() {
                alert('Configurações salvas!');
                this.closeCustomPopup();
            },

            closeCustomPopup() {
                this.popupCustom.value = false;
            }
        };
    </script>
</body>
</html>