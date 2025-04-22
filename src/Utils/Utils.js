function copyCode( id )
{
	const codeElement = document.getElementById( id );
	const text = codeElement.textContent;

	// Criar um elemento de texto temporário
	const textarea = document.createElement( 'textarea' );
	textarea.value = text;
	textarea.setAttribute( 'readonly', '' );
	textarea.style.position = 'absolute';
	textarea.style.left = '-9999px';
	document.body.appendChild( textarea );

	// Selecionar o texto e copiar
	textarea.select();
	document.execCommand( 'copy' );

	// Remover o elemento temporário
	document.body.removeChild( textarea );

	// Feedback visual
	const button = document.querySelector( `#${id}` ).parentNode.querySelector( '.copy-button' );
	const originalText = button.innerHTML;
	button.innerHTML = '<i class="fas fa-check"></i> Copiado!';

	// Restaurar texto original após 2 segundos
	setTimeout( () =>
	{
		button.innerHTML = originalText;
	}, 2000 );
}