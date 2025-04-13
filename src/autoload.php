<?php
// Autoloader ajustado para a estrutura atual
spl_autoload_register(function ($class) {
    // Prefixo do namespace do projeto
    $prefix = 'PhpVue\\';

    // Diretório base - ajustado para começar um nível acima do autoload.php
    $base_dir = __DIR__ . '/';  // Já que o autoload está em /src

    // Verifica se a classe solicitada usa o namespace do nosso projeto
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não for do namespace do projeto, não faz nada
        return;
    }

    // Obtém o caminho relativo da classe
    $relative_class = substr($class, $len);

    // Constrói o caminho do arquivo
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Se o arquivo existir, inclui-o
    if (file_exists($file)) {
        require $file;
    }
});