import plugins from 'gulp-load-plugins';
import yargs from 'yargs';
import gulp from 'gulp';
import rimraf from 'rimraf';
import yaml from 'js-yaml';
import fs from 'fs';
import named from 'vinyl-named';
import webpackStream from 'webpack-stream';
import webpack2 from 'webpack';
import autoprefixer from 'autoprefixer';
import mozjpeg from 'imagemin-mozjpeg';
import webp from 'imagemin-webp';
import replace from 'gulp-ext-replace';
import { svgo } from 'gulp-imagemin';

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const {
    PATHS
} = loadConfig();
const sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed',
    includePaths: PATHS.sass
  
  };
function loadConfig() {
    let ymlFile = fs.readFileSync('config.yml', 'utf8');
    return yaml.load(ymlFile);
}
// Build the "dist" folder by running all of the below tasks
// Sass must be run later so UnCSS can search for used classes in the others assets.
gulp.task('build',
    gulp.series(clean, gulp.parallel(javascript, images), sass));
gulp.task('default',
    gulp.series('build', watch));
// Delete the "dist" folder
// This happens every time a build starts
function clean(done) {
    console.log(PATHS.dist);
    rimraf(PATHS.dist[0], done);
    rimraf(PATHS.dist[1], done);
    rimraf(PATHS.dist[2], done);
}
// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {

    const postCssPlugins = [
        // Autoprefixer
        autoprefixer(),

        // UnCSS - Uncomment to remove unused styles in production
        // PRODUCTION && uncss.postcssPlugin(UNCSS_OPTIONS),
    ].filter(Boolean);

    return gulp.src('src/scss/udlvb.scss')
        .pipe($.sourcemaps.init())
        .pipe($.sass(
            sassOptions
            )
            .on('error', $.sass.logError))
        .pipe($.postcss(postCssPlugins))
        .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
        .pipe(gulp.dest(PATHS.dist[0]))
}

let webpackConfig = {
    mode: (PRODUCTION ? 'production' : 'development'),
    module: {
        rules: [{
            test: /\.js$/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ["@babel/preset-env"],
                    compact: true
                }
            }
        }]
    },
    devtool: !PRODUCTION && 'source-map'
}

// Combine JavaScript into one file
// In production, the file is minified
function javascript() {
    return gulp.src(PATHS.entries)
        .pipe(named())
        .pipe($.sourcemaps.init())
        .pipe(webpackStream(webpackConfig, webpack2))
        .pipe($.if(PRODUCTION, $.terser()
            .on('error', e => {
                console.log(e);
            })
        ))
        .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
        .pipe(gulp.dest(PATHS.dist[1]));
}

// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
    return gulp.src('src/img/**/*')
        .pipe($.imagemin([
            mozjpeg({quality: 75, progressive: true}),
            svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
         ]
        ))
        .pipe(gulp.dest(PATHS.dist[2]))
        .pipe($.imagemin({
            plugins:webp({quality: 70})
        }
        ))
        .pipe(replace(".webp"))
        .pipe(gulp.dest(PATHS.dist[2]))
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
    gulp.watch('src/scss/**/*.scss',gulp.series(sass));
    gulp.watch('src/js/**/*.js',gulp.series(javascript));
    gulp.watch('src/img/**/*', gulp.series(images));

}