const path = require('path');
module.exports =  {
  parser:  '@typescript-eslint/parser',  // Specifies the ESLint parser
  extends: ["preact", "airbnb-typescript"],
  env: {
    "browser": true,
    "node": true,
  },
  "parserOptions": {
    "ecmaVersion": 6,
    "project": "tsconfig.json"
  },
  rules:  {
    // "react/react-in-jsx-scope": 0, // Using preact here, so no
    "jsx-a11y/anchor-is-valid": 0, // Many styles are applied to 'a' atm
    "jsx-a11y/click-events-have-key-events": 0, // We don't support keyboard navigation yet
    "jsx-a11y/no-noninteractive-element-interactions": 0, // We have lot of legacy with clicks on LI
    "import/prefer-default-export": 0,
    "max-len": ["error", 160],
    "jsx-a11y/label-has-associated-control": [ 2, {
      "required": {
        "some": [ "nesting", "id" ]
      }
    }],
    "react/static-property-placement": [2, "static public field"],
  },
  settings:  {
    'import/resolver': {
      node: {
        paths: [path.resolve(__dirname, 'front')],
      },
    },
    'import/named': {
      node: {
        paths: [path.resolve(__dirname, 'front')],
      },
    },
    react:  {
      version:  'detect',  // Tells eslint-plugin-react to automatically detect the version of React to use
    },
  },
};
