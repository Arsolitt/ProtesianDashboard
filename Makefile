################ Docker commands ################

# создание образа с нуля
build:
	docker-compose build --no-cache
# ребилд без глобальных изменений
rebuild:
	docker-compose build
# создать контейнер
up:
	docker-compose up -d
# выключить контейнер
down:
	docker-compose down
# зайти в терминал контейнера
shell_php:
	docker exec -it protesian_php /usr/bin/bash

shell_mysql:
	docker exec -it protesian_mysql /usr/bin/bash