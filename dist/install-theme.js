"use strict";

var _inquirer = _interopRequireDefault(require("inquirer"));
var _stringReplaceWebpackPlugin = _interopRequireDefault(require("string-replace-webpack-plugin"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
_inquirer.default.prompt([{
  type: 'input',
  name: 'BK_STARTER_THEME_PATH',
  message: 'Enter the value to replace BK_STARTER_THEME_PATH:'
}]).then(answers => {
  const webpackConfig = {
    // ...
    plugins: [new _stringReplaceWebpackPlugin.default({
      search: 'BK_STARTER_THEME_PATH',
      replace: answers.BK_STARTER_THEME_PATH
    })]
  };

  // Run Webpack with the updated configuration
  // ...
});
