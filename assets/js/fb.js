'use strict';

let WebFB = (function () {
    // Your web app's Firebase configuration
    let firebaseConfig = {
        apiKey: "AIzaSyBy1rh8zZNp1lnUBLyQ15a-cgNvZzsNFBU",
        authDomain: "aumet-com.firebaseapp.com",
        databaseURL: "https://aumet-com.firebaseio.com",
        projectId: "aumet-com",
        storageBucket: "aumet-com.appspot.com",
        messagingSenderId: "380649916442",
        appId: "1:380649916442:web:8ff3bfa9cd74f7c69969a3",
        measurementId: "G-YJ2BRPK2JD"
    };

    let _init = function () {
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
    }

    return {
        init: function () {
            _init();
        },

        logPageView: function (_pageUrl) {
            firebase.analytics().setCurrentScreen(_pageUrl);
            firebase.analytics().logEvent('page_view')
        }
    }
})();