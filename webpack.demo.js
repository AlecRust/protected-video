// Build process for player demo
const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const postcssPresetEnv = require('postcss-preset-env')
const CopyPlugin = require('copy-webpack-plugin')

module.exports = {
  mode: 'production',
  entry: ['./src/protected-video-public.js', './src/demo/style.css'],
  output: {
    path: path.resolve(__dirname, 'demo'),
    filename: 'protected-video-public.js',
  },
  devServer: {
    static: {
      directory: path.join(__dirname, 'demo'),
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
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: { importLoaders: 1 } },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [postcssPresetEnv({ stage: 0 })],
              },
            },
          },
        ],
      },
    ],
  },
  optimization: {
    minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: 'src/demo/index.html',
      meta: {
        description: 'Protected Video WordPress plugin demo page.',
        'og:image':
          'https://ps.w.org/protected-video/assets/banner-772x250.png',
        viewport: 'width=device-width, initial-scale=1',
      },
    }),
    new MiniCssExtractPlugin({
      filename: 'protected-video-public.css',
    }),
    new CopyPlugin({
      patterns: [{ from: 'src/demo/favicon.svg', to: '.' }],
    }),
  ],
}
