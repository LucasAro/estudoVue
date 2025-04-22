<?php
namespace PhpVue\Components;

use PhpVue\Core\BaseComponent;

/**
 * Datepicker.php - Componente Vue Datepicker simples e funcional
 */
class Datepicker extends BaseComponent {
    /**
     * Retorna o nome do componente Vue
     *
     * @return string
     */
    public static function getName() {
        return 'VueDatepicker';
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
                'default' => 'Selecione uma data'
            ],
            'format' => [
                'type' => 'String',
                'default' => 'YYYY-MM-DD'
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
            'minDate' => [
                'type' => 'String',
                'default' => ''
            ],
            'maxDate' => [
                'type' => 'String',
                'default' => ''
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
<div class="vue-datepicker-wrapper">
    <!-- Slot para label personalizado -->
    <slot name="label">
        <label v-if="label" class="vue-datepicker-label">
            {{ label }}
            <span v-if="required" class="required-mark">*</span>
        </label>
    </slot>

    <div class="vue-datepicker-container" :class="{ disabled: disabled }">
        <!-- Slot para ícone à esquerda personalizado -->
        <slot name="prefix">
            <span class="datepicker-icon"><i class="fas fa-calendar-alt"></i></span>
        </slot>

        <!-- Slot para campo de input personalizado -->
        <slot name="input" :update-date="updateDate" :model-value="modelValue">
            <input
                type="date"
                :value="modelValue"
                :min="minDate"
                :max="maxDate"
                :placeholder="placeholder"
                :disabled="disabled"
                class="vue-datepicker-input"
                @input="updateDate($event.target.value)"
            />
        </slot>

        <!-- Slot para botão de limpar personalizado -->
        <slot name="clear-button" :clear-date="clearDate" :model-value="modelValue" :disabled="disabled">
            <span v-if="modelValue && !disabled" class="datepicker-clear-button" @click="clearDate">
                <i class="fas fa-times"></i>
            </span>
        </slot>
    </div>

    <!-- Slot para conteúdo auxiliar/erro -->
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
            'label' => 'Substitui o label padrão do datepicker.',
            'prefix' => 'Substitui o ícone de calendário à esquerda.',
            'input' => 'Substitui o campo de entrada de data (recebe updateDate e modelValue).',
            'clear-button' => 'Substitui o botão de limpar (recebe clearDate, modelValue e disabled).',
            'helper' => 'Adiciona conteúdo abaixo do campo (texto de ajuda, mensagens de erro).'
        ];
    }

    /**
     * Retorna os eventos que o componente pode emitir
     *
     * @return array
     */
    protected static function getEmits() {
        return ['update:modelValue', 'change'];
    }

    /**
     * Retorna os métodos do componente
     *
     * @return array
     */
    protected static function getMethods() {
        return [
            'updateDate' => '{
                this.$emit("update:modelValue", value);
                this.$emit("change", value);
            }',
            'clearDate' => '{
                this.$emit("update:modelValue", "");
                this.$emit("change", "");
            }',
            'formatDate' => '{
                if (!date) return "";

                // Formato simples YYYY-MM-DD
                const d = new Date(date);
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, "0");
                const day = String(d.getDate()).padStart(2, "0");

                return `${year}-${month}-${day}`;
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
.vue-datepicker-wrapper {
    margin-bottom: 15px;
    position: relative;
}

.vue-datepicker-label {
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

.vue-datepicker-container {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}

.vue-datepicker-container.disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.vue-datepicker-input {
    width: 100%;
    padding: 10px 35px 10px 35px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    line-height: 1.5;
    transition: border 0.2s ease;
    box-sizing: border-box;
}

.vue-datepicker-input:focus {
    outline: none;
    border-color: #ffc107;
    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
}

.vue-datepicker-container.disabled .vue-datepicker-input {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.datepicker-icon {
    position: absolute;
    left: 10px;
    color: #777;
    z-index: 1;
}

.datepicker-clear-button {
    position: absolute;
    right: 10px;
    color: #999;
    cursor: pointer;
    z-index: 1;
}

.datepicker-clear-button:hover {
    color: #dc3545;
}
CSS;
    }
}