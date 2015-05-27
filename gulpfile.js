var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var notify = require('gulp-notify');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var clean = require('gulp-clean');
var postcss = require('gulp-postcss');
var customProperties = require("postcss-custom-properties");
var atImport = require("postcss-import");
var calc = require("postcss-calc");
var customMedia = require('postcss-custom-media');

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

    src.push('public/static/css/main.css');

    gulp.src(dest_folder + '/*', {read: false}).pipe(clean({force: true}));

    var minOpts = {processImport:false, keepSpecialComments:false};
    
    var processors = [ 
        atImport(),
        require('cssnext'),
        require('postcss-mixins'),
        require('postcss-nested'),
        customProperties(),
        calc(),
        customMedia()
    ];

    return gulp.src(src)
        .pipe( postcss(processors) )
        .pipe(minifycss(minOpts))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1'))
        .pipe(concat(''+(new Date().getTime())+'.css'))
        .pipe(gulp.dest(dest_folder))
        .on('error', swallowError)
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
        .pipe(concat(''+(new Date().getTime())+'.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest_folder))
        .on('error', swallowError)
        .pipe(notify({message:"Compress js"})
    );
});
