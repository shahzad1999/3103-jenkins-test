#! /bin/bash

sudo docker-compose down
sudo docker system prune -af
sudo docker volume prune -af
sudo docker-compose up -d --build
