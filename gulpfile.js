global.__pkg = require('./package.json')
var path = require('path')
var gulp = require('gulp')
require('babel-register')({ presets: ['es2015', 'react', 'stage-0'] })
require('babel-polyfill')

global.__args = require('yargs')
  .boolean('production')
  .boolean('debug')
  .alias('D', 'debug')
  .alias('p', 'production')
  .argv

require('require-all')(path.resolve('build', 'tasks'))