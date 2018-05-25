'use strict';

let srcDir = './assets/src/';
let distDir = 'assets/dist/';

/**
 * configuration of points
 */
const points = {
    modules: [
        'bootstrap/main',
        'bootstrap/skeleton',
        'bootstrap/login',
        'bootstrap/admin',
        'tinymce/table'
    ],
    custom: []
};

/**
 * require plugins
 */
const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');

/**
 * production mode on or off
 */
const production = (process.env.NODE_ENV === 'production');


/**
 * plugins configuration
 */
const pluginsCommon = [
    new CleanWebpackPlugin(distDir),
    new webpack.DefinePlugin({
        PRODUCTION: JSON.stringify(production)
    }),
    new ExtractTextPlugin('[name].css'),
    new SpriteLoaderPlugin({plainSprite: true})
];
const pluginsDeveloping = [];
const pluginsProduction = [
    new OptimizeCssAssetsPlugin()
];

module.exports = {
    /**
     * source js files
     */
    entry: function () {
        let entry = {};
        for (let folder in points) {
            points[folder].map(function (item) {
                let src = srcDir + folder + '/' + item;
                let dist = distDir + item.replace('bootstrap/', '').replace('/', '-');
                entry[dist] = src;
            });
        }

        return entry;
    }(),

    /**
     * output points js files
     */
    output: {
        path: __dirname,
        filename: '[name].js'
    },


    optimization: {
        /*splitChunks: {
            cacheGroups: {
                commons: {
                    test: /[\\/]node_modules[\\/]/,
                    name: distDir + '/' + 'bundle',
                    chunks: "initial",
                    minSize: 1
                }
            }
        },*/
        minimize: function () {
            return production
        }()
    },


    /**
     *  js source map
     */
    devtool: function () {
        return (production) ? '' : 'source-map'
    }(),

    /**
     * files saving time
     */
    watchOptions: {
        aggregateTimeout: 100
    },

    /**
     *  includes plugins
     */
    plugins: function () {
        return (production) ? pluginsCommon.concat(pluginsProduction) : pluginsCommon.concat(pluginsDeveloping);
    }(),

    /**
     *  includes modules
     */
    module: {
        rules: [
            {
                test: /\.scss$/i,
                use: ExtractTextPlugin.extract({
                    publicPath: './',
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: "css-loader",
                            options: function () {
                                return (production) ? {} : {sourceMap: true}
                            }(),
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                plugins: () => [
                                    require('autoprefixer')({
                                        browsers: ['> 3%']
                                    })
                                ],
                                sourceMap: function () {
                                    return !production
                                }(),
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: function () {
                                return (production) ? {} : {sourceMap: true}
                            }(),
                        }
                    ]
                }),
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    publicPath: './',
                    fallback: 'style-loader',
                    use: ['css-loader']
                }),
            },
            {
                test: /(\.js$)/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            },
            {
                test: /\.svg$/,
                exclude: /(images|fonts)/,
                include: path.resolve(__dirname, srcDir + 'custom/sprite/'),
                loader: 'svg-sprite-loader',
                options: {
                    extract: true,
                    spriteFilename: './' + distDir + 'images/sprite.svg'
                }
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2)$/,
                exclude: /(images|sprite)/,
                use: {
                    loader: 'file-loader',
                    options: {
                        publicPath: '../../',
                        name: distDir + 'fonts/[name].[ext]'
                    }
                }
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                exclude: /(node_modules|fonts|sprite)/,
                loaders: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 500,
                            name(file) {
                                return distDir + 'images/' + file.split('\\images\\')[1];
                            }
                        }
                    },
                    'image-webpack-loader'
                ]
            }
        ]
    }
};