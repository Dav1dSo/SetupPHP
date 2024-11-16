docker network create mini_ecommerce_network
 
docker-compose -f .Docker/database/docker-compose-db.yaml up -d

docker-compose -f .Docker/docker-compose.yaml up -d


