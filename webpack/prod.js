/* eslint-disable import/no-extraneous-dependencies */
const webpack = require('webpack');
const path = require('path');
const Dotenv = require('dotenv-webpack');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const safePostCssParser = require('postcss-safe-parser');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const constants = require('./constants');
const loaders = require('./loaders');

const isFastBuild = !!process.env.FAST_BUILD;
const shouldUseSourceMap = !process.env.SKIP_SOURCE_MAP;
const isWsl = false;
const isEnvProductionProfile = !isFastBuild;

const definePluginConfig = {
  'process.env': {
    NODE_ENV: JSON.stringify('development'),
    API_URL: JSON.stringify(process.env.API_URL || '/api'),
    SENTRY_DNS: JSON.stringify(process.env.SENTRY_DNS || ''),
    BUILD_NO: constants.BUILD_NO,
    VERSION: JSON.stringify(constants.VERSION),
  },
};

const cssExtractorOptions = {
  filename: 'css/[name].css',
};

const config = {
  mode: 'production',

  bail: true,

  // Enable sourcemaps for debugging webpack's output.
  devtool: 'source-map',

  entry: {
    client: [
      './front/client',
    ],
    ie11: [
      './front/ie11',
    ],
    keeper: [
      './front/keeper',
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
    path: path.resolve('./public/generated'),
    publicPath: '/generated/',
    filename: '[name].js',
    chunkFilename: '[name].chunk.js',
  },
  plugins: isFastBuild ? [
    new Dotenv(),
    new webpack.DefinePlugin(definePluginConfig),
    new MiniCssExtractPlugin(cssExtractorOptions),
    new HtmlWebpackPlugin({
      template: 'front/index.html',
    }),
  ] : [
    new Dotenv(),
    new BundleAnalyzerPlugin({
      analyzerMode: 'static',
      generateStatsFile: true,
      reportFilename: 'bundle_report.html',
      statsFilename: 'bundle_stats.json',
      openAnalyzer: false,
    }),
    new webpack.DefinePlugin(definePluginConfig),
    new MiniCssExtractPlugin(cssExtractorOptions),
    new HtmlWebpackPlugin({
      template: 'front/index.html',
    }),
  ],
  module: {
    rules: loaders,
  },

  node: {
    fs: 'empty',
  },
  optimization: {
    minimize: true,
    minimizer: [
      // This is only used in production mode
      new TerserPlugin({
        terserOptions: {
          parse: {
            // We want terser to parse ecma 8 code. However, we don't want it
            // to apply any minification steps that turns valid ecma 5 code
            // into invalid ecma 5 code. This is why the 'compress' and 'output'
            // sections only apply transformations that are ecma 5 safe
            // https://github.com/facebook/create-react-app/pull/4234
            ecma: 8,
          },
          compress: {
            ecma: 5,
            warnings: false,
            // Disabled because of an issue with Uglify breaking seemingly valid code:
            // https://github.com/facebook/create-react-app/issues/2376
            // Pending further investigation:
            // https://github.com/mishoo/UglifyJS2/issues/2011
            comparisons: false,
            // Disabled because of an issue with Terser breaking valid code:
            // https://github.com/facebook/create-react-app/issues/5250
            // Pending further investigation:
            // https://github.com/terser-js/terser/issues/120
            inline: 2,
          },
          mangle: {
            safari10: true,
          },
          // Added for profiling in devtools
          keep_classnames: isEnvProductionProfile,
          keep_fnames: isEnvProductionProfile,
          output: {
            ecma: 5,
            comments: false,
            // Turned on because emoji and regex is not minified properly using default
            // https://github.com/facebook/create-react-app/issues/2488
            ascii_only: true,
          },
        },
        // Use multi-process parallel running to improve the build speed
        // Default number of concurrent runs: os.cpus().length - 1
        // Disabled on WSL (Windows Subsystem for Linux) due to an issue with Terser
        // https://github.com/webpack-contrib/terser-webpack-plugin/issues/21
        parallel: !isWsl,
        // Enable file caching
        // cache: true,
        sourceMap: shouldUseSourceMap,
      }),
      // This is only used in production mode
      new OptimizeCSSAssetsPlugin({
        cssProcessorOptions: {
          parser: safePostCssParser,
          map: shouldUseSourceMap
            ? {
              // `inline: false` forces the sourcemap to be output into a
              // separate file
              inline: false,
              // `annotation: true` appends the sourceMappingURL to the end of
              // the css file, helping the browser find the sourcemap
              annotation: true,
            }
            : false,
        },
      }),
    ],
  },
};

module.exports = config;
