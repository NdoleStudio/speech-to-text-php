FROM laradock/workspace:2.2-7.2

# Beautifying the terminal
RUN echo 'export PS1="\[$(tput bold)\]\[$(tput setaf 3)\][\u@\h:\[$(tput setaf 2)\]\w\[$(tput setaf 3)\]]\\$ \[$(tput sgr0)\]"' >> ~/.bashrc

# Installing Dependencies
RUN apt-get update && apt-get install wget && wget -qO- https://deb.nodesource.com/setup_8.x | bash && apt-get install -y nodejs && apt-get install -y build-essential && curl -o- -L https://yarnpkg.com/install.sh | bash && apt-get -y install redis-server && apt-get install -y ffmpeg

COPY . /srv/app

WORKDIR /srv/app/

RUN $HOME/.yarn/bin/yarn && composer install && npm run dev

ARG PORT

EXPOSE $PORT

RUN echo "#!/bin/bash \n redis-server --daemonize yes && php artisan serve --host 0.0.0.0 --port $PORT & php artisan queue:listen --timeout=40000" > ./entrypoint.sh

RUN chmod +x ./entrypoint.sh

ENTRYPOINT ["./entrypoint.sh"]