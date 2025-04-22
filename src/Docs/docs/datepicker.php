<?php
require_once "../../autoLoad.php";
use PhpVue\Components\Datepicker;
use PhpVue\Core\ComponentsLoader;
ComponentsLoader::load([Datepicker::class]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VueDatepicker - Documentação PhpVue</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .component-tag { display: inline-block; background: #f0f0f0; padding: 5px 10px; border-radius: 4px; margin-top: 10px; font-family: monospace; }
        .nav-link { display: inline-block; background: #ffc107; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px; }
        .section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; }
        .example { padding: 15px; background: #f8f9fa; border-radius: 4px; margin: 15px 0; }
        pre.hljs { padding: 15px; border-radius: 4px; overflow-x: auto; margin: 0; }
        .preview { padding: 20px; border: 1px solid #eee; margin-top: 15px; display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div id="app" class="container">
        <div class="header">
            <h1>VueDatepicker</h1>
            <div class="component-tag">&lt;vue-datepicker&gt;</div>
            <p>Datepicker.php - Componente Vue Datepicker simples e funcional</p>
            <a href="index.php" class="nav-link"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <div class="section">
            <h2>Visão Geral</h2>
            <p>Visualização do componente:</p>
            <div class="preview">
                <vue-datepicker></vue-datepicker>
            </div>
        </div>

        <div class="section">
            <h2>Propriedades (Props)</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Padrão</th>
                <th>Descrição</th>
            </tr><tr>
                    <td>modelValue </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>placeholder </td>
                    <td>String</td>
                    <td><code>'Selecione uma data'</code></td>
                    <td></td>
                </tr><tr>
                    <td>format </td>
                    <td>String</td>
                    <td><code>'YYYY-MM-DD'</code></td>
                    <td></td>
                </tr><tr>
                    <td>label </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>required </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
                    <td></td>
                </tr><tr>
                    <td>disabled </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
                    <td></td>
                </tr><tr>
                    <td>minDate </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>maxDate </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr></table>
        </div>

        <div class="section">
            <h2>Slots</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr><tr>
                <td>label</td>
                <td>Substitui o label padrão do datepicker.</td>
            </tr><tr>
                <td>prefix</td>
                <td>Substitui o ícone de calendário à esquerda.</td>
            </tr><tr>
                <td>input</td>
                <td>Substitui o campo de entrada de data (recebe updateDate e modelValue).</td>
            </tr><tr>
                <td>clear-button</td>
                <td>Substitui o botão de limpar (recebe clearDate, modelValue e disabled).</td>
            </tr><tr>
                <td>helper</td>
                <td>Adiciona conteúdo abaixo do campo (texto de ajuda, mensagens de erro).</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Eventos</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr><tr>
                <td>update:modelValue</td>
                <td>Emitido quando o valor do modelo é atualizado (para v-model).</td>
            </tr><tr>
                <td>change</td>
                <td>Emitido quando o valor do componente é alterado.</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Exemplo de Uso</h2>
            <pre><code class="language-php">&lt;?php
use PhpVue\Components\Datepicker;
use PhpVue\Core\ComponentsLoader;

// Carrega o componente
ComponentsLoader::load([Datepicker::class]);
?&gt;

&lt;div id=&quot;app&quot;&gt;
    &lt;vue-datepicker&gt;&lt;/vue-datepicker&gt;
&lt;/div&gt;

&lt;script type=&quot;module&quot;&gt;
    &lt;?php echo ComponentsLoader::renderVueApp('meuApp'); ?&gt;
&lt;/script&gt;</code></pre>
        </div>

        <div class="section">
            <h2>Estilos CSS</h2>
            <pre><code class="language-css">.vue-datepicker-wrapper {\n    margin-bottom: 15px;\n    position: relative;\n\n}\n\n.vue-datepicker-label {\n    display: block;\n    font-size: 14px;\n    font-weight: 600;\n    margin-bottom: 6px;\n    color: #333;\n    text-align: left;\n\n}\n\n.required-mark {\n    color: #dc3545;\n    margin-left: 3px;\n\n}\n\n.vue-datepicker-container {\n    position: relative;\n    display: flex;\n    align-items: center;\n    width: 100%;\n\n}\n\n.vue-datepicker-container.disabled {\n    opacity: 0.7;\n    cursor: not-allowed;\n\n}\n\n.vue-datepicker-input {\n    width: 100%;\n    padding: 10px 35px 10px 35px;\n    border: 1px solid #ddd;\n    border-radius: 4px;\n    font-size: 16px;\n    line-height: 1.5;\n    transition: border 0.2s ease;\n    box-sizing: border-box;\n\n}\n\n.vue-datepicker-input:focus {\n    outline: none;\n    border-color: #ffc107;\n    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);\n\n}\n\n.vue-datepicker-container.disabled .vue-datepicker-input {\n    background-color: #f8f9fa;\n    cursor: not-allowed;\n\n}\n\n.datepicker-icon {\n    position: absolute;\n    left: 10px;\n    color: #777;\n    z-index: 1;\n\n}\n\n.datepicker-clear-button {\n    position: absolute;\n    right: 10px;\n    color: #999;\n    cursor: pointer;\n    z-index: 1;\n\n}\n\n.datepicker-clear-button:hover {\n    color: #dc3545;\n\n}\n\n</code></pre>
        </div>
    </div>

    <script type="module">
        <?php echo ComponentsLoader::renderVueApp("docApp"); ?>
    </script>

    <!-- Inicializa a sintaxe highlight -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("pre code").forEach(block => {
                hljs.highlightElement(block);
            });
        });
    </script>
</body>
</html>