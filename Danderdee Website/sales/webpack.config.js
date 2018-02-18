const path = require('path');
const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

module.exports = (env) => {
    return {
        context: path.resolve(__dirname, 'src/'),
        entry: {
            main: './index.js',
            basket: './pages/basket/index.js',
            checkout: './pages/checkout/index.js',
            feedback: './pages/feedback/index.js'
        },
        output: {
            path: path.resolve(__dirname, 'dist'),
            publicPath: '/',
            filename: 'js/[name].js'
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['es2015']
                        }
                    }
                },
                {
                    test: /\.css$/,
                    exclude: /(node_modules)/,
                    use: [
                        { loader: "style-loader" },
                        { loader: "css-loader" }
                    ]
                },
                {
                    test: /\.(png|jpg|gif)$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                publicPath: 'dist/',
                                outputPath: 'images/'
                                // useRelativePath: true
                            }
                        }
                    ]
                },
                {
                    test: /\.html$/,
                    use: [{
                        loader: 'html-loader',
                        options: {
                            minimize: true
                        }
                    }]
                }
            ]
        },
        //////////Watch and WatchOptions/////////////////

        watch: false,

        watchOptions: {
            aggregateTimeout: 300,
            poll: 1000,
            ignored: /node_modules/
        },

        devtool: 'source-map',

        //////////DevTool/////////////////

        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.$': 'jquery'
            }),
            new CleanWebpackPlugin(['dist/images', 'dist/js']),
            // new webpack.optimize.CommonsChunkPlugin({
            //     name: "manifest",
            //     minChunks: Infinity
            // }),
            new webpack.optimize.CommonsChunkPlugin({
                name: "commons",
                filename: "js/commons.js",
                minChunks: 2
            })
        ]
    }
}