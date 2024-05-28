FROM mysql:latest 
ENV MYSQL_DATABASE quizai
COPY ./scripts/ /docker-entrypoint-initdb.d/