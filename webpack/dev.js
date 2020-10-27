/* eslint-disable import/no-extraneous-dependencies */
const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Dotenv = require('dotenv-webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const constants = require('./constants');
const loaders = require('./loaders');

const isHotReload = (constants.WATCH_MODE === 'server');

const definePluginConfig = {
  'process.env': {
    NODE_ENV: JSON.stringify('development'),
    API_URL: JSON.stringify(process.env.API_URL || '/api'),
    SENTRY_DNS: JSON.stringify(process.env.SENTRY_DNS || ''),
    BUILD_NO: constants.BUILD_NO,
    VERSION: JSON.stringify(constants.VERSION),
  },
};

const host = process.env.HOST || 'localhost';
const port = parseInt(process.env.PORT, 10) || 3030;

const cssExtractorOptions = {
  filename: 'css/[name].css',
};

const config = {
  mode: 'development',

  // Enable sourcemaps for debugging webpack's output.
  devtool: 'eval-source-maps',

  entry: {
    client: isHotReload ? [
      `webpack-hot-middleware/client?reload=true&path=http://${host}:${port}/__webpack_hmr`,
      './front/client',
    ] : './front/client',
    keeper: isHotReload ? [
      `webpack-hot-middleware/client?reload=true&path=http://${host}:${port}/__webpack_hmr`,
      './front/keeper',
    ] : './front/keeper',
    ie11: [
      './front/ie11',
    ],
    writeaway: [
      './front/writeaway',
    ],
  },

  resolve: {
    extensions: ['.ts', '.tsx', '.js', '.jsx'],
    modules: [path.resolve(__dirname), 'node_modules', 'src'],
  },

  output: {
    path: path.resolve('./public/generated/'),
    publicPath: `http://${host}:${port}/generated`,
    filename: '[name].js',
    chunkFilename: '[name].chunk.js',
    pathinfo: true,
  },
  optimization: {
    noEmitOnErrors: true,
  },

  node: {
    fs: 'empty',
  },
  plugins: [
    new Dotenv(),
    new webpack.DefinePlugin(definePluginConfig),
    // Hot reload will load stuff with style-loader, watch mode will just update files
    (isHotReload ? new webpack.HotModuleReplacementPlugin() : new MiniCssExtractPlugin(cssExtractorOptions)),
    /* new HtmlWebpackPlugin({
      template: 'front/index.html',
    }), */
  ],
  module: {
    rules: loaders,
  },
};
module.exports = config;
