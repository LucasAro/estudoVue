<?php
namespace PhpVue\Core;

/**
 * Classe base abstrata para todos os componentes Vue
 */
abstract class BaseComponent {
    /**
     * Retorna o nome do componente Vue
     *
     * @return string
     */
    abstract public static function getName();

    /**
     * Retorna a definição de propriedades (props) do componente
     *
     * @return array
     */
    abstract protected static function getProps();

    /**
     * Retorna o template HTML do componente
     *
     * @return string
     */
    abstract protected static function getTemplate();

    /**
     * Retorna os métodos do componente
     *
     * @return array
     */
    protected static function getMethods() {
        return [];
    }

    /**
     * Retorna as propriedades computadas do componente
     *
     * @return array
     */
    protected static function getComputed() {
        return [];
    }

    /**
     * Retorna os estilos CSS do componente
     *
     * @return string
     */
    protected static function getStyles() {
        return '';
    }

    /**
     * Retorna os eventos que o componente pode emitir
     *
     * @return array
     */
    protected static function getEmits() {
        return [];
    }

    /**
     * Renderiza o componente Vue completo
     *
     * @return string Código JavaScript do componente Vue
     */
    public static function render() {
        $name = static::getName();

        // Preserva o nome original da função de estilo (compatibilidade)
        $className = (strpos($name, 'Vue') === 0) ? substr($name, 3) : $name;
        $styleFunction = 'apply' . $className . 'Styles';

        $props = static::renderProps();
        $template = static::getTemplate();
        $computed = static::renderComputed();
        $methods = static::renderMethods();
        $styles = static::getStyles();
        $emits = static::renderEmits();

        // Importante: A formatação precisa corresponder exatamente à formatação original
        $output = <<<EOT
// Componente {$name}
export const {$name} = {
    props: {
        {$props}
    },
    emits: {$emits},
    template: `{$template}`,
    methods: {
        {$methods}
    },
    computed: {
        {$computed}
    }
};

// Estilos do componente
export const {$styleFunction} = () => {
    // Evita duplicação de estilos
    if (document.querySelector('style[data-component="{$name}"]')) return;

    const style = document.createElement('style');
    style.setAttribute('data-component', '{$name}');
    style.textContent = `{$styles}`;
    document.head.appendChild(style);
};
EOT;

        return $output;
    }

    /**
     * Renderiza props no formato JavaScript
     *
     * @return string
     */
    protected static function renderProps() {
        $props = static::getProps();
        $result = [];

        foreach ($props as $name => $config) {
            if (is_array($config)) {
                // Obtém as configurações da prop
                $type = $config['type'] ?? 'String';
                $default = isset($config['default']) ? static::formatDefault($config['default']) : null;
                $required = isset($config['required']) && $config['required'] ? 'true' : 'false';
                $validator = $config['validator'] ?? null;

                // Constrói a propriedade
                $propConfig = [];
                $propConfig[] = "type: " . static::formatType($type);

                if ($default !== null) {
                    $propConfig[] = "default: $default";
                }

                if ($required === 'true') {
                    $propConfig[] = "required: true";
                }

                if ($validator) {
                    $propConfig[] = "validator: $validator";
                }

                // Formata a prop no formato desejado para Vue
                $result[] = "$name: {\n            " . implode(",\n            ", $propConfig) . "\n        }";
            } else {
                // Se for uma definição simples
                $result[] = "$name: $config";
            }
        }

        return implode(",\n        ", $result);
    }

    /**
     * Formata o tipo de dados para JavaScript
     *
     * @param string $type
     * @return string
     */
    protected static function formatType($type) {
        // Verifica se é um tipo composto como [String, Number]
        if (preg_match('/^\[(.*)\]$/', $type)) {
            // Remover aspas para arrays de tipos
            return $type;
        }

        // Para tipos simples, mantenha como está
        return $type;
    }

    /**
     * Formata o valor padrão para JavaScript
     *
     * @param mixed $value
     * @return string
     */
    protected static function formatDefault($value) {
        if (is_string($value)) {
            // Verifica se já é uma função ou expressão
            if (strpos($value, '()') !== false || strpos($value, '=>') !== false) {
                return $value;
            }
            return "'$value'";
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_null($value)) {
            return 'null';
        } elseif (is_array($value)) {
            return '() => ' . json_encode($value);
        } else {
            return $value;
        }
    }

    /**
     * Renderiza métodos no formato JavaScript
     *
     * @return string
     */
    protected static function renderMethods() {
        $methods = static::getMethods();
        $result = [];

        foreach ($methods as $name => $code) {
            // Garante que os métodos são formatados corretamente
            // Garante que não tenha a palavra function no início
            if (strpos($name, '()') !== false) {
                // Se o nome já tem parênteses, apenas adicione o código
                $result[] = "$name $code";
            } else {
                // Senão, adicione os parênteses
                $result[] = "$name() $code";
            }
        }

        return implode(",\n        ", $result);
    }

    /**
     * Renderiza propriedades computadas no formato JavaScript
     *
     * @return string
     */
    protected static function renderComputed() {
        $computed = static::getComputed();
        $result = [];

        foreach ($computed as $name => $code) {
            // Garante que as propriedades computadas são formatadas corretamente
            if (strpos($name, '()') !== false) {
                $result[] = "$name $code";
            } else {
                $result[] = "$name() $code";
            }
        }

        return implode(",\n        ", $result);
    }

    /**
     * Renderiza lista de eventos que podem ser emitidos
     *
     * @return string
     */
    protected static function renderEmits() {
        $emits = static::getEmits();

        if (empty($emits)) {
            return '[]';
        }

        // Converte array para string no formato JavaScript
        // usando aspas simples para maior compatibilidade
        $emitsStr = array_map(function($emit) {
            return "'$emit'";
        }, $emits);

        return '[' . implode(', ', $emitsStr) . ']';
    }
}