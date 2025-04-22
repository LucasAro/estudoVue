<?php
require_once "../../autoLoad.php";
use PhpVue\Components\Button;
use PhpVue\Core\ComponentsLoader;
ComponentsLoader::load([Button::class]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VueButton - Documentação PhpVue</title>
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
            <h1>VueButton</h1>
            <div class="component-tag">&lt;vue-button&gt;</div>
            <p>Componente Vue Button com suporte a slots</p>
            <a href="index.php" class="nav-link"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <div class="section">
            <h2>Visão Geral</h2>
            <p>Visualização do componente:</p>
            <div class="preview">
                <vue-button></vue-button>
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
                    <td>text </td>
                    <td>String</td>
                    <td><code>'Button'</code></td>
                    <td></td>
                </tr><tr>
                    <td>leftIcon </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>rightIcon </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>disabled </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
                    <td></td>
                </tr><tr>
                    <td>loading </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
                    <td></td>
                </tr><tr>
                    <td>type </td>
                    <td>String</td>
                    <td><code>'default'</code></td>
                    <td><code>(value) =&gt; ['default', 'cancel'].includes(value)</code></td>
                </tr></table>
        </div>

        <div class="section">
            <h2>Slots</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr><tr>
                <td>default</td>
                <td>Conteúdo principal do botão. Substitui o texto padrão.</td>
            </tr><tr>
                <td>left-icon</td>
                <td>Ícone personalizado à esquerda do texto. Só é renderizado se leftIcon não for definido.</td>
            </tr><tr>
                <td>right-icon</td>
                <td>Ícone personalizado à direita do texto. Só é renderizado se rightIcon não for definido.</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Eventos</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr><tr>
                <td>click</td>
                <td>Emitido quando o componente é clicado.</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Exemplo de Uso</h2>
            <pre><code class="language-php">&lt;?php
use PhpVue\Components\Button;
use PhpVue\Core\ComponentsLoader;

// Carrega o componente
ComponentsLoader::load([Button::class]);
?&gt;

&lt;div id=&quot;app&quot;&gt;
    &lt;vue-button&gt;&lt;/vue-button&gt;
&lt;/div&gt;

&lt;script type=&quot;module&quot;&gt;
    &lt;?php echo ComponentsLoader::renderVueApp('meuApp'); ?&gt;
&lt;/script&gt;</code></pre>
        </div>

        <div class="section">
            <h2>Estilos CSS</h2>
            <pre><code class="language-css">.vue-button {\n    padding: 10px 20px;\n    border: none;\n    border-radius: 100px;\n    font-size: 16px;\n    cursor: pointer;\n    display: inline-flex;\n    align-items: center;\n    justify-content: center;\n    transition: all 0.3s ease;\n    background-color: #ffc107;\n    color: #333;\n    min-width: 120px;\n\n}\n\n.vue-button:hover:not(.disabled) {\n    filter: brightness(0.9);\n\n}\n\n.vue-button.disabled {\n    background-color: #cccccc !important;\n    color: #666666 !important;\n    cursor: not-allowed;\n\n}\n\n.vue-button.cancel {\n    background-color: #dc3545;\n    color: white;\n\n}\n\n.vue-button .left-icon {\n    margin-right: 8px;\n\n}\n\n.vue-button .right-icon {\n    margin-left: 8px;\n\n}\n\n.vue-button.loading {\n    opacity: 0.8;\n    cursor: wait;\n\n}\n\n</code></pre>
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