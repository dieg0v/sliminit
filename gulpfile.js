var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var notify = require('gulp-notify');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var clean = require('gulp-clean');

function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}

gulp.task('watch', function () {
    gulp.watch('public/static/css/**/*.css', ['css']);
    gulp.watch('public/static/js/**/*.js', ['js']);
});

gulp.task('css', function () {

    var dest_folder = 'public/static/build/css';

    var src = [];

    src.push('public/static/vendor/normalize.css/normalize.css');
    src.push('public/static/css/site.css');

    gulp.src(dest_folder + '/*', {read: false}).pipe(clean({force: true}));

    var minOpts = {processImport:false, keepSpecialComments:false};

    return gulp.src(src)
        .on('error', swallowError)
        .pipe(minifycss(minOpts))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(concat(''+(new Date().getTime())+'.css'))
        .pipe(gulp.dest(dest_folder))
        .pipe(notify({message:"Compress css"})
    );
});

gulp.task('js', function () {

    var dest_folder = 'public/static/build/js';

    gulp.src(dest_folder + '/*', {read: false}).pipe(clean({force: true}));

    var src = [];

    src.push('public/static/vendor/modernizr/modernizr.js');
    src.push('public/static/vendor/jquery/dist/jquery.min.js');
    src.push('public/static/js/site.js');

    return gulp.src(src)
        .on('error', swallowError)
        .pipe(concat(''+(new Date().getTime())+'.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest_folder))
        .pipe(notify({message:"Compress js"})
    );
});
