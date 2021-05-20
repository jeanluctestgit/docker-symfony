FROM node:14.16.1-alpine

WORKDIR /home/node/app

RUN npm install -g @angular/cli

COPY ../../front/package.json .
EXPOSE 4200
CMD npm install && ng build && ng serve