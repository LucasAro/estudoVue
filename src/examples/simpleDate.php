<?php
require_once '../autoLoad.php';

use PhpVue\Components\Button;
use PhpVue\Components\DatePicker;
use PhpVue\Core\ComponentsLoader;

ComponentsLoader::load([Button::class, DatePicker::class]);

$aniversarios = [
    ['nome' => 'Lucas Silva', 'data' => '2024-04-20'],
    ['nome' => 'Ana Souza', 'data' => '2024-04-21'],
    ['nome' => 'Pedro Almeida', 'data' => '2024-04-22'],
    ['nome' => 'Mariana Costa', 'data' => '2024-04-23'],
    ['nome' => 'João Paulo', 'data' => '2024-04-24'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Aniversários</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .aniversario { padding: 10px; background: #fff3cd; border: 1px solid #ffeeba; margin-bottom: 10px; border-radius: 5px; }
        .btn { background: #ffc107; border: none; padding: 10px 20px; border-radius: 5px; color: #333; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
<div id="app" class="container">
    <h2>Filtrar aniversários por data</h2>
    <vue-datepicker v-model="filtroData" label="Data do aniversário"></vue-datepicker>
    <vue-button text="Filtrar" @click="filtrar"></vue-button>

    <div class="lista" style="margin-top: 20px">
        <div v-if="filtroAtivo && aniversariosFiltrados.length === 0">
            Nenhum aniversário encontrado.
        </div>
        <div v-for="pessoa in aniversariosFiltrados" :key="pessoa.nome" class="aniversario">
            {{ pessoa.nome }} - {{ formatarData(pessoa.data) }}
        </div>
    </div>
</div>

<script type="module">
    <?= ComponentsLoader::renderVueComponents(); ?>

    if (typeof applyDatepickerStyles === 'function') applyDatepickerStyles();
    if (typeof applyButtonStyles === 'function') applyButtonStyles();

    const { createApp, ref } = Vue;

    createApp({
        components: { VueDatepicker, VueButton },
        setup() {
            const filtroData = ref('');
            const filtroAtivo = ref(false);
            const aniversarios = ref(<?= json_encode($aniversarios, JSON_UNESCAPED_UNICODE) ?>);
            const aniversariosFiltrados = ref([]);

            function filtrar() {
                filtroAtivo.value = true;
                aniversariosFiltrados.value = aniversarios.value.filter(p => p.data === filtroData.value);
            }

            function formatarData(data) {
                const d = new Date(data);
                return d.toLocaleDateString('pt-BR');
            }

            return {
                filtroData,
                filtroAtivo,
                aniversariosFiltrados,
                filtrar,
                formatarData
            };
        }
    }).mount('#app');
</script>
</body>
</html>
