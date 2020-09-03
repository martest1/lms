# README

To run this task:
1. Instal required software:
  - install docker engine
  - install docker-compose
2. In /docker type docker-compose up.
3. SSH into the php docker and install dependencies via composer (composer install inside the docker).
4. Edit the .env file (put the db address and credentials).
5. Inside the php docker, in /var/www/lms run bin/console doctrine:migrations:migrate to populate the db schema.
6. Edit your /etc/hosts and add your domain (i.e. 127.0.0.1 lms.local www.lms.local).

Assumptions taken:
1. In the task description it is mentioned 'Only words with more than 3 letters should be considered;' and in the example it is 'with 3 OR more'. I assumed 3 or more.
2. Sorting can be done via php or via db. I decided to go with the php (its easy to add sorting via mysql).
