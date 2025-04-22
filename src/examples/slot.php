<?php
// Carrega o autoloader manual
require_once '../autoLoad.php';

// Importa as classes com namespace
use PhpVue\Components\Button;
use PhpVue\Components\Popup;
use PhpVue\Components\Input;
use PhpVue\Core\ComponentsLoader;

// Carrega os componentes que serão usados na página
ComponentsLoader::load([Button::class, Popup::class, Input::class]);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstração - Componentes com Slots</title>
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
        .example-section {
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .section-title {
            margin: 20px 0 15px;
            color: #555;
            font-size: 18px;
        }
        .component-demo {
            margin: 15px 0;
            padding: 20px;
            border: 1px dashed #ddd;
            border-radius: 5px;
            background-color: #fafafa;
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
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
        }
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
        pre {
            background: #f8f8f8;
            padding: 10px;
            border-radius: 4px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Componentes com Slots</h1>

        <div id="app">
            <!-- EXEMPLO: BUTTONS COM SLOTS -->
            <div class="example-section">
                <h2 class="section-title">Botões com Slots</h2>

                <div class="component-demo">
                    <p>1. Botão com slot padrão:</p>
                    <vue-button>
                        <span>Botão Personalizado</span>
                        <span class="badge">Novo</span>
                    </vue-button>
                </div>

                <div class="component-demo">
                    <p>2. Botão com slots de ícones personalizados:</p>
                    <vue-button type="default">
                        <template v-slot:left-icon>
                            <div class="custom-icon">✓</div>
                        </template>
                        Confirmar
                        <template v-slot:right-icon>
                            <span style="font-size: 18px">👍</span>
                        </template>
                    </vue-button>
                </div>
            </div>

            <!-- EXEMPLO: INPUT COM SLOTS -->
            <div class="example-section">
                <h2 class="section-title">Input com Slots</h2>

                <div class="component-demo">
                    <p>1. Input com prefixo, sufixo e ajuda:</p>
                    <vue-input
                        v-model="email"
                        placeholder="Digite seu email"
                        label="Email"
                    >
                        <template v-slot:prefix>
                            <i class="fas fa-envelope" style="margin-right: 10px; color: #999;"></i>
                        </template>
                        <template v-slot:suffix>
                            <span style="margin-left: 5px; color: #999;">.com</span>
                        </template>
                        <template v-slot:helper>
                            <div class="error-message" v-if="!isValidEmail && email">
                                Por favor, digite um email válido
                            </div>
                        </template>
                    </vue-input>
                </div>

                <div class="component-demo">
                    <p>2. Input com label personalizado:</p>
                    <vue-input v-model="username" placeholder="Nome de usuário">
                        <template v-slot:label>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <span style="font-weight: bold; color: #333;">Nome de Usuário</span>
                                <span style="font-size: 12px; color: #999;">Min. 3 caracteres</span>
                            </div>
                        </template>
                    </vue-input>
                </div>
            </div>

            <!-- EXEMPLO: POPUP COM SLOTS -->
            <div class="example-section">
                <h2 class="section-title">Popup com Slots</h2>

                <vue-button @click="customPopup = true">
                    Abrir Popup com Slots
                </vue-button>

                <vue-popup :show-popup="customPopup" @cancel="customPopup = false" @confirm="handleConfirm">
                    <template v-slot:header>
                        <div style="display: flex; align-items: center; color: #333;">
                            <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                            <h3 style="margin: 0;">Informações Personalizadas</h3>
                        </div>
                    </template>

                    <div style="text-align: left;">
                        <h4>Usando slots para conteúdo personalizado</h4>
                        <p>Este popup usa slots para personalizar:</p>
                        <ul>
                            <li>O cabeçalho com um ícone</li>
                            <li>O conteúdo com formatação personalizada</li>
                            <li>Os botões de ação</li>
                        </ul>
                        <pre><code>{{ slotExample }}</code></pre>
                    </div>

                    <template v-slot:actions>
                        <button class="confirm-button" style="background-color: #4CAF50;" @click="handleConfirm">
                            <i class="fas fa-check" style="margin-right: 5px;"></i> Confirmar
                        </button>
                        <button class="cancel-button" style="background-color: #f44336;" @click="customPopup = false">
                            <i class="fas fa-times" style="margin-right: 5px;"></i> Cancelar
                        </button>
                    </template>
                </vue-popup>
            </div>

            <!-- DOCUMENTAÇÃO DE SLOTS -->
            <div class="example-section">
                <h2 class="section-title">Documentação de Slots</h2>
                <p>Slots disponíveis para cada componente:</p>

                <div class="component-demo">
                    <h3>Button</h3>
                    <ul>
                        <li><strong>default</strong>: Conteúdo principal do botão</li>
                        <li><strong>left-icon</strong>: Ícone à esquerda</li>
                        <li><strong>right-icon</strong>: Ícone à direita</li>
                    </ul>
                </div>

                <div class="component-demo">
                    <h3>Input</h3>
                    <ul>
                        <li><strong>label</strong>: Label personalizado</li>
                        <li><strong>prefix</strong>: Conteúdo antes do input</li>
                        <li><strong>input</strong>: Substitui o input padrão</li>
                        <li><strong>suffix</strong>: Conteúdo após o input</li>
                        <li><strong>clear-button</strong>: Botão de limpar personalizado</li>
                        <li><strong>helper</strong>: Texto de ajuda/erro abaixo do input</li>
                    </ul>
                </div>

                <div class="component-demo">
                    <h3>Popup</h3>
                    <ul>
                        <li><strong>default</strong>: Conteúdo principal do popup</li>
                        <li><strong>header</strong>: Cabeçalho personalizado</li>
                        <li><strong>close-button</strong>: Botão de fechar personalizado</li>
                        <li><strong>actions</strong>: Área de botões personalizada</li>
                        <li><strong>confirm-button</strong>: Botão de confirmar personalizado</li>
                        <li><strong>cancel-button</strong>: Botão de cancelar personalizado</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php echo ComponentsLoader::renderVueComponents(); ?>

        // Criar aplicação Vue manualmente com Composition API
        const { createApp, ref, computed } = Vue;

        createApp({
            components: {
                VueButton,
                VuePopup,
                VueInput
            },
            setup() {
                // Estado para input de email
                const email = ref('');
                const isValidEmail = computed(() => {
                    if (!email.value) return true;
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email.value);
                });

                // Estado para input de username
                const username = ref('');

                // Estado para popup
                const customPopup = ref(false);

                // Código de exemplo para mostrar no popup
                const slotExample = ref(`<vue-popup>
  <template v-slot:header>
    <div>Header personalizado</div>
  </template>

  Conteúdo personalizado

  <template v-slot:actions>
    <button>Botões personalizados</button>
  </template>
</vue-popup>`);

                // Métodos
                function handleConfirm() {
                    customPopup.value = false;
                    alert('Ação confirmada!');
                }

                // Retornar todos os estados e funções para o template
                return {
                    email,
                    isValidEmail,
                    username,
                    customPopup,
                    slotExample,
                    handleConfirm
                };
            }
        }).mount('#app');
    </script>
</body>
</html>