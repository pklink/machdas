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
    resolve: {
        extensions: ['', '.js', '.vue']
    },
    module: {
        preLoaders: [{
            test: /\.(js|vue)$/,
            loader: "eslint-loader",
            include: __dirname + '/frontend'
        }],
        loaders: [{
            test:   /\.js/,
            loader: 'babel-loader',
            include: __dirname + '/frontend',
            query: {
                presets: ['es2015']
            }
        }, {
            test:   /\.vue/,
            loader: 'vue-loader',
            include: __dirname + '/frontend'
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
