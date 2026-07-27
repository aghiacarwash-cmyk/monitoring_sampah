importScripts('https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyCYl3EDyuMJmnVtW8vO4GYL_0l0-Gcp6JQ",
    authDomain: "clean-iot-monitoring.firebaseapp.com",
    projectId: "clean-iot-monitoring",
    storageBucket: "clean-iot-monitoring.firebasestorage.app",
    messagingSenderId: "733183787328",
    appId: "1:733183787328:web:3b18917e105f22b5007aa5"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {

    console.log('Background Message:', payload);

    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: '/favicon.ico'
    });

});