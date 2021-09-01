// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBwc8NSTx3jM8dLItdPj3se5UCjFIDUzdU",
    authDomain: "startupinow.firebaseapp.com",
    projectId: "startupinow",
    storageBucket: "startupinow.appspot.com",
    messagingSenderId: "780160674699",
    appId: "1:780160674699:web:456282866792841d649d8e",
    measurementId: "G-HB571HD822"
  };

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

    messaging
        .requestPermission()
        .then(function () { 
            console.log('notifiation permission granted.');
            return messaging.getToken();
         }).then(function (token) { 
             $('#device_token').val(token);
             console.log(token);
          }).
          catch(function (err) { 
              console.log('unable to get permission to notify.',err);
           });

messaging.onMessage((payload)=>{
    console.log(payload);
})
