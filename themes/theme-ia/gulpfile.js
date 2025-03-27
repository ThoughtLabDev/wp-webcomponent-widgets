/**
 * Gulpfile para o tema Theme IA
 * 
 * Este arquivo configura tarefas do Gulp para compilar SASS, JavaScript,
 * otimizar imagens e atualizar o navegador automaticamente.
 */

// Importar dependências
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const terser = require('gulp-terser');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const imagemin = require('gulp-imagemin');
const browserSync = require('browser-sync').create();
const del = require('del');

// Configurações
const config = {
  proxyURL: 'localhost:8000', // Altere para a URL do seu ambiente local
  paths: {
    styles: {
      src: './src/sass/**/*.scss',
      dest: './assets/css'
    },
    scripts: {
      src: './src/js/**/*.js',
      dest: './assets/js'
    },
    images: {
      src: './src/images/**/*',
      dest: './assets/images'
    },
    php: {
      src: './**/*.php'
    }
  }
};

// Limpar diretórios de destino
function clean() {
  return del([
    './assets/css/**/*',
    './assets/js/**/*',
    './assets/images/**/*'
  ]);
}

// Compilar SASS para CSS
function styles() {
  return gulp.src(config.paths.styles.src)
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest(config.paths.styles.dest))
    .pipe(cleanCSS())
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.paths.styles.dest))
    .pipe(browserSync.stream());
}

// Compilar JavaScript
function scripts() {
  return gulp.src(config.paths.scripts.src)
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@babel/preset-env']
    }))
    .pipe(gulp.dest(config.paths.scripts.dest))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.paths.scripts.dest))
    .pipe(browserSync.stream());
}

// Otimizar imagens
function images() {
  return gulp.src(config.paths.images.src)
    .pipe(imagemin())
    .pipe(gulp.dest(config.paths.images.dest))
    .pipe(browserSync.stream());
}

// Iniciar servidor BrowserSync
function serve(done) {
  browserSync.init({
    proxy: config.proxyURL,
    open: true
  });
  done();
}

// Recarregar o navegador
function reload(done) {
  browserSync.reload();
  done();
}

// Observar alterações nos arquivos
function watch() {
  gulp.watch(config.paths.styles.src, styles);
  gulp.watch(config.paths.scripts.src, scripts);
  gulp.watch(config.paths.images.src, images);
  gulp.watch(config.paths.php.src, reload);
}

// Tarefas compostas
const build = gulp.series(clean, gulp.parallel(styles, scripts, images));
const dev = gulp.series(build, serve, watch);

// Exportar tarefas
exports.clean = clean;
exports.styles = styles;
exports.scripts = scripts;
exports.images = images;
exports.build = build;
exports.watch = gulp.series(build, watch);
exports.default = dev; 