<?php
namespace PhpVue\Components;

use PhpVue\Core\BaseComponent;

/**
 * Input.php - Componente Vue Input com label opcional, botão de limpar e slots
 */
class Input extends BaseComponent {
    /**
     * Retorna o nome do componente Vue
     *
     * @return string
     */
    public static function getName() {
        return 'VueInput';
    }

    /**
     * Retorna as props do componente
     *
     * @return array
     */
    protected static function getProps() {
        return [
            'modelValue' => [
                'type' => 'String',
                'default' => ''
            ],
            'placeholder' => [
                'type' => 'String',
                'default' => ''
            ],
            'type' => [
                'type' => 'String',
                'default' => 'text'
            ],
            'label' => [
                'type' => 'String',
                'default' => ''
            ],
            'required' => [
                'type' => 'Boolean',
                'default' => false
            ],
            'disabled' => [
                'type' => 'Boolean',
                'default' => false
            ],
            'id' => [
                'type' => 'String',
                'default' => '() => `input-${Math.random().toString(36).substring(2, 9)}`'
            ],
            'showClearButton' => [
                'type' => 'Boolean',
                'default' => true
            ]
        ];
    }

    /**
     * Retorna o template do componente
     *
     * @return string
     */
    protected static function getTemplate() {
        return <<<'TEMPLATE'
<div class="vue-input-wrapper">
    <!-- Slot para label personalizado -->
    <slot name="label">
        <label v-if="label" :for="id" class="vue-input-label">
            {{ label }}
            <span v-if="required" class="required-mark">*</span>
        </label>
    </slot>

    <div class="vue-input-container">
        <!-- Slot para conteúdo antes do input -->
        <slot name="prefix"></slot>

        <!-- Slot para substituir completamente o input -->
        <slot name="input">
            <input
                :id="id"
                :type="type"
                :value="modelValue"
                :placeholder="placeholder"
                :disabled="disabled"
                class="vue-input"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </slot>

        <!-- Slot para botão de limpar personalizado -->
        <slot name="clear-button">
            <button
                v-if="showClearButton && modelValue && !disabled"
                type="button"
                class="clear-button"
                @click="clearInput"
                title="Limpar"
            >
                <i class="fas fa-times"></i>
            </button>
        </slot>

        <!-- Slot para conteúdo após o input -->
        <slot name="suffix"></slot>
    </div>

    <!-- Slot para conteúdo abaixo do input (mensagens, etc) -->
    <slot name="helper"></slot>
</div>
TEMPLATE;
    }

    /**
     * Retorna os slots que o componente suporta
     *
     * @return array
     */
    protected static function getSlots() {
        return [
            'label' => 'Substitui o label padrão do input.',
            'prefix' => 'Conteúdo a ser exibido antes do campo de input (ícones, etc).',
            'input' => 'Substitui o campo de input padrão completamente.',
            'clear-button' => 'Substitui o botão de limpar padrão.',
            'suffix' => 'Conteúdo a ser exibido após o campo de input (ícones, unidades, etc).',
            'helper' => 'Conteúdo a ser exibido abaixo do input (textos de ajuda, mensagens de erro, etc).'
        ];
    }

    /**
     * Retorna os eventos que o componente pode emitir
     *
     * @return array
     */
    protected static function getEmits() {
        return ['update:modelValue', 'clear'];
    }

    /**
     * Retorna os métodos do componente
     *
     * @return array
     */
    protected static function getMethods() {
        return [
            'clearInput' => '{
                this.$emit(\'update:modelValue\', \'\');
                this.$emit(\'clear\');
            }'
        ];
    }

    /**
     * Retorna as propriedades computadas
     *
     * @return array
     */
    protected static function getComputed() {
        return [
            'hasValue()' => ' {
                return !!this.modelValue;
            }'
        ];
    }

    /**
     * Retorna os estilos CSS
     *
     * @return string
     */
    protected static function getStyles() {
        return <<<'CSS'
.vue-input-wrapper {
    margin-bottom: 15px;
    position: relative;
}

.vue-input-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #333;
    text-align: left;
}

.required-mark {
    color: #dc3545;
    margin-left: 3px;
}

.vue-input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.vue-input {
    width: 100%;
    padding: 10px 35px 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    line-height: 1.5;
    transition: border 0.2s ease;
    box-sizing: border-box;
}

.vue-input:focus {
    outline: none;
    border-color: #ffc107;
    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
}

.vue-input:disabled {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.clear-button {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    cursor: pointer;
    color: #999;
    font-size: 14px;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s ease;
}

.clear-button:hover {
    color: #dc3545;
}
CSS;
    }
}