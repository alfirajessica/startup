// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
  apiKey: "AIzaSyBwc8NSTx3jM8dLItdPj3se5UCjFIDUzdU",
  authDomain: "startupinow.firebaseapp.com",
  projectId: "startupinow",
  storageBucket: "startupinow.appspot.com",
  messagingSenderId: "780160674699",
  appId: "1:780160674699:web:456282866792841d649d8e",
  measurementId: "G-HB571HD822"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.onBackgroundMessage(function (payload) {
    //const getMsg = 1;
    //return 1;
    console.log("Message received.", payload);


    /*const title = payload.notification.title;
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    const fungsi = "ok";

    return self.registration.showNotification(
        title,
        options,
        fungsi,

    );*/
});