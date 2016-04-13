import gulp from 'gulp';

const args = global.__args;
const buildTasks = ['scripts', 'styles', 'images', 'static'];

gulp.task('default', ['build']);

if (args.env === 'production') {
    buildTasks.push('styles:inline')
}

gulp.task('build', buildTasks);
