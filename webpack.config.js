const path = require('path');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const glob = require('glob');
// const CopyPlugin = require("copy-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin');
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
// const sass = require('node-sass');

// Hard code this to production but can be adapted to accept args to change env.
const mode = 'development';

// const copyPlugin = new CopyPlugin({
//   patterns: [
//     { from: "./node_modules/bootstrap/**/*", to: "../src/vendor/" },
//   ],
// });

module.exports = {
  mode,
  watch: true,
  output: {
    // Webpack will create js files even though they are not used
    // filename: '[name].bundle.js',
    // chunkFilename: '[name].[chunkhash].chunk.js',
    // Where the CSS is saved to
    path: path.resolve(__dirname, 'build'),
    publicPath: "/build"
  },

  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        extractComments: false,
      }),
    ],
    splitChunks: {
      chunks: 'all',
    },
  },

  entry: {
    // Will create "styles.css" in "build" dir.
    "styles": './src/scss/main.scss',
    // Will create "main.js" in "build" dir.
    "main": glob.sync('./src/js/**/*.js'),
    // "bootstrap": glob.sync('./src/vendor/bootstrap/dist/js/**/*.js'),

  },

  module: {
    rules: [
      {
        test: /\.scss$/,
        exclude: /(node_modules|bower_components)/,
        use: [
          // Extract and save the final CSS.
          MiniCssExtractPlugin.loader,
          // Load the CSS, set url = false to prevent following urls to fonts and images.
          { loader: 'babel-loader', options: { presets: ['@babel/preset-env'] } },
          { loader: "css-loader", options: { url: false, importLoaders: 1 } },
          // Add browser prefixes and minify CSS.
          { loader: 'postcss-loader', /* options: { plugins: [autoprefixer(), cssnano()] } */ },
          // Load the SCSS/SASS
          { loader: 'sass-loader' },
        ],
      },
    ],
  },

  plugins: [
    // Define the filename pattern for CSS.
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
    // new BrowserSyncPlugin({
    //   host: 'localhost',
    //   port: 3000,
    //   server: { baseDir: ['build'] },
    //   files: ['build/**/*'],
    //   injectChanges: true,
    //   notify: false,
    // }),
    // copyPlugin,
  ]
}