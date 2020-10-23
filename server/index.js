const express = require('express');
const { resolve } = require('path');

const app = express();

const isProduction = process.env.NODE_ENV === 'production';


const host = process.env.HOST || 'localhost';
const port = parseInt(process.env.PORT, 10) || 3030;

if (isProduction) {
  const middleware = require('./production'); // eslint-disable-line
  middleware(app, {
    outputPath: resolve(process.cwd(), '../build'),
    publicPath: '/',
  });
} else {
  const webpackConfig = require('../webpack'); // eslint-disable-line
  const middleware = require('./development'); // eslint-disable-line
  middleware(app, webpackConfig);
}

app.listen(port, host, async (err) => {
  if (err) {
    // eslint-disable-next-line no-console
    return console.error(err.message);
  }

  // eslint-disable-next-line no-console
  return console.log(`
Server started: http://${host || 'localhost'}:${port}
Press CTRL-C to stop
    `);
});
