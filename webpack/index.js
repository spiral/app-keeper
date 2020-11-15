const constants = require('./constants');
// eslint-disable-next-line no-console
console.log(`ENVIRONMENT=${process.env.WEB_API_ENV ? process.env.WEB_API_ENV : 'N.A.'}`);
// eslint-disable-next-line no-console
console.log(`VERSION=${constants.VERSION}`);
// eslint-disable-next-line no-console
console.log(`BUILD_NO=${constants.BUILD_NO}`);

/* eslint-disable global-require */
if (process.env.NODE_ENV === 'production') {
  module.exports = require('./prod');
} else {
  module.exports = require('./dev');
}
