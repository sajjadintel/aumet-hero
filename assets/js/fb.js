'use strict';

let WebFB = (function () {
    // Your web app's Firebase configuration
    let firebaseConfig = {
        apiKey: "AIzaSyARFOzdDMTRqGqNoukAqloC_fd4kte9Vgc",
        authDomain: "aumet-internal-products.firebaseapp.com",
        projectId: "aumet-internal-products",
        storageBucket: "aumet-internal-products.appspot.com",
        messagingSenderId: "383302560800",
        appId: "1:383302560800:web:f8135d4dde873f01392045"
    };

    let _init = function () {
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    }

    return {
        init: function () {
            _init();
        },

        logPageView: function (_pageUrl) {

        }
    }
})();