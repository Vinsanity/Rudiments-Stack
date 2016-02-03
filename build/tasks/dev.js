import gulp from 'gulp'
import path from 'path'
import { compiler, handleWebpackResults } from '../webpack/compiler'

const args = global.__args
const themeDir = path.resolve(__pkg._themepath)

gulp.task('dev', ['styles'], ()=> {
  compiler.watch({}, handleWebpackResults(true))
  gulp.watch(`${themeDir}/scss/**/*.scss`, ['styles'])
  gulp.watch(`${__pkg._themepath}/images/**/*`, ['images'])
  gulp.watch(`${themeDir}/fonts/**/*`, ['static'])
})
