<?php
/**
 * Input.php - Componente Vue Input com label opcional e botão de limpar
 */
class Input {
    /**
     * Renderiza o componente Vue Input
     *
     * @return string Código JavaScript do componente Vue Input
     */
    public static function render() {
        return <<<'EOT'
// VueInput Component
export const VueInput = {
    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'text'
        },
        label: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        id: {
            type: String,
            default: () => `input-${Math.random().toString(36).substring(2, 9)}`
        },
        showClearButton: {
            type: Boolean,
            default: true
        }
    },
    emits: ['update:modelValue', 'clear'],
    template: `
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
    `,
    methods: {
        clearInput() {
            this.$emit('update:modelValue', '');
            this.$emit('clear');
        }
    }
};

// Estilos do componente
export const applyInputStyles = () => {
    const style = document.createElement('style');
    style.textContent = `
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
    `;
    document.head.appendChild(style);
};
EOT;
    }
}