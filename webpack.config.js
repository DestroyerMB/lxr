const webpack = require('webpack'); //to access built-in plugins
const path = require('path');

module.exports = {
  entry: {
    main: './src/index.js',
    details: './src/details.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].lxr.js'
  },
  module: {
    rules: [
      { test: /\.txt$/, use: 'raw-loader' }
    ]
  },
  /*externals: {
    jquery: 'jQuery'
  },*/
  plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            wmark: "./watermark.js"
            // gmap: "./gmap.js",
            // maps:"http://maps.google.com/maps/api/js?key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ"
        })
    ],
  watch: true
};
