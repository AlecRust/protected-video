// Build process for public non-block JS
import { terser } from 'rollup-plugin-terser'

export default {
  input: 'src/protected-video-public.js',
  output: {
    file: 'public/js/protected-video-public.js',
    format: 'iife',
  },
  plugins: [terser()],
}
