FROM ubuntu:xenial
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -y dist-upgrade
RUN apt-get install -y --no-install-recommends php7.0-cli php7.0-xml php7.0-mbstring php-xdebug
RUN apt-get install -y --no-install-recommends ca-certificates
RUN apt-get install -y --no-install-recommends ssh
RUN echo 'root:docker' | chpasswd
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

EXPOSE 22