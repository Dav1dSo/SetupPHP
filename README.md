docker network create mini_ecommerce_network
 
docker-compose -f .Docker/database/docker-compose-db.yaml up -d

docker-compose -f .Docker/docker-compose.yaml up -d

docker-compose exec web vendor/bin/phinx create NomeDaTabela

docker-compose exec web vendor/bin/phinx migrate -e development

docker-compose exec web vendor/bin/phinx rollback -e development
