var webpack = require("webpack");

module.exports = {
    entry: {
        app: './frontend',
        vendor: './frontend/vendor'
    },
    output: {
        path:     './public',
        filename: 'app.bundle.js'
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin("vendor", "vendor.bundle.js")
    ],
    module: {
        loaders: [{
            test:   /\.js/,
            loader: 'babel-loader',
            include: __dirname + '/frontend',
            query: {
                presets: ['es2015']
            }
        }, {
            test:   /\.html/,
            loader: 'raw-loader',
            include: __dirname + '/frontend'
        }]
    },
    devServer: {
        contentBase: "./public",
        proxy: {
            '/api/*': {
                target: 'http://127.0.0.1:9000'
            }
        }
    }
};