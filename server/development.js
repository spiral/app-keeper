const path = require('path');
const webpack = require('webpack');
const webpackDevMiddleware = require('webpack-dev-middleware');
const webpackHotMiddleware = require('webpack-hot-middleware');

function createWebpackMiddleware(compiler, publicPath) {
  return webpackDevMiddleware(compiler, {
    logLevel: 'warn',
    publicPath,
    silent: true,
    stats: 'errors-only',
    allowedHosts: ['localhost:8080', 'localhost:3030'],
    headers: { 'Access-Control-Allow-Origin': '*' },
  });
}

module.exports = function middleware(app, webpackConfig, opts) {
  const compiler = webpack(webpackConfig);
  const webpackMiddleware = createWebpackMiddleware(
    compiler,
    webpackConfig.output.publicPath,
  );

  app.use(webpackMiddleware);
  app.use(webpackHotMiddleware(compiler));

  const fs = webpackMiddleware.fileSystem;

  app.get('*', (req, res) => {
    fs.readFile(path.join(compiler.outputPath, 'index.html'), (err, file) => {
      if (err) {
        res.sendStatus(404);
      } else {
        res.send(file.toString());
      }
    });
  });
};
