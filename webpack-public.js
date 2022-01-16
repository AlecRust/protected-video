// Build process for public non-block JS
const path = require('path')

module.exports = {
  mode: 'production',
  entry: './src/protected-video-public.js',
  output: {
    filename: 'protected-video-public.js',
    path: path.resolve(__dirname, 'public', 'js'),
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
    ],
  },
}
