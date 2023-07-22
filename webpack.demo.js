/**
 * Build process for player demo
 * NOTE: Don't rename this to webpack.config.js or it will override wp-scripts
 */
const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const CopyPlugin = require('copy-webpack-plugin')

module.exports = {
  mode: 'production',
  entry: ['./src/view.js', './src/demo/style.scss'],
  output: {
    path: path.resolve(__dirname, 'demo'),
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
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: { importLoaders: 1 } },
          {
            loader: 'sass-loader',
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
    new MiniCssExtractPlugin(),
    new CopyPlugin({
      patterns: [{ from: 'src/demo/favicon.svg', to: '.' }],
    }),
  ],
}
