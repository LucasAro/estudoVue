<?php
namespace PhpVue\Components;

use PhpVue\Core\BaseComponent;

/**
 * Popup.php - Componente Vue Popup usando BaseComponent
 */
class Popup extends BaseComponent {
    /**
     * Retorna o nome do componente Vue
     *
     * @return string
     */
    public static function getName() {
        return 'VuePopup';
    }

    /**
     * Retorna as props do componente
     *
     * @return array
     */
    protected static function getProps() {
        return [
            'title' => [
                'type' => 'String',
                'default' => 'Popup'
            ],
            'showTitle' => [
                'type' => 'Boolean',
                'default' => true
            ],
            'message' => [
                'type' => 'String',
                'default' => 'Conteúdo do popup'
            ],
            'htmlContent' => [
                'type' => 'String',
                'default' => ''
            ],
            'useHtmlContent' => [
                'type' => 'Boolean',
                'default' => false
            ],
            'confirmText' => [
                'type' => 'String',
                'default' => 'Salvar'
            ],
            'showConfirmButton' => [
                'type' => 'Boolean',
                'default' => true
            ],
            'cancelText' => [
                'type' => 'String',
                'default' => 'Cancelar'
            ],
            'showCancelButton' => [
                'type' => 'Boolean',
                'default' => true
            ],
            'showCloseButton' => [
                'type' => 'Boolean',
                'default' => true
            ],
            'showPopup' => [
                'type' => 'Boolean',
                'default' => false
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
<div v-if="showPopup" class="popup-overlay">
  <div class="popup-container">
    <div v-if="showTitle || showCloseButton" class="popup-header" :class="{ 'no-title': !showTitle }">
      <h2 v-if="showTitle">{{ title }}</h2>
      <button v-if="showCloseButton" class="close-button" @click="$emit('cancel')">&times;</button>
    </div>
    <div class="popup-content">
      <!-- Verifica se deve usar conteúdo HTML ou texto simples -->
      <p v-if="!useHtmlContent">{{ message }}</p>
      <!-- Use v-html para renderizar HTML -->
      <div v-else v-html="htmlContent"></div>
    </div>
    <div v-if="showConfirmButton || showCancelButton" class="popup-actions">
      <button v-if="showConfirmButton" class="confirm-button" @click="$emit('confirm')">{{ confirmText }}</button>
      <button v-if="showCancelButton" class="cancel-button" @click="$emit('cancel')">{{ cancelText }}</button>
    </div>
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
        return ['confirm', 'cancel'];
    }

    /**
     * Retorna os estilos CSS
     *
     * @return string
     */
    protected static function getStyles() {
        return <<<'CSS'
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-container {
  background-color: white;
  border-radius: 8px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.popup-header {
  background-color: #FFCD39;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.popup-header.no-title {
  justify-content: flex-end;
  padding: 10px 15px;
}

.popup-header h2 {
  margin: 0;
  font-size: 20px;
  color: #000;
}

.close-button {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #000;
}

.popup-content {
  padding: 30px 20px;
  text-align: center;
}

.popup-content p {
  font-size: 20px;
  margin: 0;
  line-height: 1.5;
}

.popup-actions {
  display: flex;
  justify-content: center;
  padding: 20px;
  gap: 15px;
}

.confirm-button {
  background-color: #FFCD39;
  color: #000;
  border: none;
  border-radius: 50px;
  padding: 10px 25px;
  font-size: 16px;
  cursor: pointer;
  min-width: 100px;
}

.cancel-button {
  background-color: #CCCCCC;
  color: #000;
  border: none;
  border-radius: 50px;
  padding: 10px 25px;
  font-size: 16px;
  cursor: pointer;
  min-width: 100px;
}
CSS;
    }
}