<?php
require_once '../autoLoad.php';

// Importa as classes com namespace
use PhpVue\Components\Button;
use PhpVue\Components\Popup;
use PhpVue\Components\Input;
use PhpVue\Core\ComponentsLoader;

// Carrega os componentes que serão usados na página
ComponentsLoader::load(['Button', 'Popup']);

// Simula dados de programas vindos do banco de dados ou outra fonte
function getProgramas() {
    return [
        [
            'id' => 1,
            'titulo' => 'Documentário: Vida Selvagem',
            'duracao' => '45 min',
            'categoria' => 'Documentário',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Um documentário fascinante sobre a vida selvagem nas savanas africanas.'
        ],
        [
            'id' => 2,
            'titulo' => 'Entrevista: Cientistas do Ano',
            'duracao' => '30 min',
            'categoria' => 'Entrevista',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Entrevista com os cientistas que realizaram as descobertas mais importantes do ano.'
        ],
        [
            'id' => 3,
            'titulo' => 'Debate: Tecnologia e Sociedade',
            'duracao' => '60 min',
            'categoria' => 'Debate',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Especialistas debatem o impacto das novas tecnologias na sociedade contemporânea.'
        ],
        [
            'id' => 4,
            'titulo' => 'Série: História da Humanidade',
            'duracao' => '50 min',
            'categoria' => 'Série',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Uma jornada através dos principais eventos que moldaram a história da humanidade.'
        ],
        [
            'id' => 5,
            'titulo' => 'Especial: Inteligência Artificial',
            'duracao' => '40 min',
            'categoria' => 'Especial',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Um programa especial sobre os avanços recentes em inteligência artificial e seus impactos.'
        ],
        [
            'id' => 6,
            'titulo' => 'Cultura: Arte Moderna',
            'duracao' => '35 min',
            'categoria' => 'Cultura',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Explorando as tendências e movimentos da arte moderna pelo mundo.'
        ],
        [
            'id' => 7,
            'titulo' => 'Ciência: Explorando o Espaço',
            'duracao' => '55 min',
            'categoria' => 'Ciência',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'As últimas descobertas astronômicas e missões espaciais em andamento.'
        ],
        [
            'id' => 8,
            'titulo' => 'Entrevista: Grandes Escritores',
            'duracao' => '40 min',
            'categoria' => 'Entrevista',
            'imagem' => 'https://via.placeholder.com/60x40',
            'descricao' => 'Conversa com os autores mais influentes da literatura contemporânea.'
        ]
    ];
}

// Converte o array de programas para JSON para uso no JavaScript
$programasJson = json_encode(getProgramas());
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Playlist</title>
    <!-- Font Awesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.min.js"></script>
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #dc3545;
            --border-color: #e0e0e0;
            --bg-light: #f8f9fa;
            --text-dark: #333;
            --text-muted: #777;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--text-dark);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: var(--text-muted);
            font-size: 16px;
        }

        .playlist-manager {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .playlist-manager {
                flex-direction: column;
            }
        }

        .panel {
            flex: 1;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .panel-header {
            background-color: var(--primary-color);
            padding: 15px;
            color: var(--text-dark);
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .panel-body {
            padding: 15px;
            flex-grow: 1;
            overflow-y: auto;
            max-height: 500px;
        }

        .program-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .program-item {
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: move;
            background-color: white;
            transition: all 0.2s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .program-item:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .program-item.dragging {
            opacity: 0.5;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .program-info {
            flex: 1;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .program-image {
            width: 60px;
            height: 40px;
            background-color: #eee;
            border-radius: 4px;
            overflow: hidden;
        }

        .program-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .program-details {
            flex: 1;
        }

        .program-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .program-meta {
            font-size: 14px;
            color: var(--text-muted);
            display: flex;
            gap: 15px;
        }

        .program-actions {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            transition: color 0.2s;
            font-size: 16px;
            padding: 5px;
        }

        .btn-icon:hover {
            color: var(--primary-color);
        }

        .btn-icon.remove:hover {
            color: var(--secondary-color);
        }

        .dragover {
            background-color: rgba(255, 193, 7, 0.1);
            border: 2px dashed var(--primary-color);
        }

        .empty-message {
            text-align: center;
            padding: 30px;
            color: var(--text-muted);
            font-style: italic;
        }

        .playlist-actions {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .search-bar {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            border-radius: 30px;
            display: flex;
            align-items: center;
            background-color: white;
        }

        .search-bar .icon {
            color: var(--text-muted);
            margin-right: 10px;
        }

        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 16px;
            padding: 5px 0;
        }

        .playlist-summary {
            background-color: var(--bg-light);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }

        /* Estilo para quando arrastar um item */
        .ghost {
            opacity: 0.4;
            border: 2px dashed var(--primary-color);
        }

        /* A linha que indica onde o item será posicionado */
        .sortable-ghost {
            background-color: #f0f0f0;
        }

        .drop-indicator {
            border: 2px dashed var(--primary-color);
            height: 60px;
            margin-bottom: 10px;
            border-radius: 6px;
            background-color: rgba(255, 193, 7, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="app">
            <div class="header">
                <h1>Gerenciador de Playlist</h1>
                <p>Arraste os programas disponíveis para criar sua playlist personalizada</p>
            </div>

            <div class="playlist-manager">
                <!-- Painel de Programas Disponíveis -->
                <div class="panel"
                    @dragover.prevent
                    @drop="onDropToAvailable">
                    <div class="panel-header">
                        <h2>Programas Disponíveis</h2>
                        <span>{{ availableProgramas.length }} itens</span>
                    </div>
                    <div class="panel-body">
                        <div class="search-bar">
                            <i class="fas fa-search icon"></i>
                            <input
                                type="text"
                                v-model="searchQuery"
                                placeholder="Pesquisar programas..."
                            >
                        </div>

                        <ul class="program-list">
                            <li v-for="programa in filteredAvailableProgramas"
                                :key="programa.id"
                                class="program-item"
                                draggable="true"
                                @dragstart="onDragStart($event, programa, 'available')"
                                @dragend="onDragEnd">
                                <div class="program-info">
                                    <div class="program-image">
                                        <img :src="programa.imagem" :alt="programa.titulo">
                                    </div>
                                    <div class="program-details">
                                        <div class="program-title">{{ programa.titulo }}</div>
                                        <div class="program-meta">
                                            <span><i class="far fa-clock"></i> {{ programa.duracao }}</span>
                                            <span><i class="far fa-folder"></i> {{ programa.categoria }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="program-actions">
                                    <button class="btn-icon" @click="showProgramaInfo(programa)">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button class="btn-icon" @click="addToPlaylist(programa)">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </li>
                            <li v-if="filteredAvailableProgramas.length === 0" class="empty-message">
                                Nenhum programa encontrado
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Painel da Playlist -->
                <div class="panel"
                    :class="{ dragover: isDraggingOver }"
                    @dragover.prevent="isDraggingOver = true"
                    @dragleave="isDraggingOver = false"
                    @drop="onDropToPlaylist">
                    <div class="panel-header">
                        <h2>Minha Playlist</h2>
                        <span>{{ playlist.length }} itens</span>
                    </div>
                    <div class="panel-body">
                        <div v-if="playlist.length === 0" class="empty-message">
                            <p>Sua playlist está vazia</p>
                            <p>Arraste programas para aqui</p>
                        </div>

                        <ul class="program-list">
                            <li v-for="(programa, index) in playlist"
                                :key="programa.id"
                                class="program-item"
                                :data-index="index"
                                draggable="true"
                                @dragstart="onDragStart($event, programa, 'playlist', index)"
                                @dragover.prevent
                                @dragenter.prevent="handleDragEnter($event)"
                                @dragleave="handleDragLeave($event)"
                                @drop="handleItemDrop($event, index)"
                                @dragend="onDragEnd">
                                <div class="program-info">
                                    <div class="program-image">
                                        <img :src="programa.imagem" :alt="programa.titulo">
                                    </div>
                                    <div class="program-details">
                                        <div class="program-title">{{ programa.titulo }}</div>
                                        <div class="program-meta">
                                            <span><i class="far fa-clock"></i> {{ programa.duracao }}</span>
                                            <span><i class="far fa-folder"></i> {{ programa.categoria }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="program-actions">
                                    <button class="btn-icon" @click="showProgramaInfo(programa)">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button class="btn-icon remove" @click="removeFromPlaylist(index)">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>

                        <div v-if="playlist.length > 0" class="playlist-summary">
                            <div class="summary-item">
                                <span>Total de programas:</span>
                                <span>{{ playlist.length }}</span>
                            </div>
                            <div class="summary-item">
                                <span>Tempo estimado:</span>
                                <span>{{ totalDuration }}</span>
                            </div>
                            <div class="summary-total">
                                <span>Playlist:</span>
                                <span>{{ playlistName || 'Minha Playlist' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="playlist-actions">
                <vue-button
                    text="Limpar Playlist"
                    type="cancel"
                    left-icon="trash-alt"
                    @click="confirmClear"
                    :disabled="playlist.length === 0"
                ></vue-button>

                <vue-button
                    text="Renomear Playlist"
                    left-icon="edit"
                    @click="showRenamePopup"
                    :disabled="playlist.length === 0"
                ></vue-button>

                <vue-button
                    text="Salvar Playlist"
                    right-icon="save"
                    :loading="isSaving"
                    @click="savePlaylist"
                    :disabled="playlist.length === 0"
                ></vue-button>
            </div>

            <!-- Popup para informações do programa -->
            <vue-popup
                :title="selectedPrograma ? selectedPrograma.titulo : 'Informações do Programa'"
                :use-html-content="true"
                :html-content="programaInfoHTML"
                :show-popup="showInfoPopup"
                confirm-text="Fechar"
                :show-cancel-button="false"
                @confirm="showInfoPopup = false"
            ></vue-popup>

            <!-- Popup para confirmar limpar playlist -->
            <vue-popup
                title="Limpar Playlist"
                message="Tem certeza que deseja limpar toda a playlist? Esta ação não pode ser desfeita."
                confirm-text="Sim, Limpar"
                cancel-text="Cancelar"
                :show-popup="showClearPopup"
                @confirm="clearPlaylist"
                @cancel="showClearPopup = false"
            ></vue-popup>

            <!-- Popup para renomear playlist -->
            <vue-popup
                title="Renomear Playlist"
                :use-html-content="true"
                :html-content="renamePlaylistHTML"
                confirm-text="Salvar Nome"
                cancel-text="Cancelar"
                :show-popup="showRenamePlaylistPopup"
                @confirm="savePlaylistName"
                @cancel="showRenamePlaylistPopup = false"
            ></vue-popup>

            <!-- Popup para sucesso ao salvar -->
            <vue-popup
                title="Playlist Salva"
                message="Sua playlist foi salva com sucesso!"
                confirm-text="Ok"
                :show-cancel-button="false"
                :show-popup="showSuccessPopup"
                @confirm="showSuccessPopup = false"
            ></vue-popup>
        </div>
    </div>

    <!-- Script que carrega os componentes do PHP -->
    <script type="module">
        <?php echo ComponentsLoader::renderComponents(); ?>

        // Aplica os estilos dos componentes
        applyButtonStyles();
        applyPopupStyles();

        // Cria a aplicação Vue
        const { createApp, ref, computed, onMounted } = Vue;

        createApp({
            components: {
                VueButton,
                VuePopup
            },
            setup() {
                // Dados dos programas que vêm do PHP
                const programasData = <?php echo $programasJson; ?>;

                // Estados para os programas e playlist
                const allProgramas = ref([...programasData]);
                const availableProgramas = ref([...programasData]);
                const playlist = ref([]);
                const playlistName = ref('');

                // Estados para busca
                const searchQuery = ref('');

                // Estados para drag and drop
                const isDraggingOver = ref(false);
                const draggedPrograma = ref(null);
                const dragSource = ref('');
                const dragIndex = ref(-1);

                // Estados para popups
                const selectedPrograma = ref(null);
                const showInfoPopup = ref(false);
                const showClearPopup = ref(false);
                const showRenamePlaylistPopup = ref(false);
                const showSuccessPopup = ref(false);
                const newPlaylistName = ref('');

                // Estado para salvar
                const isSaving = ref(false);

                // Computed properties
                const filteredAvailableProgramas = computed(() => {
                    if (!searchQuery.value) return availableProgramas.value;

                    const query = searchQuery.value.toLowerCase();
                    return availableProgramas.value.filter(programa =>
                        programa.titulo.toLowerCase().includes(query) ||
                        programa.categoria.toLowerCase().includes(query)
                    );
                });

                const totalDuration = computed(() => {
                    if (playlist.value.length === 0) return '0 min';

                    // Suponha que todas as durações estejam no formato "XX min"
                    let total = 0;
                    playlist.value.forEach(programa => {
                        const minutes = parseInt(programa.duracao);
                        if (!isNaN(minutes)) {
                            total += minutes;
                        }
                    });

                    // Formata para horas e minutos se for mais de 60 minutos
                    if (total >= 60) {
                        const hours = Math.floor(total / 60);
                        const mins = total % 60;
                        return `${hours}h ${mins}min`;
                    }

                    return `${total} min`;
                });

                const programaInfoHTML = computed(() => {
                    if (!selectedPrograma.value) return '';

                    return `
                        <div style="text-align: left;">
                            <div style="margin-bottom: 15px;">
                                <img src="${selectedPrograma.value.imagem}" alt="${selectedPrograma.value.titulo}"
                                     style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <p style="font-weight: bold; font-size: 18px; margin: 0 0 5px 0;">${selectedPrograma.value.titulo}</p>
                                <p style="color: #777; margin: 0 0 15px 0;">
                                    <span style="margin-right: 15px;"><i class="far fa-clock"></i> ${selectedPrograma.value.duracao}</span>
                                    <span><i class="far fa-folder"></i> ${selectedPrograma.value.categoria}</span>
                                </p>
                            </div>
                            <div>
                                <p style="margin: 0; line-height: 1.5;">${selectedPrograma.value.descricao}</p>
                            </div>
                        </div>
                    `;
                });

                const renamePlaylistHTML = computed(() => {
                    return `
                        <div>
                            <p style="margin-bottom: 15px;">Digite um novo nome para sua playlist:</p>
                            <input type="text" id="playlist-name-input" value="${playlistName.value}"
                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px;">
                        </div>
                    `;
                });

                // Funções para manipular a playlist
                function addToPlaylist(programa) {
                    // Verifica se o programa já está na playlist
                    const exists = playlist.value.some(p => p.id === programa.id);
                    if (exists) return;

                    // Adiciona à playlist e remove dos disponíveis
                    playlist.value.push(programa);
                    removeFromAvailable(programa.id);
                }

                function removeFromPlaylist(index) {
                    const programa = playlist.value[index];
                    playlist.value.splice(index, 1);
                    availableProgramas.value.push(programa);
                }

                function removeFromAvailable(id) {
                    const index = availableProgramas.value.findIndex(p => p.id === id);
                    if (index !== -1) {
                        availableProgramas.value.splice(index, 1);
                    }
                }

                function clearPlaylist() {
                    // Retorna todos os programas da playlist para disponíveis
                    availableProgramas.value = [...availableProgramas.value, ...playlist.value];
                    playlist.value = [];
                    showClearPopup.value = false;
                }

                // Funções para drag and drop
                function onDragStart(event, programa, source, index) {
                    event.dataTransfer.effectAllowed = 'move';
                    event.target.classList.add('dragging');

                    // Armazena informações sobre o item sendo arrastado
                    draggedPrograma.value = programa;
                    dragSource.value = source;
                    if (index !== undefined) {
                        dragIndex.value = index;
                    }
                }

                function onDragEnd(event) {
                    event.target.classList.remove('dragging');
                    isDraggingOver.value = false;
                }

                function onDropToPlaylist(event) {
                    event.preventDefault();
                    isDraggingOver.value = false;

                    if (!draggedPrograma.value) return;

                    if (dragSource.value === 'available') {
                        // Adiciona à playlist
                        addToPlaylist(draggedPrograma.value);
                    } else if (dragSource.value === 'playlist') {
                        // Verificar se o drop foi sobre um item da playlist (para reordenar)
                        const targetItem = findDropTarget(event.target);
                        if (targetItem) {
                            const targetIndex = parseInt(targetItem.getAttribute('data-index'));
                            if (!isNaN(targetIndex) && targetIndex !== dragIndex.value) {
                                reorderPlaylist(dragIndex.value, targetIndex);
                            }
                        }
                    }

                    draggedPrograma.value = null;
                    dragSource.value = '';
                    dragIndex.value = -1;
                }

                // Função auxiliar para encontrar o item alvo do drop
                function findDropTarget(element) {
                    // Procura pelo elemento com a classe 'program-item' subindo na árvore DOM
                    let current = element;
                    while (current && !current.classList.contains('program-item')) {
                        current = current.parentElement;
                        // Se chegamos no painel, não encontramos um item
                        if (current && current.classList.contains('panel')) {
                            return null;
                        }
                    }
                    return current;
                }

                // Função para reordenar itens na playlist
                function reorderPlaylist(fromIndex, toIndex) {
                    // Remove o item da posição original
                    const [movedItem] = playlist.value.splice(fromIndex, 1);

                    // Insere na nova posição
                    playlist.value.splice(toIndex, 0, movedItem);
                }

                function onDropToAvailable(event) {
                    event.preventDefault();

                    if (!draggedPrograma.value || dragSource.value !== 'playlist') return;

                    // Remove da playlist
                    removeFromPlaylist(dragIndex.value);

                    draggedPrograma.value = null;
                    dragSource.value = '';
                    dragIndex.value = -1;
                }

                // Funções para popups
                function showProgramaInfo(programa) {
                    selectedPrograma.value = programa;
                    showInfoPopup.value = true;
                }

                function confirmClear() {
                    showClearPopup.value = true;
                }

                function showRenamePopup() {
                    newPlaylistName.value = playlistName.value;
                    showRenamePlaylistPopup.value = true;

                    // Precisamos acessar o input manualmente após o popup ser mostrado
                    setTimeout(() => {
                        const input = document.getElementById('playlist-name-input');
                        if (input) {
                            input.value = playlistName.value;
                            input.focus();
                        }
                    }, 100);
                }

                function savePlaylistName() {
                    const input = document.getElementById('playlist-name-input');
                    if (input) {
                        playlistName.value = input.value.trim();
                    }
                    showRenamePlaylistPopup.value = false;
                }

                function savePlaylist() {
                    if (playlist.value.length === 0) return;

                    isSaving.value = true;

                    // Simulação de salvamento
                    setTimeout(() => {
                        isSaving.value = false;
                        showSuccessPopup.value = true;

                        // Aqui você implementaria a lógica real para enviar ao servidor
                        const playlistData = {
                            name: playlistName.value || 'Minha Playlist',
                            items: playlist.value.map(p => p.id),
                            createdAt: new Date().toISOString()
                        };

                        console.log('Playlist salva:', playlistData);
                    }, 1500);
                }

                // Funções para o drag and drop entre itens da playlist
                function handleDragEnter(event) {
                    const item = findDropTarget(event.target);
                    if (item && dragSource.value === 'playlist') {
                        item.classList.add('drag-over');
                    }
                }

                function handleDragLeave(event) {
                    const item = findDropTarget(event.target);
                    if (item) {
                        item.classList.remove('drag-over');
                    }
                }

                function handleItemDrop(event, targetIndex) {
                    event.preventDefault();

                    // Remover classe de todos os itens
                    document.querySelectorAll('.program-item').forEach(item => {
                        item.classList.remove('drag-over');
                    });

                    if (dragSource.value === 'playlist' && dragIndex.value !== targetIndex) {
                        reorderPlaylist(dragIndex.value, targetIndex);
                    } else if (dragSource.value === 'available') {
                        // Adicionar de programas disponíveis para playlist
                        addToPlaylist(draggedPrograma.value);
                    }

                    draggedPrograma.value = null;
                    dragSource.value = '';
                    dragIndex.value = -1;
                }

                return {
                    availableProgramas,
                    playlist,
                    playlistName,
                    searchQuery,
                    isDraggingOver,
                    selectedPrograma,
                    showInfoPopup,
                    showClearPopup,
                    showRenamePlaylistPopup,
                    showSuccessPopup,
                    isSaving,
                    filteredAvailableProgramas,
                    totalDuration,
                    programaInfoHTML,
                    renamePlaylistHTML,
                    addToPlaylist,
                    removeFromPlaylist,
                    clearPlaylist,
                    onDragStart,
                    onDragEnd,
                    onDropToPlaylist,
                    onDropToAvailable,
                    showProgramaInfo,
                    confirmClear,
                    showRenamePopup,
                    savePlaylistName,
                    savePlaylist,
                    handleDragEnter,
                    handleDragLeave,
                    handleItemDrop
                };
            }
        }).mount('#app');
    </script>
</body>
</html>