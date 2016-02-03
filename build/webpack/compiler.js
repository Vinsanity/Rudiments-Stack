import webpack from 'webpack'
import prodConfig from './production'
import devConfig from './development'

const args = global.__args

export const config = args.env === 'production' ? prodConfig : devConfig

export const compiler = webpack(config)

export function handleWebpackResults(watching = false, done = ()=>{}) {
  return (err, result)=> {

    if (err) {
      console.log(err)
      return done();
    }

    if (result.hasErrors() || result.hasWarnings() || args.debug) {
      console.log(result.toString({ colors: true }))
    } 

    if (watching) {
      console.log('Scripts compiled successfully...')
    }
    
    return done()
  }
}