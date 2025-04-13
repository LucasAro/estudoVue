<?php
namespace PhpVue\Components;

use PhpVue\Core\BaseComponent;

/**
 * Input.php - Componente Vue Input com label opcional e botão de limpar
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
                // Corrigido: Usando sintaxe de string simples
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
    <label v-if="label" :for="id" class="vue-input-label">
        {{ label }}
        <span v-if="required" class="required-mark">*</span>
    </label>
    <div class="vue-input-container">
        <input
            :id="id"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            :disabled="disabled"
            class="vue-input"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <button
            v-if="showClearButton && modelValue && !disabled"
            type="button"
            class="clear-button"
            @click="clearInput"
            title="Limpar"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
TEMPLATE;
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