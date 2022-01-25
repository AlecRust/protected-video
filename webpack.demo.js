// Build process for player demo
const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const CnameWebpackPlugin = require('cname-webpack-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')

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
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.css$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: ['postcss-nested', 'postcss-preset-env'],
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
    new CnameWebpackPlugin({
      domain: 'protected-video.alecrust.com',
    }),
    new MiniCssExtractPlugin({
      filename: 'protected-video-public.css',
    }),
  ],
}