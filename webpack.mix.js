let mix = require('laravel-mix')

require('./mix')

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue()
  .nova('pixelcreation/nova-field-sortable')
