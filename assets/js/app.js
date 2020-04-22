function getUser() {
  fetch("/api/user").then(function (response) {
    if (response.ok) {
      response.json().then(function (json) {
        var name = json.title + " " + json.firstName + " " + json.lastName;
        var location =
          json.streetNumber +
          " " +
          json.streetName +
          ", " +
          json.city +
          ", " +
          json.state +
          ", " +
          json.country +
          ", " +
          json.postalCode;
        var thumb = json.pictureThumb;
        document.getElementById("user-name").innerHTML = name;
        document.getElementById("user-location").innerHTML = location;
        document.getElementById("user-thumb").src = thumb;
        setTimeout(getUser, 2000);
      });
    }
  });
}
getUser();

function triggerNotification() {
  fetch("/api/user").then(function (response) {
    if (response.ok) {
      response.json().then(function (json) {
        var name = json.title + " " + json.firstName + " " + json.lastName;
        var location =
          json.streetNumber +
          " " +
          json.streetName +
          ", " +
          json.city +
          ", " +
          json.state +
          ", " +
          json.country +
          ", " +
          json.postalCode;
        var thumb = json.pictureThumb;
        var notification = new Notification(name, {
          body: location,
          icon: thumb,
        });
        setTimeout(triggerNotification, 2000);
      });
    }
  });
}

Notification.requestPermission().then(function (result) {
  triggerNotification();
});
