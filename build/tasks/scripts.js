import gulp from 'gulp'
import { compiler, handleWebpackResults } from '../webpack/compiler'

gulp.task('scripts', ['modernizr'], (done)=> {
  compiler.run(handleWebpackResults(false, done))
})
