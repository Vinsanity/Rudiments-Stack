import gulp from 'gulp'
import path from 'path'
import BrowserSync from 'browser-sync'
import { compiler, handleWebpackResults } from '../webpack/compiler'

const browserSync = BrowserSync.create()
const args = global.__args
const themeDir = path.resolve(__pkg._themepath)
const themeRelPath = themeDir.replace(process.cwd()+'/', '')

gulp.task('dev', ['build'], ()=> {
  compiler.watch({}, handleWebpackResults(true))
  gulp.watch(`${themeRelPath}/scss/**/*.scss`, ['styles'])
  gulp.watch(`${themeRelPath}/images/**/*`, ['images'])
  gulp.watch(`${themeRelPath}/fonts/**/*`, ['static'])

  if (args.sync) {
    browserSync.init({
      proxy: __pkg._criticalUrl,
      files: [
        `${themeRelPath}/assets/js/*.js`,
        `${themeRelPath}/assets/css/*.css`,
        `${themeRelPath}/**/*.php`
      ]
    })
  }
})
