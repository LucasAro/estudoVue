<?php
// Carrega o autoloader
require_once '../autoLoad.php';
require_once '../Utils/Utils.php';

// Importa as classes com namespace
use PhpVue\Components\Button;
use PhpVue\Components\Datepicker;
use PhpVue\Core\ComponentsLoader;

// Carrega os componentes que serão usados na página
ComponentsLoader::load([Button::class, Datepicker::class]);

$exampleSlot = '
&lt;vue-datepicker v-model="data"&gt;
    &lt;!-- Label personalizado --&gt;
    &lt;template v-slot:label&gt;
        &lt;div class="custom-label"&gt;
            &lt;span&gt;Data do Evento&lt;/span&gt;
            &lt;i class="fas fa-question-circle"&gt;&lt;/i&gt;
        &lt;/div&gt;
    &lt;/template&gt;

    &lt;!-- Ícone personalizado --&gt;
    &lt;template v-slot:prefix&gt;
        &lt;div class="custom-prefix"&gt;
            &lt;i class="fas fa-birthday-cake"&gt;&lt;/i&gt;
        &lt;/div&gt;
    &lt;/template&gt;

    &lt;!-- Campo de entrada personalizado --&gt;
    &lt;template v-slot:input="slotProps"&gt;
        &lt;input
            type="date"
            :value="slotProps.modelValue"
            class="custom-input"
            @input="slotProps.updateDate($event.target.value)"
        /&gt;
    &lt;/template&gt;

    &lt;!-- Texto de ajuda ou erro --&gt;
    &lt;template v-slot:helper&gt;
        &lt;div class="helper-text"&gt;
            Selecione uma data válida
        &lt;/div&gt;
    &lt;/template&gt;
&lt;/vue-datepicker&gt;'
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstração - Datepicker com Slots</title>
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
        .example-block {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #fafafa;
        }
        .example-title {
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-column {
            flex: 1;
        }
        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        .result-container {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #e9ecef;
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
        /* Estilos personalizados para exemplos de slots */
        .custom-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .custom-label .label-text {
            font-weight: 600;
            color: #333;
        }
        .custom-label .help-icon {
            color: #6c757d;
            cursor: pointer;
        }
        .custom-prefix {
            position: absolute;
            left: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            background-color: #ffc107;
            border-radius: 50%;
            color: #333;
        }
        .custom-clear {
            position: absolute;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc3545;
            cursor: pointer;
        }
        .helper-text {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }
        .error-text {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
        }
        .custom-input {
            padding: 10px 35px 10px 40px !important;
            border: 2px solid #ffc107 !important;
            border-radius: 20px !important;
            background-color: #fff8e1 !important;
            color: #333 !important;
        }
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Estilos para tabela de slots */
        .slots-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .slots-table th, .slots-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .slots-table th {
            background-color: #fafafa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datepicker com Slots Personalizados</h1>

        <div id="app">
            <!-- Exemplo básico -->
            <div class="example-block">
                <div class="example-title">Uso Básico (sem slots)</div>
                <vue-datepicker
                    v-model="basicDate"
                    label="Data Básica"
                    @change="handleDateChange"
                ></vue-datepicker>
            </div>

            <!-- Exemplo com slot de label personalizado -->
            <div class="example-block">
                <div class="example-title">Com Label Personalizado</div>
                <vue-datepicker
                    v-model="labelDate"
                    @change="handleDateChange"
                >
                    <template v-slot:label>
                        <div class="custom-label">
                            <span class="label-text">Data do Evento</span>
                            <i class="fas fa-question-circle help-icon" @click="showHelp"></i>
                        </div>
                    </template>
                </vue-datepicker>
            </div>

            <!-- Exemplo com slot de ícone/prefixo personalizado -->
            <div class="example-block">
                <div class="example-title">Com Ícone Personalizado</div>
                <vue-datepicker
                    v-model="iconDate"
                    label="Data com Ícone Personalizado"
                    @change="handleDateChange"
                >
                    <template v-slot:prefix>
                        <div class="custom-prefix">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                    </template>
                </vue-datepicker>
            </div>

            <!-- Exemplo com slot de botão limpar personalizado -->
            <div class="example-block">
                <div class="example-title">Com Botão Limpar Personalizado</div>
                <vue-datepicker
                    v-model="clearDate"
                    label="Data com Botão Limpar Personalizado"
                    @change="handleDateChange"
                >
                    <template v-slot:clear-button="slotProps">
                        <div v-if="slotProps.modelValue && !slotProps.disabled"
                             class="custom-clear"
                             @click="slotProps.clearDate">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </template>
                </vue-datepicker>
            </div>

            <!-- Exemplo com slot de helper -->
            <div class="example-block">
                <div class="example-title">Com Texto de Ajuda</div>
                <vue-datepicker
                    v-model="helperDate"
                    label="Data com Ajuda"
                    :min-date="minDate"
                    :max-date="maxDate"
                    @change="handleDateChange"
                >
                    <template v-slot:helper>
                        <div class="helper-text">
                            Selecione uma data entre {{ formatDate(minDate) }} e {{ formatDate(maxDate) }}
                        </div>
                    </template>
                </vue-datepicker>
            </div>

            <!-- Exemplo com todos os slots -->
            <div class="example-block">
                <div class="example-title">Exemplo Completo com Todos os Slots</div>
                <vue-datepicker
                    v-model="fullDate"
                    @change="validateDate"
                >
                    <template v-slot:label>
                        <div class="custom-label">
                            <span class="label-text">Data Personalizada</span>
                            <span style="color: #dc3545; font-weight: bold;">*Obrigatório</span>
                        </div>
                    </template>

                    <template v-slot:prefix>
                        <div class="custom-prefix">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </template>

                    <template v-slot:input="slotProps">
                        <input
                            type="date"
                            :value="slotProps.modelValue"
                            :min="minDate"
                            :max="maxDate"
                            class="vue-datepicker-input custom-input"
                            @input="slotProps.updateDate($event.target.value)"
                        />
                    </template>

                    <template v-slot:clear-button="slotProps">
                        <div v-if="slotProps.modelValue"
                             class="custom-clear"
                             @click="slotProps.clearDate">
                            <i class="fas fa-ban"></i>
                        </div>
                    </template>

                    <template v-slot:helper>
                        <div :class="isValid ? 'helper-text' : 'error-text'">
                            {{ isValid ? 'Data válida selecionada' : 'Por favor selecione uma data válida' }}
                        </div>
                    </template>
                </vue-datepicker>
            </div>

            <!-- Documentação dos slots -->
            <h2 style="margin-top: 30px; padding-bottom: 10px; border-bottom: 1px solid #eee; color: #555; font-size: 18px;">
                Slots Disponíveis
            </h2>
            <table class="slots-table">
                <thead>
                    <tr>
                        <th>Nome do Slot</th>
                        <th>Descrição</th>
                        <th>Props</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>label</td>
                        <td>Substitui o label padrão do datepicker</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>prefix</td>
                        <td>Substitui o ícone de calendário à esquerda</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>input</td>
                        <td>Substitui o campo de entrada de data</td>
                        <td>modelValue, updateDate</td>
                    </tr>
                    <tr>
                        <td>clear-button</td>
                        <td>Substitui o botão de limpar</td>
                        <td>modelValue, disabled, clearDate</td>
                    </tr>
                    <tr>
                        <td>helper</td>
                        <td>Adiciona conteúdo abaixo do campo (texto de ajuda, erro)</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

            <!-- Código de exemplo -->
            <h2 style="margin-top: 30px; padding-bottom: 10px; border-bottom: 1px solid #eee; color: #555; font-size: 18px;">
                Exemplo de Código com Slots
            </h2>
			<?= createCodeBlock($exampleSlot, 'html') ?>

        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php
        // Renderiza os componentes e seus estilos
        echo ComponentsLoader::renderVueComponents();
        ?>

        // Aplicar estilos para o datepicker
        if (typeof applyDatepickerStyles === 'function') {
            applyDatepickerStyles();
        }

        // Criar aplicação Vue com Composition API
        const { createApp, ref, computed, onMounted } = Vue;

        createApp({
            components: {
                VueButton,
                VueDatepicker
            },
            setup() {
                // Estados para os exemplos
                const basicDate = ref('');
                const labelDate = ref('');
                const iconDate = ref('');
                const clearDate = ref('2023-05-15');
                const helperDate = ref('');
                const fullDate = ref('');
                const isValid = ref(true);

                // Datas limite para o exemplo de range
                const today = new Date();
                const maxDate = new Date();
                maxDate.setDate(today.getDate() + 30);

                const minDate = computed(() => {
                    return formatDateISO(today);
                });

                const maxDateStr = computed(() => {
                    return formatDateISO(maxDate);
                });

                // Métodos
                function handleDateChange(date) {
                    console.log('Data alterada:', date);
                }

                function showHelp() {
                    alert('Selecione a data em que ocorrerá o evento.');
                }

                function validateDate(date) {
                    if (!date) {
                        isValid.value = false;
                        return;
                    }

                    // Verifica se a data está dentro do intervalo permitido
                    const selectedDate = new Date(date);
                    isValid.value = selectedDate >= today && selectedDate <= maxDate;
                }

                function formatDate(dateStr) {
                    if (!dateStr) return '';

                    const date = new Date(dateStr);
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    const year = date.getFullYear();

                    return `${day}/${month}/${year}`;
                }

                // Função auxiliar para formatar data em ISO
                function formatDateISO(date) {
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, "0");
                    const day = date.getDate().toString().padStart(2, "0");

                    return `${year}-${month}-${day}`;
                }

                // Retornar todos os estados e funções para o template
                return {
                    basicDate,
                    labelDate,
                    iconDate,
                    clearDate,
                    helperDate,
                    fullDate,
                    isValid,
                    minDate: minDate.value,
                    maxDate: maxDateStr.value,
                    handleDateChange,
                    showHelp,
                    validateDate,
                    formatDate
                };
            }
        }).mount('#app');
    </script>
	<script src="../Utils/Utils.js"></script>
</body>
</html>