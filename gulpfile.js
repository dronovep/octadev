const gulp = require('gulp');

// const ts = require("gulp-typescript");
// const tsProject = ts.createProject("tsconfig.json");
const browserify = require("browserify");
const source = require("vinyl-source-stream");
const tsify = require("tsify");

const sass = require('gulp-sass');
sass.compiler = require('node-sass');


function styles(finish) {
    // gulp.src('./styles/**/*.scss')
    gulp.src('./styles/styles.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/assets/styles'))
    ;
    finish();
}

function scripts(finish) {
    // tsProject.src().pipe(tsProject()).js.pipe(gulp.dest("public/assets/scripts"));
    browserify({
      basedir: ".",
      debug: true,
      entries: ["components/MainPage/script.ts"],
      cache: {},
      packageCache: {},
    })
      .plugin(tsify)
      .bundle()
      .pipe(source("script.js"))
      .pipe(gulp.dest("public/assets/scripts"));
    finish();
}

const build = gulp.parallel(styles, scripts);

exports.styles = styles;
exports.scripts = scripts;
exports.build   = build;
exports.default = build;
