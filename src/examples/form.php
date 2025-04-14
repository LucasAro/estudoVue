<?php
// Carrega o autoloader manual
require_once '../autoLoad.php';

// Importa as classes com namespace
use PhpVue\Components\Button;
use PhpVue\Components\Popup;
use PhpVue\Components\Input;
use PhpVue\Core\ComponentsLoader;

// Carrega os componentes que serão usados na página
// Podemos usar o nome da classe com ::class para maior segurança
ComponentsLoader::load([Button::class, Popup::class, Input::class]);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstração - Vue Components</title>
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
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        .section-title {
            margin: 30px 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #555;
            font-size: 18px;
        }
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
        }
        .form-column {
            flex: 1;
        }
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Demonstração de Componentes Vue</h1>

        <div id="app">
            <!-- Formulário usando o componente Input -->
            <h2 class="section-title">Formulário com Componente Input</h2>

            <div class="form-row">
                <div class="form-column">
                    <!-- Input com label -->
                    <vue-input
                        label="Nome Completo"
                        v-model="nome"
                        placeholder="Digite seu nome completo"
                        required
                        @clear="handleNomeClear"
                    ></vue-input>
                </div>

                <div class="form-column">
                    <!-- Input com label -->
                    <vue-input
                        label="Email"
                        v-model="email"
                        type="email"
                        placeholder="Digite seu email"
                        required
                        @clear="handleEmailClear"
                    ></vue-input>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <!-- Input sem label -->
                    <vue-input
                        v-model="telefone"
                        placeholder="Telefone"
                        @clear="handleTelefoneClear"
                    ></vue-input>
                </div>

                <div class="form-column">
                    <!-- Input sem label e sem botão de limpar -->
                    <vue-input
                        v-model="codigo"
                        placeholder="Código de acesso"
                        type="password"
                        :show-clear-button="false"
                    ></vue-input>
                </div>
            </div>

            <!-- Input de mensagem -->
            <vue-input
                label="Mensagem"
                v-model="mensagem"
                placeholder="Digite sua mensagem (opcional)"
                @clear="handleMensagemClear"
            ></vue-input>

            <!-- Input desabilitado -->
            <vue-input
                label="Campo Desabilitado"
                v-model="campoDesabilitado"
                placeholder="Este campo está desabilitado"
                :disabled="true"
            ></vue-input>

            <!-- Demonstração dos botões -->
            <div class="button-container">
                <vue-button
                    text="Abrir Popup"
                    left-icon="bell"
                    @click="showPopup = true"
                ></vue-button>

                <vue-button
                    text="Botão com Loading"
                    :loading="isLoading"
                    @click="toggleLoading"
                ></vue-button>

                <vue-button
                    text="Limpar Formulário"
                    type="cancel"
                    right-icon="eraser"
                    @click="limparForm"
                ></vue-button>
            </div>

            <!-- Demonstração do popup -->
            <vue-popup
                title="Informações do Formulário"
                :use-html-content="true"
                :html-content="popupContent"
                :show-popup="showPopup"
                @confirm="confirmarPopup"
                @cancel="showPopup = false"
            ></vue-popup>
        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php
        // Renderiza a aplicação Vue com todos os componentes automaticamente
        echo ComponentsLoader::renderVueApp('formApp');
        ?>

        // Personalização da aplicação Vue
        formApp.config.globalProperties = {
            ...formApp.config.globalProperties,

            // Dados do formulário
            nome: Vue.ref(''),
            email: Vue.ref(''),
            telefone: Vue.ref(''),
            codigo: Vue.ref(''),
            mensagem: Vue.ref(''),
            campoDesabilitado: Vue.ref('Valor fixo'),

            // Estados
            showPopup: Vue.ref(false),
            isLoading: Vue.ref(false),

            // Conteúdo HTML para o popup
            popupContent: Vue.computed(() => {
                return `
                    <div style="text-align: left;">
                        <p><strong>Nome:</strong> ${formApp.config.globalProperties.nome.value || '(não preenchido)'}</p>
                        <p><strong>Email:</strong> ${formApp.config.globalProperties.email.value || '(não preenchido)'}</p>
                        <p><strong>Telefone:</strong> ${formApp.config.globalProperties.telefone.value || '(não preenchido)'}</p>
                        <p><strong>Código:</strong> ${formApp.config.globalProperties.codigo.value ? '********' : '(não preenchido)'}</p>
                        <p><strong>Mensagem:</strong> ${formApp.config.globalProperties.mensagem.value || '(não preenchido)'}</p>
                    </div>
                `;
            }),

            // Funções
            toggleLoading() {
                this.isLoading.value = true;

                // Simula uma operação que demora 2 segundos
                setTimeout(() => {
                    this.isLoading.value = false;
                    alert('Operação concluída!');
                }, 2000);
            },

            limparForm() {
                this.nome.value = '';
                this.email.value = '';
                this.telefone.value = '';
                this.codigo.value = '';
                this.mensagem.value = '';
            },

            confirmarPopup() {
                this.showPopup.value = false;
                alert('Informações confirmadas!');
            },

            // Handlers para os eventos de clear dos componentes
            handleNomeClear() {
                console.log('Nome foi limpo');
            },

            handleEmailClear() {
                console.log('Email foi limpo');
            },

            handleTelefoneClear() {
                console.log('Telefone foi limpo');
            },

            handleMensagemClear() {
                console.log('Mensagem foi limpa');
            }
        };
    </script>
</body>
</html>