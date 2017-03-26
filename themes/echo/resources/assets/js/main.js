import bootstrap from './bootstrap'; // Load plugins needed here

(function($) {

    'use strict';

    setTimeout(() => {
        console.log("ES6 FTW");
    }, 1000);

    class Test {
        constructor(properties) {
            this.properties = properties;
        }

        again() {
            return 'we are inside a classes';
        }
    }

    var test = new Test;
    console.log(test.again());

})(jQuery);