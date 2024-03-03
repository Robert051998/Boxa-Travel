#!/bin/bash
# sudo rm -R /var/cache/yum/x86_64/2/nodesource/
sudo yum install -y gcc-c++ make 
sudo curl --silent --location https://rpm.nodesource.com/setup_16.x | sudo bash -
sudo yum -y install nodejs



# install
cd /var/app/staging/

# debugging..
ls -lah

# npm install --legacy-peer-deps
# npm run build

node -v 
npm -v

# chown -R webapp:webapp node_modules/ || true # allow to fail