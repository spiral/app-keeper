import './keeper.scss';
import * as Sentry from '@sentry/browser';

if (process.env.SENTRY_FRONT_DSN) {
  Sentry.init({
    dsn: process.env.SENTRY_FRONT_DSN.trim(),
    environment: window.location.host,
  });
}
