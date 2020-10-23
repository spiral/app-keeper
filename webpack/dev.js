/* eslint-disable import/no-extraneous-dependencies */
const webpack = require('webpack');
const path = require('path');
const Dotenv = require('dotenv-webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const constants = require('./constants');
const loaders = require('./loaders');

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
    client: [
      `webpack-hot-middleware/client?reload=true&path=http://${host}:${port}/__webpack_hmr`,
      './front/client',
    ],
    keeper: [
      './front/keeper',
    ],
  },

  resolve: {
    extensions: ['.ts', '.tsx', '.js', '.jsx'],
    modules: [path.resolve(__dirname), 'node_modules', 'src'],
  },

  output: {
    path: path.resolve('./public/generated/'),
    publicPath: `http://${host}:${port}/`,
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
    new MiniCssExtractPlugin(cssExtractorOptions),
    new webpack.HotModuleReplacementPlugin(),
    new HtmlWebpackPlugin({
      template: 'front/index.html',
    }),
  ],
  module: {
    rules: loaders,
  },
};
module.exports = config;
