const gulp = require('gulp');
const ts = require("gulp-typescript");
// const tsProject = ts.createProject("tsconfig.json");
const browserify = require("browserify");
const source = require("vinyl-source-stream");
const tsify = require("tsify");


function build(finish) {
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

// gulp.task('default', build);

exports.default = build;
exports.build   = build;