import gulp from 'gulp';
import sass from 'gulp-sass';
import sassCompiler from 'sass';
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';

// Set gulp-sass to use the installed Sass compiler
const sassCompile = sass(sassCompiler);

// Task to compile, autoprefix, and minify main.scss
gulp.task('styles', function() {
    return gulp.src('assets/scss/main.scss')  // Source main.scss file
        .pipe(sassCompile().on('error', sassCompile.logError))  // Compile SCSS to CSS
        .pipe(autoprefixer({  // Add vendor prefixes
            overrideBrowserslist: ['last 2 versions', '> 1%', 'ie 10'],
            cascade: false
        }))
        .pipe(cleanCSS())  // Minify CSS
        .pipe(rename('style.css'))  // Rename output file to style.css
        .pipe(gulp.dest('dist/css'));  // Output to dist/css
});

// Task to watch for changes in main.scss
gulp.task('watch', function() {
    gulp.watch('assets/scss/main.scss', gulp.series('styles'));  // Watch main.scss for changes
});

// Define the default task to run the styles task and start watching
gulp.task('default', gulp.series('styles', 'watch'));
