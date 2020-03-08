const { src, dest, series, parallel } = require('gulp'),
    del = require('del');

function css() {
    return src('./css/**/*')
        .pipe(dest('./public/css'))
        .on('error', console.error);
}

function files() {
    return src('./files/**/*')
        .pipe(dest('./public/files'))
        .on('error', console.error);
}

function fonts() {
    return src('./fonts/**/*')
        .pipe(dest('./public/fonts'))
        .on('error', console.error);
}

function images() {
    return src('./img/**/*')
        .pipe(dest('./public/img'))
        .on('error', console.error);
}

function js() {
    return src('./js/**/*')
        .pipe(dest('./public/js'))
        .on('error', console.error);
}

function views() {
    return src('./*.php')
        .pipe(dest('./public'))
        .on('error', console.error);
}

function config() {
    return src(['./.htaccess'])
        .pipe(dest('./public'))
        .on('error', console.error);
}

function es() {
    return src('./es/**/*')
        .pipe(dest('./public/es'))
        .on('error', console.error);
}

function eu() {
    return src('./eu/**/*')
        .pipe(dest('./public/eu'))
        .on('error', console.error);
}

function partials() {
    return src('./partials/**/*')
        .pipe(dest('./public/partials'))
        .on('error', console.error);
}

function clean() {
    return del(['public/**/*', '!public'], {dot: true});
}

exports.clean = clean;
exports.default =
    series(clean,
        parallel(css, es, eu, files, fonts, images, js, partials, views, config)
    );