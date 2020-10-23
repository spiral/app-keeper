const packageJS = require('../package.json');

module.exports = {
  BUILD_NO: Date.now(),
  VERSION: packageJS.version,
};
