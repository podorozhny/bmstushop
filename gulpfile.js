/*
 TODO https://github.com/rodionme/gulp-scaffold-website/blob/master/gulpfile.js
 */

var gulp        = require('gulp'),
    config      = require('./config.json'),
    newer       = require('gulp-newer'),
    concat      = require('gulp-concat'),
    less        = require('gulp-less'),
    csso        = require('gulp-csso'),
    imagemin    = require('gulp-imagemin'),
    uglify      = require('gulp-uglify'),
    del         = require('del'),
    order       = require('gulp-order'),
    csscomb     = require('gulp-csscomb'),
    rename      = require('gulp-rename'),
    gutil       = require('gulp-util'),
    wrapper     = require('gulp-wrapper');

handleError = function(err) {
    gutil.log(err);
    gutil.beep();
};

gulp.task('clean', function() {
    del(['web/css/**', 'web/js/**', 'web/img/**', 'web/fonts/**'], function () {
        console.log('Files deleted');
    });
});

gulp.task('csscomb', function() {
    return gulp.src('./assets/styles/**/*.less')
        .pipe(csscomb())
        .pipe(gulp.dest('./assets/styles'));
});

gulp.task('styles-error', function() {
    return gulp.src(config.build.src.css.error)
        .pipe(less())
        .on('error', handleError)
        .pipe(csso())
        .pipe(wrapper({ header: '\n/* ${filename} */\n\n' }))
        .pipe(concat('error.css'))
        .pipe(gulp.dest(config.build.dest.css));
});

gulp.task('styles-frontend', function() {
    return gulp.src(config.build.src.css.frontend)
        .pipe(less())
        .on('error', handleError)
        .pipe(csso())
        .pipe(wrapper({ header: '\n/* ${filename} */\n\n' }))
        .pipe(concat('frontend.css'))
        .pipe(gulp.dest(config.build.dest.css));
});

gulp.task('styles-frontend-auth', function() {
    return gulp.src(config.build.src.css.frontend_auth)
        .pipe(less())
        .on('error', handleError)
        .pipe(csso())
        .pipe(wrapper({ header: '\n/* ${filename} */\n\n' }))
        .pipe(concat('frontend_auth.css'))
        .pipe(gulp.dest(config.build.dest.css));
});

gulp.task('styles', ['styles-error', 'styles-frontend', 'styles-frontend-auth']);

gulp.task('js-frontend', function() {
    return gulp.src(config.build.src.js.frontend)
        .pipe(uglify())
        .pipe(wrapper({ header: '\n// ${filename}\n\n' }))
        .pipe(concat('frontend.js'))
        .pipe(gulp.dest(config.build.dest.js));
});

gulp.task('js-shop-products', function() {
    return gulp.src(config.build.src.js.shop_products)
        .pipe(uglify())
        .pipe(wrapper({ header: '\n// ${filename}\n\n' }))
        .pipe(concat('shop_products.js'))
        .pipe(gulp.dest(config.build.dest.js));
});

gulp.task('js-shop-categories', function() {
    return gulp.src(config.build.src.js.shop_categories)
        .pipe(uglify())
        .pipe(wrapper({ header: '\n// ${filename}\n\n' }))
        .pipe(concat('shop_categories.js'))
        .pipe(gulp.dest(config.build.dest.js));
});

gulp.task('js', ['js-frontend', 'js-shop-products', 'js-shop-categories']);

gulp.task('images', function() {
    return gulp.src(config.build.src.img)
        .pipe(newer(config.build.dest.img))
        .pipe(gulp.dest(config.build.dest.img));
});

gulp.task('images-min', function() {
    return gulp.src(config.build.src.img)
        .pipe(imagemin())
        .pipe(gulp.dest(config.build.dest.img));
});

gulp.task('fonts', function() {
    return gulp.src(config.build.src.fonts)
        .pipe(newer(config.build.dest.fonts))
        .pipe(gulp.dest(config.build.dest.fonts));
});

gulp.task('fonts-min', function() {
    return gulp.src(config.build.src.fonts)
        .pipe(gulp.dest(config.build.dest.fonts));
});

gulp.task('build', ['images', 'fonts'], function () {
    gulp.start(['styles', 'js']);
});

gulp.task('production', ['images-min', 'fonts-min'], function() {
    gulp.start(['styles-min', 'js-min']);
});

gulp.task('default', ['build']);