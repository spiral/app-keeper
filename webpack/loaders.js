const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = [
    {
        test: /\.js$/,
        enforce: 'pre',
        use: ['source-map-loader'],
        include: [
            path.resolve(__dirname, '../node_modules/universal-schema-engine'),
        ],
    },
    {
        test: /\.scss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader,
            },
            {
                loader: 'css-loader',
            },
            {
                loader: 'sass-loader',
            },
        ],
    },
    {
        test: /\.[jt]sx?$/,
        use: [
            {
                loader: 'ts-loader',
                options: {
                    transpileOnly: true,
                },
            },
        ],
        exclude: /node_modules\/(?!(logform)\/).*/,
    },
    {
        test: /\.(ico)(\?.*)?$/,
        loader: 'file-loader?name=images/[hash].[ext]',
    },
    {
        test: /\.(woff|woff2|otf|eot|ttf)(\?.*)?$/,
        loader: 'file-loader?name=fonts/[hash].[ext]',
    },
    {
        test: /\.svg(\?.*)?$/,
        loader: 'svg-url-loader?limit=1024&noquotes',
    },
    {
        test: /\.(jpe?g|png|gif)$/i,
        loader: 'url-loader?limit=10000&name=images/[hash].[ext]',
    },
    {
        test: /\.(html)(\?.*)?$/,
        loader: 'raw-loader',
    },
];
