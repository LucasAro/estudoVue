<?php
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
            // Verifica se o componente já foi carregado
            if (!in_array($component, self::$loadedComponents)) {
                // Adiciona à lista de componentes carregados
                self::$loadedComponents[] = $component;
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