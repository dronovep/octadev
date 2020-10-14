const gulp = require('gulp');
const ts = require("gulp-typescript");
// const tsProject = ts.createProject("tsconfig.json");
const browserify = require("browserify");
const source = require("vinyl-source-stream");
const tsify = require("tsify");

const sass = require('gulp-sass');
sass.compiler = require('node-sass');


function styles(finish) {
    console.log("Building styles");
    gulp.src('./styles/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/assets/styles'))
    ;
    finish();
}

gulp.task('styles', styles);

function scripts(finish) {
    console.log("Building scripts");
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

gulp.task('scripts', scripts);

function a(finish) {
    console.log("Invoking 'a'");
    finish();
}

function b(finish) {
    console.log("Invoking 'b'");
    finish();
}


function build(finish) {
    console.log("Building project:");
    gulp.series(a, b);
    finish();
}

gulp.task('default', build);
gulp.task('build', build);

// exports.styles = styles;
// exports.scripts = scripts;
// exports.default = build;
// exports.build   = build;
