const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');


module.exports = {
    entry: './assets/js/main.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'assets'),
    },

    plugins: [new MiniCssExtractPlugin()],
    module: {
        rules: [{
            test: /\.scss$/i,
            use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
        }, ],
    },
};