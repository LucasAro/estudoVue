<?php
namespace PhpVue\Components;

use PhpVue\Core\BaseComponent;

/**
 * Componente Vue Button
 */
class Button extends BaseComponent {
    /**
     * Retorna o nome do componente Vue
     *
     * @return string
     */
    public static function getName() {
        return 'VueButton';
    }

    /**
     * Retorna as props do componente
     *
     * @return array
     */
    protected static function getProps() {
        return [
            'text' => [
                'type' => 'String',
                'default' => 'Button'
            ],
            'leftIcon' => [
                'type' => 'String',
                'default' => ''
            ],
            'rightIcon' => [
                'type' => 'String',
                'default' => ''
            ],
            'disabled' => [
                'type' => 'Boolean',
                'default' => false
            ],
            'loading' => [
                'type' => 'Boolean',
                'default' => false
            ],
            'type' => [
                'type' => 'String',
                'default' => 'default',
                'validator' => "(value) => ['default', 'cancel'].includes(value)"
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
<button
    :class="classes"
    :disabled="disabled || loading"
    @click="$emit('click', $event)"
>
    <i v-if="leftIcon && !loading" :class="'fas fa-' + leftIcon" class="left-icon"></i>
    <i v-if="loading" class="fas fa-spinner fa-spin left-icon"></i>
    <span class="text">{{ text }}</span>
    <i v-if="rightIcon && !loading" :class="'fas fa-' + rightIcon" class="right-icon"></i>
</button>
TEMPLATE;
    }

    /**
     * Retorna os eventos que o componente pode emitir
     *
     * @return array
     */
    protected static function getEmits() {
        return ['click'];
    }

    /**
     * Retorna as propriedades computadas
     *
     * @return array
     */
    protected static function getComputed() {
        return [
            'classes()' => ' {
                return {
                    "vue-button": true,
                    "disabled": this.disabled,
                    "loading": this.loading,
                    "cancel": this.type === "cancel",
                    "default": this.type === "default"
                };
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
.vue-button {
    padding: 10px 20px;
    border: none;
    border-radius: 100px;
    font-size: 16px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    background-color: #ffc107;
    color: #333;
    min-width: 120px;
}

.vue-button:hover:not(.disabled) {
    filter: brightness(0.9);
}

.vue-button.disabled {
    background-color: #cccccc !important;
    color: #666666 !important;
    cursor: not-allowed;
}

.vue-button.cancel {
    background-color: #dc3545;
    color: white;
}

.vue-button .left-icon {
    margin-right: 8px;
}

.vue-button .right-icon {
    margin-left: 8px;
}

.vue-button.loading {
    opacity: 0.8;
    cursor: wait;
}
CSS;
    }
}