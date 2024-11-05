import gulp from 'gulp';
import sass from 'gulp-sass';
import sassCompiler from 'sass';  // Import the sass compiler
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';

// Set gulp-sass to use the installed Sass compiler
const sassCompile = sass(sassCompiler);

// Task to compile SCSS, autoprefix, and minify CSS
gulp.task('styles', function() {
    return gulp.src('src/scss/**/*.scss')  // Source SCSS files
        .pipe(sassCompile().on('error', sassCompile.logError))  // Compile SCSS to CSS
        .pipe(autoprefixer({  // Add vendor prefixes
            overrideBrowserslist: ['last 2 versions', '> 1%', 'ie 10'],
            cascade: false
        }))
        .pipe(cleanCSS())  // Minify CSS
        .pipe(rename({ suffix: '.min' }))  // Rename to include '.min'
        .pipe(gulp.dest('dist/css'));  // Output minified CSS
});

// Define a default task that runs the styles task
gulp.task('default', gulp.series('styles'));
