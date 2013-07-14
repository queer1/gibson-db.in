all:
	php _build/build-command-pages.php
	php _build/build-sitemap.php

install:
	rsync -rtvz \
    	--exclude '*.swp' \
    	--exclude '_build' \
    	--exclude 'blog' \
    	--exclude '.idea' \
    	--exclude '.settings' \
		--exclude '.git' \
		--exclude '.gitignore' \
    	--exclude 'Makefile' \
    	. evilsocket@gibson-db.in:/var/www/gibson-db.in/www/

clean:
	rm commands.php command-*.php sitemap.xml
