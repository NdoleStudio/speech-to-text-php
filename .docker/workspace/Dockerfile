FROM laradock/workspace:2.2-7.2

# Beautifying the terminal
RUN echo 'export PS1="\[$(tput bold)\]\[$(tput setaf 3)\][\u@\h:\[$(tput setaf 2)\]\w\[$(tput setaf 3)\]]\\$ \[$(tput sgr0)\]"' >> ~/.bashrc

# Installing Node Js and Yarn
RUN apt-get update && apt-get install wget && wget -qO- https://deb.nodesource.com/setup_8.x | bash && apt-get install -y nodejs && apt-get install -y build-essential && curl -o- -L https://yarnpkg.com/install.sh | bash && export PATH="$HOME/.yarn/bin:$HOME/.config/yarn/global/node_modules/.bin:$PATH"

WORKDIR /srv/app/