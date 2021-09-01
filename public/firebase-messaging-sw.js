importScripts('https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.2/firebase-messaging.js');
/*Update this config*/
var config = {
    apiKey: "AIzaSyBwc8NSTx3jM8dLItdPj3se5UCjFIDUzdU",
    authDomain: "startupinow.firebaseapp.com",
    projectId: "startupinow",
    storageBucket: "startupinow.appspot.com",
    messagingSenderId: "780160674699",
    appId: "1:780160674699:web:456282866792841d649d8e",
    measurementId: "G-HB571HD822"
  };
  firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: 'http://localhost/gcm-push/img/icon.png',
    image: 'http://localhost/gcm-push/img/d.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
// [END background_handler]