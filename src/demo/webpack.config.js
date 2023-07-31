const path = require('path')
const fs = require('fs')
const blockJson = JSON.parse(
  fs.readFileSync(path.resolve(__dirname, '..', 'block.json'), 'utf8')
)
const pluginVersion = blockJson.version
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const CopyPlugin = require('copy-webpack-plugin')

module.exports = {
  mode: 'production',
  entry: [
    path.resolve(__dirname, '..', 'view.js'),
    path.resolve(__dirname, 'style.scss'),
  ],
  output: {
    path: path.resolve(__dirname, '..', '..', 'demo'),
    filename: '[name].[contenthash].js',
  },
  devServer: {
    static: {
      directory: path.resolve(__dirname, 'demo'),
    },
    client: {
      overlay: false,
    },
    open: true,
    compress: true,
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@wordpress/babel-preset-default'],
          },
        },
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: { importLoaders: 1 } },
          'sass-loader',
        ],
      },
    ],
  },
  optimization: {
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: path.resolve(__dirname, 'index.ejs'),
      templateParameters: {
        version: pluginVersion,
      },
      meta: {
        'og:image':
          'https://ps.w.org/protected-video/assets/banner-772x250.png',
        viewport: 'width=device-width, initial-scale=1',
      },
    }),
    new MiniCssExtractPlugin({
      filename: '[name].[contenthash].css',
    }),
    new CopyPlugin({
      patterns: [
        {
          from: path.resolve(__dirname, 'images'),
          to: 'images',
        },
      ],
    }),
  ],
}
