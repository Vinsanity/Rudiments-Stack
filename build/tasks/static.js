import gulp from 'gulp'
import path from 'path'

const themeDir = path.resolve(__pkg._themepath)

gulp.task('static', ()=> {
  return gulp.src(`${themeDir}/assets/src/fonts/**/*`)
    .pipe(gulp.dest(`${themeDir}/assets/dist/fonts`))
})