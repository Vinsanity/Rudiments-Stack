import gulp from 'gulp'
import path from 'path'
import BrowserSync from 'browser-sync'
import { compiler, handleWebpackResults } from '../webpack/compiler'

const browserSync = BrowserSync.create()
const args = global.__args

gulp.task('dev', ['build'], ()=> {
  compiler.watch({}, handleWebpackResults(true))
  gulp.watch(`${__pkg._themepath}/scss/**/*.scss`, ['styles'])
  gulp.watch(`${__pkg._themepath}/images/**/*`, ['images'])
  gulp.watch(`${__pkg._themepath}/fonts/**/*`, ['static'])

  if (args.sync) {
    browserSync.init({
      proxy: __pkg._criticalUrl,
      files: [
        `${__pkg._themepath}/assets/js/*.js`,
        `${__pkg._themepath}/assets/css/*.css`,
        `${__pkg._themepath}/**/*.php`
      ]
    })
  }
})
