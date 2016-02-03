import { merge } from 'lodash'
import webpack from 'webpack'
import base from './base'
const args = global.__args

export default merge({}, base, {

  devtool: 'source-map'

})