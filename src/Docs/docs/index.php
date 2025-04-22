<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação de Componentes PhpVue</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .components { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .component-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .component-name { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
        .component-desc { color: #666; margin-bottom: 15px; }
        .view-button { display: inline-block; background: #ffc107; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Documentação de Componentes PhpVue</h1>
            <p>Total de componentes: 4</p>
        </div>
        <div class="components">
            <div class="component-card">
                <div class="component-name">VueButton (<code>&lt;vue-button&gt;</code>)</div>
                <div class="component-desc">Componente Vue Button com suporte a slots</div>
                <a href="button.php" class="view-button">Ver Documentação</a>
            </div>
            <div class="component-card">
                <div class="component-name">VueInput (<code>&lt;vue-input&gt;</code>)</div>
                <div class="component-desc">Input.php - Componente Vue Input com label opcional, botão de limpar e slots</div>
                <a href="input.php" class="view-button">Ver Documentação</a>
            </div>
            <div class="component-card">
                <div class="component-name">VuePopup (<code>&lt;vue-popup&gt;</code>)</div>
                <div class="component-desc">Popup.php - Componente Vue Popup com suporte a slots</div>
                <a href="popup.php" class="view-button">Ver Documentação</a>
            </div>
            <div class="component-card">
                <div class="component-name">VueDatepicker (<code>&lt;vue-datepicker&gt;</code>)</div>
                <div class="component-desc">Datepicker.php - Componente Vue Datepicker simples e funcional</div>
                <a href="datepicker.php" class="view-button">Ver Documentação</a>
            </div>
        </div>
    </div>
</body>
</html>