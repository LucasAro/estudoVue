<?php
require_once "../../autoLoad.php";
use PhpVue\Components\Popup;
use PhpVue\Core\ComponentsLoader;
ComponentsLoader::load([Popup::class]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VuePopup - Documentação PhpVue</title>
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
            <h1>VuePopup</h1>
            <div class="component-tag">&lt;vue-popup&gt;</div>
            <p>Popup.php - Componente Vue Popup com suporte a slots</p>
            <a href="index.php" class="nav-link"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <div class="section">
            <h2>Visão Geral</h2>
            <p>Visualização do componente:</p>
            <div class="preview">
                <vue-popup></vue-popup>
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
                    <td>title </td>
                    <td>String</td>
                    <td><code>'Popup'</code></td>
                    <td></td>
                </tr><tr>
                    <td>showTitle </td>
                    <td>Boolean</td>
                    <td><code>true</code></td>
                    <td></td>
                </tr><tr>
                    <td>message </td>
                    <td>String</td>
                    <td><code>'Conteúdo do popup'</code></td>
                    <td></td>
                </tr><tr>
                    <td>htmlContent </td>
                    <td>String</td>
                    <td><code>''</code></td>
                    <td></td>
                </tr><tr>
                    <td>useHtmlContent </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
                    <td></td>
                </tr><tr>
                    <td>confirmText </td>
                    <td>String</td>
                    <td><code>'Salvar'</code></td>
                    <td></td>
                </tr><tr>
                    <td>showConfirmButton </td>
                    <td>Boolean</td>
                    <td><code>true</code></td>
                    <td></td>
                </tr><tr>
                    <td>cancelText </td>
                    <td>String</td>
                    <td><code>'Cancelar'</code></td>
                    <td></td>
                </tr><tr>
                    <td>showCancelButton </td>
                    <td>Boolean</td>
                    <td><code>true</code></td>
                    <td></td>
                </tr><tr>
                    <td>showCloseButton </td>
                    <td>Boolean</td>
                    <td><code>true</code></td>
                    <td></td>
                </tr><tr>
                    <td>showPopup </td>
                    <td>Boolean</td>
                    <td><code>false</code></td>
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
                <td>default</td>
                <td>Conteúdo principal do popup. Substitui o conteúdo padrão.</td>
            </tr><tr>
                <td>header</td>
                <td>Cabeçalho personalizado. Substitui o título padrão.</td>
            </tr><tr>
                <td>close-button</td>
                <td>Botão de fechar personalizado.</td>
            </tr><tr>
                <td>actions</td>
                <td>Área de ações personalizada. Substitui os botões padrão.</td>
            </tr><tr>
                <td>confirm-button</td>
                <td>Botão de confirmação personalizado.</td>
            </tr><tr>
                <td>cancel-button</td>
                <td>Botão de cancelamento personalizado.</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Eventos</h2>
            <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr><tr>
                <td>confirm</td>
                <td>Emitido quando uma ação de confirmação é realizada.</td>
            </tr><tr>
                <td>cancel</td>
                <td>Emitido quando uma ação de cancelamento é realizada.</td>
            </tr></table>
        </div>

        <div class="section">
            <h2>Exemplo de Uso</h2>
            <pre><code class="language-php">&lt;?php
use PhpVue\Components\Popup;
use PhpVue\Core\ComponentsLoader;

// Carrega o componente
ComponentsLoader::load([Popup::class]);
?&gt;

&lt;div id=&quot;app&quot;&gt;
    &lt;vue-popup&gt;&lt;/vue-popup&gt;
&lt;/div&gt;

&lt;script type=&quot;module&quot;&gt;
    &lt;?php echo ComponentsLoader::renderVueApp('meuApp'); ?&gt;
&lt;/script&gt;</code></pre>
        </div>

        <div class="section">
            <h2>Estilos CSS</h2>
            <pre><code class="language-css">.popup-overlay {\n    position: fixed;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 0;\n    background-color: rgba(0, 0, 0, 0.5);\n    display: flex;\n    justify-content: center;\n    align-items: center;\n    z-index: 1000;\n\n}\n\n.popup-container {\n    background-color: white;\n    border-radius: 8px;\n    width: 90%;\n    max-width: 500px;\n    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);\n    overflow: hidden;\n\n}\n\n.popup-header {\n    background-color: #FFCD39;\n    padding: 15px 20px;\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n\n}\n\n.popup-header.no-title {\n    justify-content: flex-end;\n    padding: 10px 15px;\n\n}\n\n.popup-header h2 {\n    margin: 0;\n    font-size: 20px;\n    color: #000;\n\n}\n\n.close-button {\n    background: none;\n    border: none;\n    font-size: 24px;\n    cursor: pointer;\n    color: #000;\n\n}\n\n.popup-content {\n    padding: 30px 20px;\n    text-align: center;\n\n}\n\n.popup-content p {\n    font-size: 20px;\n    margin: 0;\n    line-height: 1.5;\n\n}\n\n.popup-actions {\n    display: flex;\n    justify-content: center;\n    padding: 20px;\n    gap: 15px;\n\n}\n\n.confirm-button {\n    background-color: #FFCD39;\n    color: #000;\n    border: none;\n    border-radius: 50px;\n    padding: 10px 25px;\n    font-size: 16px;\n    cursor: pointer;\n    min-width: 100px;\n\n}\n\n.cancel-button {\n    background-color: #CCCCCC;\n    color: #000;\n    border: none;\n    border-radius: 50px;\n    padding: 10px 25px;\n    font-size: 16px;\n    cursor: pointer;\n    min-width: 100px;\n\n}\n\n</code></pre>
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