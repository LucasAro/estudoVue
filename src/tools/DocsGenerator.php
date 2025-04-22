<?php
namespace PhpVue\Tools;

use ReflectionClass;
use ReflectionMethod;

/**
 * Classe que gera documentação automática para componentes PhpVue
 * usando Reflection para acessar métodos protegidos
 */
class DocsGenerator {
    private $outputDir;
    private $components = [];

    public function __construct($outputDir = 'docs') {
        $this->outputDir = $outputDir;
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }
    }

    public function addComponent($componentClass) {
        if (class_exists($componentClass)) {
            $this->components[] = $componentClass;
        } else {
            echo "Aviso: A classe $componentClass não existe.\n";
        }
    }

    public function addComponents(array $components) {
        foreach ($components as $component) {
            $this->addComponent($component);
        }
    }

    public function generateDocs() {
        $this->generateIndexPage();
        foreach ($this->components as $componentClass) {
            $this->generateComponentDoc($componentClass);
        }
        echo "Documentação gerada com sucesso em: {$this->outputDir}\n";
    }

    private function generateIndexPage() {
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação de Componentes PhpVue</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .components { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .component-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .component-name { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
        .component-desc { color: #666; margin-bottom: 15px; }
        .view-button { display: inline-block; background: #ffc107; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Documentação de Componentes PhpVue</h1>
            <p>Total de componentes: ' . count($this->components) . '</p>
        </div>
        <div class="components">';

        foreach ($this->components as $componentClass) {
            $reflection = new ReflectionClass($componentClass);
            $shortName = $reflection->getShortName();
            $vueComponentName = $this->invokeMethod($componentClass, 'getName');
            $htmlTagName = $this->toKebabCase($vueComponentName);
            $docComment = $reflection->getDocComment();
            $description = $this->extractDescriptionFromDocBlock($docComment);
            $fileName = strtolower($shortName) . '.php';

            $html .= '
            <div class="component-card">
                <div class="component-name">' . $vueComponentName . ' (<code>&lt;' . $htmlTagName . '&gt;</code>)</div>
                <div class="component-desc">' . $description . '</div>
                <a href="' . $fileName . '" class="view-button">Ver Documentação</a>
            </div>';
        }

        $html .= '
        </div>
    </div>
</body>
</html>';

        file_put_contents($this->outputDir . '/index.php', $html);
    }

    private function generateComponentDoc($componentClass) {
        $reflection = new ReflectionClass($componentClass);
        $shortName = $reflection->getShortName();
        $vueComponentName = $this->invokeMethod($componentClass, 'getName');
        $htmlTagName = $this->toKebabCase($vueComponentName);

        // Usando Reflection para acessar métodos protegidos
        $props = $this->invokeMethod($componentClass, 'getProps');
        $emits = $this->invokeMethod($componentClass, 'getEmits');
        $slots = $this->invokeMethod($componentClass, 'getSlots');
        $styles = $this->invokeMethod($componentClass, 'getStyles');

        $docComment = $reflection->getDocComment();
        $description = $this->extractDescriptionFromDocBlock($docComment);

        // Prepara o exemplo de código
        $exampleCode = $this->generateExampleCode($shortName, $htmlTagName);

        // Formata o CSS para melhor exibição
        $formattedCss = $this->formatCss($styles);

        $html = '<?php
require_once "../../autoLoad.php";
use PhpVue\\Components\\' . $shortName . ';
use PhpVue\\Core\\ComponentsLoader;
ComponentsLoader::load([' . $shortName . '::class]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $vueComponentName . ' - Documentação PhpVue</title>
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
            <h1>' . $vueComponentName . '</h1>
            <div class="component-tag">&lt;' . $htmlTagName . '&gt;</div>
            <p>' . $description . '</p>
            <a href="index.php" class="nav-link"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <div class="section">
            <h2>Visão Geral</h2>
            <p>Visualização do componente:</p>
            <div class="preview">
                <' . $htmlTagName . '></' . $htmlTagName . '>
            </div>
        </div>

        <div class="section">
            <h2>Propriedades (Props)</h2>
            ' . $this->generatePropsTable($props) . '
        </div>

        <div class="section">
            <h2>Slots</h2>
            ' . $this->generateSlotsTable($slots) . '
        </div>

        <div class="section">
            <h2>Eventos</h2>
            ' . $this->generateEventsTable($emits) . '
        </div>

        <div class="section">
            <h2>Exemplo de Uso</h2>
            <pre><code class="language-php">' . htmlspecialchars($exampleCode) . '</code></pre>
        </div>

        <div class="section">
            <h2>Estilos CSS</h2>
            <pre><code class="language-css">' . htmlspecialchars($formattedCss) . '</code></pre>
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
</html>';

        file_put_contents($this->outputDir . '/' . strtolower($shortName) . '.php', $html);
    }

    /**
     * Invoca um método estático protegido usando Reflection
     *
     * @param string $class Nome da classe
     * @param string $method Nome do método
     * @param array $args Argumentos para o método (opcional)
     * @return mixed Resultado do método
     */
    private function invokeMethod($class, $method, $args = []) {
        $reflection = new ReflectionClass($class);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs(null, $args);
    }

    /**
     * Converte um nome de componente Pascal Case (VueButton) para kebab-case (vue-button)
     *
     * @param string $name Nome do componente em PascalCase
     * @return string Nome do componente em kebab-case
     */
    private function toKebabCase($name) {
        // Insere um hífen antes de cada letra maiúscula e converte para minúsculas
        $result = preg_replace('/([a-z])([A-Z])/', '$1-$2', $name);
        return strtolower($result);
    }

    /**
     * Gera um exemplo de código de uso do componente
     *
     * @param string $shortName Nome curto da classe do componente
     * @param string $htmlTagName Nome da tag HTML do componente
     * @return string Código de exemplo
     */
    private function generateExampleCode($shortName, $htmlTagName) {
        return '<?php
use PhpVue\\Components\\' . $shortName . ';
use PhpVue\\Core\\ComponentsLoader;

// Carrega o componente
ComponentsLoader::load([' . $shortName . '::class]);
?>

<div id="app">
    <' . $htmlTagName . '></' . $htmlTagName . '>
</div>

<script type="module">
    <?php echo ComponentsLoader::renderVueApp(\'meuApp\'); ?>
</script>';
    }

    /**
     * Formata o CSS para melhor exibição
     *
     * @param string $css CSS não formatado
     * @return string CSS formatado
     */
    private function formatCss($css) {
        // Remove espaços em branco extras e formata o CSS
        $formatted = preg_replace('/\s+/', ' ', $css);
        $formatted = preg_replace('/\s*{\s*/', ' {\n    ', $formatted);
        $formatted = preg_replace('/;\s*/', ';\n    ', $formatted);
        $formatted = preg_replace('/\s*}\s*/', '\n}\n\n', $formatted);
        $formatted = preg_replace('/\n    \n}/', '\n}', $formatted);

        return $formatted;
    }

    private function generatePropsTable($props) {
        if (empty($props)) {
            return '<p>Este componente não possui propriedades (props).</p>';
        }

        $html = '<table>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Padrão</th>
                <th>Descrição</th>
            </tr>';

        foreach ($props as $name => $config) {
            if (is_array($config)) {
                $type = $config['type'] ?? 'String';
                $default = isset($config['default']) ? $this->formatPropDefault($config['default']) : '-';
                $required = isset($config['required']) && $config['required'] ? '<b>Obrigatório</b>' : '';
                $validator = isset($config['validator']) ? '<code>' . htmlspecialchars($config['validator']) . '</code>' : '';

                $html .= '<tr>
                    <td>' . $name . ' ' . $required . '</td>
                    <td>' . $type . '</td>
                    <td><code>' . $default . '</code></td>
                    <td>' . $validator . '</td>
                </tr>';
            }
        }

        $html .= '</table>';
        return $html;
    }

    private function generateSlotsTable($slots) {
        if (empty($slots)) {
            return '<p>Este componente não possui slots.</p>';
        }

        $html = '<table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>';

        foreach ($slots as $name => $description) {
            $html .= '<tr>
                <td>' . $name . '</td>
                <td>' . $description . '</td>
            </tr>';
        }

        $html .= '</table>';
        return $html;
    }

    private function generateEventsTable($emits) {
        if (empty($emits)) {
            return '<p>Este componente não emite eventos.</p>';
        }

        $html = '<table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>';

        foreach ($emits as $event) {
            $description = $this->getEventDescription($event);
            $html .= '<tr>
                <td>' . $event . '</td>
                <td>' . $description . '</td>
            </tr>';
        }

        $html .= '</table>';
        return $html;
    }

    private function formatPropDefault($value) {
        if (is_string($value)) {
            if (strpos($value, '()') !== false || strpos($value, '=>') !== false) {
                return $value;
            }
            return "'" . $value . "'";
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_null($value)) {
            return 'null';
        } elseif (is_array($value)) {
            return json_encode($value);
        } else {
            return (string)$value;
        }
    }

    private function getEventDescription($event) {
        $eventDescriptions = [
            'click' => 'Emitido quando o componente é clicado.',
            'input' => 'Emitido quando o valor do input é alterado.',
            'change' => 'Emitido quando o valor do componente é alterado.',
            'update:modelValue' => 'Emitido quando o valor do modelo é atualizado (para v-model).',
            'confirm' => 'Emitido quando uma ação de confirmação é realizada.',
            'cancel' => 'Emitido quando uma ação de cancelamento é realizada.',
            'clear' => 'Emitido quando o conteúdo é limpo.'
        ];

        return $eventDescriptions[$event] ?? 'Evento emitido pelo componente.';
    }

    private function extractDescriptionFromDocBlock($docBlock) {
        if (!$docBlock) {
            return 'Não há descrição disponível para este componente.';
        }

        $docBlock = preg_replace('/^\s*\/\*\*|\s*\*\/$/m', '', $docBlock);
        $docBlock = preg_replace('/^\s*\*\s?/m', '', $docBlock);

        $lines = explode("\n", $docBlock);
        $description = '';

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line && !preg_match('/^@\w+/', $line)) {
                $description .= $line . ' ';
            }
        }

        return trim($description);
    }
}