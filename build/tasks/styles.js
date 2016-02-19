import path         from 'path'
import gulp         from 'gulp'
import sass         from 'gulp-sass'
import sourcemaps   from 'gulp-sourcemaps'
import postcss      from 'gulp-postcss'
import gulpif       from 'gulp-if'
import critical     from 'critical'
import autoprefixer from 'autoprefixer'
import mqpacker     from 'css-mqpacker'
import flexibility  from 'postcss-flexibility'
import {includes}   from 'lodash'
import BrowserSync  from 'browser-sync'

const browserSync = BrowserSync.create()
const themeDir = path.resolve(__pkg._themepath)
const args = global.__args
const useSync = (includes(args._, 'dev') && args.sync)

gulp.task('styles', ()=> {

  const sassOpts = {
    sourcemap: true,
    outputStyle: args.env === 'production' ? 'compressed' : 'expanded'
  }

  const processors = [
    autoprefixer({ browsers: ['last 2 versions'] }),
    flexibility()
  ]

  return gulp.src([
    `${themeDir}/scss/master.scss`,
    `${themeDir}/scss/wp-admin/login.scss`,
  ])
  .pipe(sourcemaps.init())
    .pipe(sass(sassOpts).on('error', sass.logError))
    .pipe(postcss(processors))
  .pipe(sourcemaps.write('./'))
  .pipe(gulpif(useSync, browserSync.stream({match: '**/*.css'})))
  .pipe(gulp.dest(`${themeDir}/assets/css`))

})


gulp.task('styles:inline', ['styles'], (done)=> {
  const dimensions = [
    {
      width: 320,
      height: 480
    }, {
      width: 768,
      height: 1024
    }, {
      width: 1920,
      height: 1080
    }
  ]

  const src = __pkg._criticalUrl

  const criticalOpts = {
    src,
    dest: `${themeDir}/assets/css/inline.css`,
    // pathPrefix: '/content/themes/threefive-rudiments/assets/css',
    minify: false,
    dimensions
  }

  critical.generate(criticalOpts, (err, result)=> {
    if (err) { throw err; }
    done()
  })
})
