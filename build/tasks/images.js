import path from 'path';
import gulp from 'gulp';
import imagemin from 'gulp-imagemin';
import pngquant from 'imagemin-pngquant';

const themeDir = path.resolve(__pkg._themepath);

gulp.task('images', ()=> {
    const opts = {
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        use: [pngquant()]
    };

  return gulp.src([
    `${themeDir}/assets/src/img/**/*.{png,jpg,jpeg,gif,svg}`
  ])
  .pipe(imagemin(opts))
  .pipe(gulp.dest(`${themeDir}/assets/dist/img`))
});
