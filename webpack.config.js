const Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('app', './assets/js/app.js')
  .enableSingleRuntimeChunk()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableSassLoader()
  .enableVueLoader()
  .enablePostCssLoader()
;

if (Encore.isProduction()) {
  Encore
    .enableVersioning()
    .cleanupOutputBeforeBuild()
  ;
}

module.exports = Encore.getWebpackConfig();
