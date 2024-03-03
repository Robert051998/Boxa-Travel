#!/bin/bash

# install
cd /var/app/current/

# debugging..
echo 'file listing'
ls -lah
echo 'installing'
npm i -D esbuild
npm install --legacy-peer-deps --force
echo 'building'
npm run build --legacy-peer-deps --force
echo 'values'
node -v 
npm -v

# chown -R webapp:webapp node_modules/ || true # allow to fail