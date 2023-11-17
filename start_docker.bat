@Echo Off
docker-compose -f docker-compose.yaml build && docker-compose -f docker-compose.yaml up
pause