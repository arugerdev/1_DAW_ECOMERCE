@echo on
docker build -t aruger/evimerce-db ./docker-db
docker push aruger/evimerce-db
docker build -t aruger/evimerce .
docker push aruger/evimerce
docker-compose up -d