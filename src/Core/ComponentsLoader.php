<?php
namespace PhpVue\Core;

/**
 * ComponentsLoader.php - Classe para carregar e gerenciar componentes Vue
 */
class ComponentsLoader {
    /**
     * Lista de componentes carregados
     * @var array
     */
    private static $loadedComponents = [];

    /**
     * Carrega um ou mais componentes Vue
     *
     * @param array $components Nomes das classes dos componentes
     * @return void
     */
    public static function load($components = []) {
        foreach ($components as $component) {
            // Verifica se é uma string (nome da classe) ou uma classe
            if (is_string($component)) {
                // Se for uma string e não incluir namespace, tenta resolver
                if (strpos($component, '\\') === false) {
                    // Tenta resolver como um componente na pasta Components
                    $componentClass = '\\PhpVue\\Components\\' . $component;

                    // Verifica se a classe existe
                    if (!class_exists($componentClass)) {
                        // Se não existe, usa o nome original (pode ser um FQCN)
                        $componentClass = $component;
                    }
                } else {
                    // Já tem namespace, usa como está
                    $componentClass = $component;
                }
            } else {
                // Se não for string, obtém o nome da classe
                $componentClass = get_class($component);
            }

            // Adiciona à lista de componentes carregados se ainda não estiver lá
            if (!in_array($componentClass, self::$loadedComponents) && class_exists($componentClass)) {
                self::$loadedComponents[] = $componentClass;
            }
        }
    }

    /**
     * Renderiza todos os componentes carregados em um único script
     *
     * @return string Código JavaScript de todos os componentes carregados
     */
    public static function renderComponents() {
        $output = '';

        // Adiciona cada componente carregado
        foreach (self::$loadedComponents as $component) {
            if (class_exists($component) && method_exists($component, 'render')) {
                $output .= call_user_func([$component, 'render']) . "\n\n";
            }
        }

        return $output;
    }
}