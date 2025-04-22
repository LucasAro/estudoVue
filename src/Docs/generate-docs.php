<?php
// Carrega o autoloader
require_once '../autoLoad.php';

// Importa a classe do gerador de documentação
use PhpVue\Tools\DocsGenerator;

// Importa os componentes que serão documentados
use PhpVue\Components\Button;
use PhpVue\Components\Input;
use PhpVue\Components\Popup;
use PhpVue\Components\Dropdown;

// Cria uma instância do gerador de documentação
// Especifica a pasta onde a documentação será gerada
$docsGenerator = new DocsGenerator('docs');

// Adiciona os componentes para gerar documentação
$docsGenerator->addComponents([
    Button::class,
    Input::class,
    Popup::class,
	Dropdown::class,
    // Adicione outros componentes aqui conforme necessário
]);

// Gera a documentação para todos os componentes
$docsGenerator->generateDocs();

echo "Documentação gerada com sucesso!\n";