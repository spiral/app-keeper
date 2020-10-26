const packageJS = require('../package.json');

module.exports = {
  WATCH_MODE: (process.env.WATCH_MODE || 'watch'),
  BUILD_NO: Date.now(),
  VERSION: packageJS.version,
};
