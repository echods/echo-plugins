'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

setTimeout(function () {
  console.log("ES6 FTW");
}, 1000);

var Test = function () {
  function Test(properties) {
    _classCallCheck(this, Test);

    this.properties = properties;
  }

  _createClass(Test, [{
    key: 'again',
    value: function again() {
      return 'we are inside a class';
    }
  }]);

  return Test;
}();

var test = new Test();
console.log(test.again());