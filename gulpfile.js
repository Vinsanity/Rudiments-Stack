global.__pkg = require('./package.json')
var path = require('path')
var gulp = require('gulp')
require('babel-register')({ presets: ['es2015', 'react', 'stage-0'] })
require('babel-polyfill')

global.__args = require('yargs')
  .choices('env', Object.keys(__pkg._envUrls))
  .default('env', 'development')
  .boolean('production')
  .boolean('debug')
  .alias('D', 'debug')
  .alias('p', 'production')
  .argv

if (global.__args.production) {
  global.__args.env = 'production'
}

global.__args.env = global.__args.env.toLowerCase()

require('require-all')(path.resolve('build', 'tasks'))