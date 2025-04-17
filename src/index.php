<?php
// Carrega o autoloader
require_once 'autoLoad.php';

// Importa as classes necessárias
use PhpVue\Core\ComponentsLoader;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhpVue - Integração PHP e Vue.js</title>
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
            padding: 40px 0;
        }

        .header h1 {
            font-size: 42px;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .header p {
            font-size: 18px;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--primary-color);
            margin: 0 15px;
            font-size: 28px;
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
            color: var(--text-color);
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: var(--card-background);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            padding: 15px;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }

        .example-link {
            display: block;
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: var(--text-color);
            text-decoration: none;
            border-radius: 30px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .example-link:hover {
            background-color: #e6ad00;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .feature {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            background-color: var(--card-background);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .feature i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .feature-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .feature-content p {
            margin: 0;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .code-snippet {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            overflow: auto;
            font-family: monospace;
            white-space: pre-wrap;
            font-size: 14px;
            border-left: 4px solid var(--primary-color);
        }

        .documentation-section {
            margin-top: 30px;
        }

        .documentation-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .documentation-card {
            display: flex;
            flex-direction: column;
            background-color: var(--card-background);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: var(--text-color);
        }

        .documentation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .documentation-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            margin: 20px auto;
            border-radius: 50%;
            background-color: var(--primary-color);
            font-size: 24px;
        }

        .documentation-card-content {
            padding: 20px;
            text-align: center;
            flex-grow: 1;
        }

        .documentation-card-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .documentation-card-content p {
            margin: 0;
            color: var(--text-muted);
        }

        .documentation-card-footer {
            padding: 15px;
            text-align: center;
            border-top: 1px solid var(--border-color);
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            color: var(--text-muted);
            font-size: 14px;
            border-top: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <span><i class="fab fa-php"></i></span>
                <span><i class="fas fa-plus"></i></span>
                <span><i class="fab fa-vuejs"></i></span>
            </div>
            <h1>PhpVue</h1>
            <p>Uma biblioteca para integração simples entre PHP e Vue.js. Crie componentes Vue.js
               utilizando classes PHP, facilitando o desenvolvimento de aplicações web modernas
               com a conveniência da sintaxe PHP.</p>
        </div>

        <div class="section">
            <h2>Sobre a Biblioteca</h2>
            <p>PhpVue permite que você defina componentes Vue.js utilizando classes PHP, proporcionando uma experiência de desenvolvimento familiar para desenvolvedores PHP que desejam utilizar Vue.js em seus projetos.</p>

            <div class="features">
                <div class="feature">
                    <i class="fas fa-code"></i>
                    <div class="feature-content">
                        <h3>Componentes em PHP</h3>
                        <p>Defina seus componentes Vue.js utilizando classes PHP com uma sintaxe clara e organizada.</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-puzzle-piece"></i>
                    <div class="feature-content">
                        <h3>Suporte a Slots</h3>
                        <p>Utilize slots para criar componentes altamente personalizáveis e reutilizáveis.</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-cubes"></i>
                    <div class="feature-content">
                        <h3>Integração Simples</h3>
                        <p>Carregue e utilize seus componentes com poucos passos, sem configurações complexas.</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-palette"></i>
                    <div class="feature-content">
                        <h3>Estilos Encapsulados</h3>
                        <p>Defina estilos CSS diretamente na classe do componente, mantendo tudo organizado.</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-bolt"></i>
                    <div class="feature-content">
                        <h3>Eventos Integrados</h3>
                        <p>Gerencie eventos e emits de forma simples e direta em suas classes PHP.</p>
                    </div>
                </div>

                <div class="feature">
                    <i class="fas fa-cogs"></i>
                    <div class="feature-content">
                        <h3>Props Tipadas</h3>
                        <p>Defina props com tipos, valores padrão e validadores para criar componentes robustos.</p>
                    </div>
                </div>
            </div>

            <div class="code-snippet">
// Exemplo de um componente Button
class Button extends BaseComponent {
    public static function getName() {
        return 'VueButton';
    }

    protected static function getProps() {
        return [
            'text' => [
                'type' => 'String',
                'default' => 'Button'
            ],
            'disabled' => [
                'type' => 'Boolean',
                'default' => false
            ]
        ];
    }

    protected static function getTemplate() {
        return '&lt;button :class="classes" :disabled="disabled" @click="$emit(\'click\')"&gt;{{ text }}&lt;/button&gt;';
    }
}
            </div>
        </div>

        <div class="section">
            <h2>Documentação de Componentes</h2>
            <p>Conheça em detalhes os componentes disponíveis na biblioteca PhpVue. A documentação fornece informações sobre propriedades, eventos, slots e exemplos de uso.</p>

            <div class="documentation-cards">
                <a href="Docs/button-doc.php" class="documentation-card">
                    <div class="documentation-card-icon">
                        <i class="fas fa-square"></i>
                    </div>
                    <div class="documentation-card-content">
                        <h3>Button</h3>
                        <p>Componente de botão interativo com suporte a ícones, estados e slots.</p>
                    </div>
                    <div class="documentation-card-footer">
                        Ver Documentação
                    </div>
                </a>

                <a href="#" class="documentation-card" style="opacity: 0.6; cursor: not-allowed;">
                    <div class="documentation-card-icon">
                        <i class="fas fa-font"></i>
                    </div>
                    <div class="documentation-card-content">
                        <h3>Input</h3>
                        <p>Componente de entrada de texto com label, ícones e validação.</p>
                    </div>
                    <div class="documentation-card-footer">
                        Em breve
                    </div>
                </a>

                <a href="#" class="documentation-card" style="opacity: 0.6; cursor: not-allowed;">
                    <div class="documentation-card-icon">
                        <i class="fas fa-window-maximize"></i>
                    </div>
                    <div class="documentation-card-content">
                        <h3>Popup</h3>
                        <p>Componente de modal/popup para diálogos, alertas e formulários.</p>
                    </div>
                    <div class="documentation-card-footer">
                        Em breve
                    </div>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>Exemplos</h2>
            <p>Confira os exemplos abaixo para ver o PhpVue em ação. Cada exemplo demonstra diferentes recursos da biblioteca.</p>

            <div class="cards">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list"></i> Demonstração Geral
                    </div>
                    <div class="card-body">
                        <p>Demonstração básica dos componentes Button e Popup da biblioteca PhpVue.</p>
                    </div>
                    <div class="card-footer">
                        <a href="examples/demo.php" class="example-link">Ver Exemplo</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-wpforms"></i> Formulário
                    </div>
                    <div class="card-body">
                        <p>Exemplo de formulário utilizando os componentes Input, Button e Popup.</p>
                    </div>
                    <div class="card-footer">
                        <a href="examples/form.php" class="example-link">Ver Exemplo</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list-ol"></i> Playlist
                    </div>
                    <div class="card-body">
                        <p>Gerenciador de playlist com recurso de arrastar e soltar utilizando Vue.js e componentes PhpVue.</p>
                    </div>
                    <div class="card-footer">
                        <a href="examples/playlist.php" class="example-link">Ver Exemplo</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-puzzle-piece"></i> Slots
                    </div>
                    <div class="card-body">
                        <p>Demonstração do uso de slots para personalizar os componentes da biblioteca.</p>
                    </div>
                    <div class="card-footer">
                        <a href="examples/slot.php" class="example-link">Ver Exemplo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Como Usar</h2>
            <p>Para começar a usar a biblioteca PhpVue em seu projeto, siga os passos abaixo:</p>

            <ol>
                <li>Inclua o autoLoader no início do seu arquivo PHP:</li>
            </ol>

            <div class="code-snippet">
require_once 'autoLoad.php';

// Importa as classes necessárias
use PhpVue\Components\Button;
use PhpVue\Components\Popup;
use PhpVue\Core\ComponentsLoader;
            </div>

            <ol start="2">
                <li>Carregue os componentes que deseja utilizar:</li>
            </ol>

            <div class="code-snippet">
// Carrega componentes pelo nome da classe
ComponentsLoader::load(['Button', 'Popup', 'Input']);

// Ou use o ::class para maior segurança
ComponentsLoader::load([Button::class, Popup::class]);
            </div>

            <ol start="3">
                <li>Inclua o Vue.js e renderize os componentes em seu HTML:</li>
            </ol>

            <div class="code-snippet">
&lt;!-- Inclua o Vue.js --&gt;
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"&gt;&lt;/script&gt;

&lt;!-- Crie o container da aplicação --&gt;
&lt;div id="app"&gt;
    &lt;vue-button text="Clique em mim" @click="showMessage"&gt;&lt;/vue-button&gt;
&lt;/div&gt;

&lt;!-- Script que carrega os componentes do PHP --&gt;
&lt;script type="module"&gt;
    &lt;?php echo ComponentsLoader::renderVueApp('myApp'); ?&gt;

    // Personalização da aplicação Vue
    myApp.config.globalProperties = {
        ...myApp.config.globalProperties,

        // Adicione métodos e propriedades
        showMessage() {
            alert('Botão clicado!');
        }
    };
&lt;/script&gt;
            </div>
        </div>

        <div class="footer">
            <p>PhpVue - Desenvolvido para integrar PHP e Vue.js de forma simples e eficiente.</p>
            <p>© <?php echo date('Y'); ?> - Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>