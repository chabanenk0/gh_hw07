sudo chown -R dmitry:dmitry app/cache/
chmod -R 777 app/cache/
sudo chown -R dmitry:dmitry app/logs/
chmod -R 777 app/logs/

# composer install

#app/console doctrine:database:create
#app/console doctrine:schema:create