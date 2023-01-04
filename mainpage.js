// Find the right method, call on correct element
function launchFullScreen(element) {
    if(element.requestFullScreen) {
      element.requestFullScreen();
    } else if(element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if(element.webkitRequestFullscreen) {
      element.webkitRequestFullScreen();
    } else if(element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
  }