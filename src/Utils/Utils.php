<?php
	// Função para criar código com botão de copiar
	function createCodeBlock($code, $language = 'html') {
		$id = 'code-' . rand(1000, 9999);
		$html = '<div class="code-terminal">
			<div class="code-header">
				<span class="language-label">' . $language . '</span>
				<button class="copy-button" onclick="copyCode(\'' . $id . '\')"><i class="fas fa-copy"></i> Copiar</button>
			</div>
			<pre class="code-content" id="' . $id . '">' . htmlspecialchars($code) . '</pre>
		</div>';
		return $html;
	}
?>