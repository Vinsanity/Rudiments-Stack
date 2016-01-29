import gulp from 'gulp'
const args = global.__args

gulp.task('default', ['build'])

const buildTasks = ['scripts', 'styles', 'images', 'static']

if (args.production) {
  buildTasks.push('styles:inline')
}

gulp.task('build', buildTasks)