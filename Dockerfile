FROM php:7.2-apache

# Instalar ferramentas úteis para desenvolvimento
RUN apt-get update && apt-get install -y \
	git \
	zip \
	unzip \
	curl \
	vim \
	&& rm -rf /var/lib/apt/lists/*

# Configurar permissões para o diretório web
RUN chown -R www-data:www-data /var/www/html \
	&& chmod -R 755 /var/www/html

# Expor a porta 80
EXPOSE 80

# Criar um arquivo index.php inicial com Hello World
RUN echo '<?php echo "<p>Hello World</p>"; ?>' > /var/www/html/index.php

# Comando para iniciar o Apache em primeiro plano
CMD ["apache2-foreground"]