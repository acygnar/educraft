const { src, dest, watch, series, parallel } = require("gulp");
const browserSync = require("browser-sync").create();
const gulpSass = require("gulp-sass")(require("sass"));
const sourcemaps = require("gulp-sourcemaps");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cleanCSS = require("gulp-clean-css");
const esbuild = require("gulp-esbuild");
const dotenv = require("dotenv");

dotenv.config();

const paths = {
  scssEntry: "_src/scss/style.scss",
  scssWatch: "_src/scss/**/*.scss",
  jsEntry: "_src/js/main.js",
  jsWatch: "_src/js/**/*.js",
  img: "_src/img/**/*",
  php: "**/*.php",
  cssDest: "assets/css",
  jsDest: "assets/js",
  imgDest: "assets/img"
};

const isProduction = process.argv.includes("build");
const proxyUrl = process.env.WP_URL || "http://localhost/educraft";

function styles() {
  let stream = src(paths.scssEntry, { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(gulpSass().on("error", gulpSass.logError))
    .pipe(postcss([autoprefixer()]));

  if (isProduction) {
    stream = stream.pipe(cleanCSS({ level: 2 }));
  }

  return stream.pipe(sourcemaps.write(".")).pipe(dest(paths.cssDest)).pipe(browserSync.stream());
}

function scripts() {
  return src(paths.jsEntry, { allowEmpty: true })
    .pipe(
      esbuild({
        bundle: true,
        sourcemap: true,
        minify: isProduction,
        target: ["es2018"],
        outfile: "main.js"
      })
    )
    .pipe(dest(paths.jsDest))
    .pipe(browserSync.stream());
}

function images() {
  return src(paths.img, { allowEmpty: true }).pipe(dest(paths.imgDest));
}

function reload(done) {
  browserSync.reload();
  done();
}

function serve(done) {
  browserSync.init({
    proxy: proxyUrl,
    notify: false,
    open: false
  });

  watch(paths.scssWatch, styles);
  watch(paths.jsWatch, scripts);
  watch(paths.img, series(images, reload));
  watch(paths.php, reload);

  done();
}

const build = series(parallel(styles, scripts, images));
const dev = series(build, serve);

exports.styles = styles;
exports.scripts = scripts;
exports.images = images;
exports.build = build;
exports.default = dev;
