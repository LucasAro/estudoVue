# Documentação: Implementação de Vue.js em Sistema PHP

## Visão Geral

Este projeto representa uma abordagem híbrida de implementação do Vue.js em um sistema PHP, criando uma ponte entre o backend PHP e o frontend Vue.js sem necessidade de ferramentas de build como Vue CLI ou Webpack. Esta solução permite aproveitar os benefícios do Vue.js enquanto mantém a simplicidade da arquitetura PHP tradicional.

## Arquitetura da Solução

A arquitetura do sistema se baseia em três pilares principais:

1. **Componentes Vue encapsulados em classes PHP**: Cada componente Vue é definido dentro de uma classe PHP que gera o código JavaScript necessário.

2. **Sistema de carregamento dinâmico**: A classe `ComponentsLoader` gerencia quais componentes são necessários em cada página.

3. **Integração PHP-JavaScript**: Os dados PHP são convertidos para JSON e injetados no contexto JavaScript para uso nos componentes Vue.

## Componentes Implementados

O sistema atual inclui os seguintes componentes:

1. **Button**: Um botão personalizado com suporte para ícones, estados de carregamento e estilos variados.
2. **Popup**: Um modal para diálogos e alertas, com suporte para conteúdo HTML e diferentes configurações de botões.
3. **Input**: Um campo de entrada com label opcional e botão de limpar.

## Funcionalidades Principais

### Carregamento Dinâmico de Componentes

O `ComponentsLoader` permite carregar apenas os componentes necessários para cada página:

```php
// Carrega apenas os componentes necessários
ComponentsLoader::load(['Button', 'Popup']);
```

### Renderização dos Componentes

Os componentes são renderizados no lado do servidor e incluídos no HTML via PHP:

```php
<?php echo ComponentsLoader::renderComponents(); ?>
```

### Integração com Dados PHP

Os dados do PHP são facilmente incorporados no Vue.js:

```php
// Converte dados PHP para JSON
$programasJson = json_encode(getProgramas());
```

```javascript
// Usa os dados no Vue
const programasData = <?php echo $programasJson; ?>;
```

### Estilização Automática

Cada componente fornece sua própria função de estilização que é aplicada automaticamente:

```javascript
// Aplica os estilos dos componentes
applyButtonStyles();
applyPopupStyles();
applyInputStyles();
```

## Vantagens do Uso de Vue.js nesta Implementação

1. **Reatividade sem complexidade**: O Vue.js oferece sistema de reatividade poderoso sem exigir uma estrutura de SPA completa.

2. **Adoção incremental**: Você pode adotar o Vue.js gradualmente, adicionando componentes conforme necessário sem refatorar todo o sistema.

3. **Melhor experiência de usuário**: Interfaces mais responsivas e interativas sem recarregar a página inteira.

4. **Manutenção simplificada**: Componentes encapsulados são mais fáceis de manter e evoluir.

5. **Sem dependência de ferramentas de build**: Não é necessário configurar Webpack, Babel ou Vue CLI.

6. **Compatibilidade com sistemas legados**: Funciona perfeitamente com sistemas PHP existentes.

7. **Menor curva de aprendizado**: Desenvolvedores PHP podem adotar gradualmente o Vue.js.

## Exemplos de Uso

### Formulário com Componentes Vue

O sistema inclui um formulário completo (`form.php`) que demonstra a integração dos componentes:

```html
<vue-input
    label="Nome Completo"
    v-model="nome"
    placeholder="Digite seu nome completo"
    required
    @clear="handleNomeClear"
></vue-input>

<vue-button
    text="Abrir Popup"
    left-icon="bell"
    @click="showPopup = true"
></vue-button>
```

### Gerenciador de Playlist

O `playlist.php` demonstra um caso de uso mais complexo, com funcionalidades de drag-and-drop e gerenciamento de estado:

```html
<div class="playlist-manager">
    <!-- Painel de Programas Disponíveis -->
    <div class="panel" @dragover.prevent @drop="onDropToAvailable">
        <!-- Conteúdo omitido para brevidade -->
    </div>

    <!-- Painel da Playlist -->
    <div class="panel" :class="{ dragover: isDraggingOver }" @dragover.prevent="isDraggingOver = true" @dragleave="isDraggingOver = false" @drop="onDropToPlaylist">
        <!-- Conteúdo omitido para brevidade -->
    </div>
</div>
```

## Guia: Como Criar um Novo Componente

Siga os passos abaixo para criar um novo componente Vue e integrá-lo ao sistema PHP:

### 1. Crie o arquivo PHP do componente

Crie um novo arquivo PHP na raiz do projeto, por exemplo, `Rating.php`:

```php
<?php
/**
 * Rating.php - Componente Vue Rating transformado em PHP
 */
class Rating {
    /**
     * Renderiza o componente Vue Rating
     *
     * @return string Código JavaScript do componente Vue Rating
     */
    public static function render() {
        return <<<'EOT'
// VueRating Component
export const VueRating = {
    props: {
        modelValue: {
            type: Number,
            default: 0
        },
        maxStars: {
            type: Number,
            default: 5
        },
        size: {
            type: String,
            default: 'medium', // 'small', 'medium', 'large'
            validator: (value) => ['small', 'medium', 'large'].includes(value)
        },
        disabled: {
            type: Boolean,
            default: false
        },
        color: {
            type: String,
            default: '#ffc107' // cor amarela/dourada padrão
        }
    },
    emits: ['update:modelValue'],
    template: `
        <div class="vue-rating" :class="sizeClass">
            <span 
                v-for="star in maxStars" 
                :key="star" 
                class="star" 
                :class="{ 'filled': star <= modelValue, 'disabled': disabled }"
                :style="{ '--star-color': color }"
                @click="!disabled && updateRating(star)"
                @mouseover="!disabled && previewRating(star)"
                @mouseleave="!disabled && resetPreview()"
            >
                <i class="fas fa-star"></i>
            </span>
            <span v-if="showRatingText" class="rating-text">{{ ratingText }}</span>
        </div>
    `,
    data() {
        return {
            previewValue: 0
        };
    },
    computed: {
        sizeClass() {
            return `size-${this.size}`;
        },
        effectiveValue() {
            return this.previewValue || this.modelValue;
        },
        showRatingText() {
            return this.modelValue > 0;
        },
        ratingText() {
            return `${this.modelValue}/${this.maxStars}`;
        }
    },
    methods: {
        updateRating(value) {
            this.$emit('update:modelValue', value);
        },
        previewRating(value) {
            this.previewValue = value;
        },
        resetPreview() {
            this.previewValue = 0;
        }
    }
};

// Estilos do componente
export const applyRatingStyles = () => {
    const style = document.createElement('style');
    style.textContent = `
        .vue-rating {
            display: inline-flex;
            align-items: center;
        }
        
        .vue-rating .star {
            cursor: pointer;
            transition: transform 0.2s ease;
            color: #d1d1d1;
        }
        
        .vue-rating .star.filled {
            color: var(--star-color, #ffc107);
        }
        
        .vue-rating .star.disabled {
            cursor: default;
        }
        
        .vue-rating .star:hover {
            transform: scale(1.2);
        }
        
        .vue-rating .star.disabled:hover {
            transform: none;
        }
        
        .vue-rating.size-small .star {
            font-size: 14px;
            margin: 0 2px;
        }
        
        .vue-rating.size-medium .star {
            font-size: 20px;
            margin: 0 3px;
        }
        
        .vue-rating.size-large .star {
            font-size: 28px;
            margin: 0 4px;
        }
        
        .vue-rating .rating-text {
            margin-left: 8px;
            font-size: 14px;
            color: #777;
        }
    `;
    document.head.appendChild(style);
};
EOT;
    }
}
```

### 2. Registre o componente no ComponentsLoader

Adicione a referência ao seu componente nas páginas onde deseja utilizá-lo:

```php
<?php
// Carrega os arquivos de componentes
require_once 'Button.php';
require_once 'Popup.php';
require_once 'Rating.php'; // Seu novo componente
require_once 'ComponentsLoader.php';

// Carrega os componentes que serão usados na página
ComponentsLoader::load(['Button', 'Popup', 'Rating']);
?>
```

### 3. Aplique os estilos do componente

No script principal da sua página, adicione a chamada para aplicar os estilos:

```javascript
<script type="module">
    <?php echo ComponentsLoader::renderComponents(); ?>

    // Aplica os estilos dos componentes
    applyButtonStyles();
    applyPopupStyles();
    applyRatingStyles(); // Seu novo componente
    
    // Resto do código...
</script>
```

### 4. Registre o componente na instância Vue

Adicione o componente ao objeto de componentes do Vue:

```javascript
createApp({
    components: {
        VueButton,
        VuePopup,
        VueRating // Seu novo componente
    },
    setup() {
        // Código do seu componente...
    }
}).mount('#app');
```

### 5. Use o componente em seu HTML

Agora você pode usar o componente em seu HTML:

```html
<div id="app">
    <!-- Outros elementos... -->
    
    <vue-rating
        v-model="rating"
        :max-stars="5"
        size="large"
        @update:modelValue="handleRatingChange"
    ></vue-rating>
    
    <!-- Outros elementos... -->
</div>
```

### 6. Adicione as propriedades e métodos necessários no setup

```javascript
setup() {
    const rating = ref(0);
    
    function handleRatingChange(newValue) {
        console.log(`Nova avaliação: ${newValue}`);
        // Lógica adicional aqui...
    }
    
    return {
        rating,
        handleRatingChange
    };
}
```

## Boas Práticas

1. **Mantenha os componentes pequenos e focados**: Cada componente deve ter uma única responsabilidade.

2. **Documente as props**: Inclua comentários ou documentação sobre as propriedades e eventos do componente.

3. **Use emits para eventos**: Declare explicitamente os eventos que o componente pode emitir.

4. **Evite dependências externas**: Mantenha os componentes autocontidos para garantir portabilidade.

5. **Teste em vários navegadores**: Alguns recursos mais avançados do Vue.js podem não funcionar em navegadores antigos.

## Conclusão

Esta implementação híbrida PHP-Vue.js oferece um equilíbrio entre a familiaridade do PHP e os benefícios do desenvolvimento frontend moderno com Vue.js. É particularmente útil para projetos que desejam modernizar gradualmente sua interface sem uma refatoração completa.

Ao seguir este guia, você poderá estender o sistema com novos componentes e funcionalidades, mantendo a coesão e a qualidade do código.
