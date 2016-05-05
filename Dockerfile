FROM ubuntu:xenial
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
    apt-get -y upgrade && \
    apt-get -y dist-upgrade && \
    apt-get install -y --no-install-recommends php7.0-cli php7.0-xml php7.0-mbstring php-xdebug