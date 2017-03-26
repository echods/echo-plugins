let webpack = require('webpack');
let path = require('path');
let glob = require('glob');
let PurifyCSSPlugin = require('purifycss-webpack');
let ExtractTextPlugin = require('extract-text-webpack-plugin');
let CleanWebpackPlugin = require('clean-webpack-plugin');
var inProduction = (process.env.NODE_ENV === 'production');


module.exports = {
    entry: {
        app: [
            './resources/assets/js/main.js',
            './resources/assets/sass/app.scss',
        ]
    },
    output: {
        path: path.resolve(__dirname, './assets'),
        filename: 'js/[name].[chunkhash].js'
    },
    devtool: 'source-map',
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ["es2015", "es2016", "es2017"]
                }
            }
        }, {
            test: /\.s[ac]ss$/,
            use: ExtractTextPlugin.extract({
                use: [{
                    loader: 'css-loader',
                    options: {
                        sourceMap: true
                    }
                }, {
                    loader: 'sass-loader',
                    options: {
                        sourceMap: true
                    }
                }]
            })
        }, {
            test: /\.(png|je?pg|gif)$/,
            loaders: [{
                    loader: 'file-loader',
                    options: {
                        name: 'img/[name].[ext]'
                    }
                },
                'img-loader'
            ]
        }, {
            test: /\.(eot|ttf|woff|woff2|svg)$/,
            loader: 'file-loader',
            options: {
                name: 'fonts/[name].[ext]'
            }
        }]
    },

    plugins: [
        new ExtractTextPlugin('css/[name].[chunkhash].css'),

        new webpack.LoaderOptionsPlugin({
            minimize: inProduction
        }),

        new PurifyCSSPlugin({
            // Give paths to parse for rules. These should be absolute!
            paths: glob.sync(path.join(__dirname, '**/*.php')),
            // minimize: inProduction
        }),

        new CleanWebpackPlugin(['assets/js', 'assets/css'], {
            root: __dirname,
            verbose: true,
            dry: false
        }),

        function() {
            this.plugin('done', stats => {
                require('fs').writeFileSync(
                    path.join(__dirname, 'assets/manifest.json'),
            JSON.stringify(stats.toJson().assetsByChunkName)
                )
            })
        }
    ]

}

/* Run for production only */
if (inProduction) {
    module.exports.plugins.push(
        new webpack.optimize.UglifyJsPlugin()
    );
}