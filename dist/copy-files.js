const fse = require('fs-extra');

Promise.all([
    fse.copy('./node_modules/bootstrap', './src/vendor/bootstrap'),
    // fse.copy('./node_modules/example', './src/vendor/example'),
])
    .then(() => console.log('Dependencies copied successfully! You can now run "npm run build"'))
    .catch(err => console.error(err));