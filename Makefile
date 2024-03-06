################ Docker commands ################

# ребилд без глобальных изменений
build:
	docker-compose build

# создание образа с нуля
rebuild:
	docker-compose build --no-cache

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

shell_node:
	docker exec -it protesian_node /usr/bin/bash
