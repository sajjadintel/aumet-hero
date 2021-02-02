'use strict';

let WebFB = (function () {
    // Your web app's Firebase configuration
    let firebaseConfig = {
        apiKey: "AIzaSyC5kStRUB63Jae9jGbvul93ZNi_jgTjs8Q",
        authDomain: "aumet-dev.firebaseapp.com",
        projectId: "aumet-dev",
        storageBucket: "aumet-dev.appspot.com",
        messagingSenderId: "773243474783",
        appId: "1:773243474783:web:22bc0baa02aca627495cea",
        measurementId: "G-B1GS9BKE18"
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