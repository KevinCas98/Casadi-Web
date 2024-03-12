firebase.initializeApp(firebaseConfig);

import { initializeApp } from "firebase/app";

import { getAnalytics } from "firebase/analytics";

const firebaseConfig = {
  apiKey: "AIzaSyA0xILj5H3bRk5DuaDd9Lhv3EA_E-3MOYY",
  authDomain: "ionicfirebase-418b4.firebaseapp.com",
  databaseURL: "https://ionicfirebase-418b4-default-rtdb.firebaseio.com",
  projectId: "ionicfirebase-418b4",
  storageBucket: "ionicfirebase-418b4.appspot.com",
  messagingSenderId: "315373856999",
  appId: "1:315373856999:web:efa250cd574915b3ff5a42",
  measurementId: "G-53L298MRE0"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

function upload(idElement, img, input) {
    console.log(idElement)
    //get your select image
    var image=document.getElementById(idElement).files[0];
    var element_img = $('#'+img);
    var element_input = $('#'+input);
    //now get your image name
    var imageName=image.name;
    //firebase  storage reference
    //it is the path where your image will store
    var storageRef=firebase.storage().ref('images/'+imageName);
    //upload image to selected storage reference

    var uploadTask=storageRef.put(image);

    uploadTask.on('state_changed',function (snapshot) {
        //observe state change events such as progress , pause ,resume
        //get task progress by including the number of bytes uploaded and total
        //number of bytes
        var progress=(snapshot.bytesTransferred/snapshot.totalBytes)*100;
        console.log("upload is " + progress +" done");
    },function (error) {
        //handle error here
        console.log(error.message);
    },function () {
       //handle successful uploads on complete

        uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) {
            //get your upload image url here...
            console.log(downlaodURL);
            element_img.show();
            element_img.attr('src', downlaodURL);
            element_input.val(downlaodURL);
        });
    });
}