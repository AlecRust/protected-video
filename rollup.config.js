// Build process for public non-block JS
import { babel } from '@rollup/plugin-babel'
import { terser } from 'rollup-plugin-terser'

export default {
  input: 'src/protected-video-public.js',
  output: {
    file: 'public/js/protected-video-public.js',
    format: 'iife',
  },
  plugins: [
    babel({
      babelHelpers: 'bundled',
      presets: ['@babel/preset-env'],
    }),
    terser(),
  ],
}
