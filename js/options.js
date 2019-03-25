
// Declared variables for images
let optionBox = document.getElementById("optionBox");
let enterBox = document.querySelector('h1');
let video = document.getElementById('video-background');

enterBox.addEventListener('click', optionBoxShow);
function optionBoxShow() {

  // Display option box popup
  optionBox.style.display = "flex";
  optionBox.classList.add('fadeIn');
  video.style.filter = "contrast(29%)";

  // hide the enter box
  enterBox.style.display = 'none';

  // Close image popup on image main image click and restore image thumbs
  optionBox.onclick = function() {
    optionBox.style.display = "none";
    enterBox.style.display = "block";
    enterBox.classList.add('fadeIn');
    enterBox.animate = "enterBox";
    video.style.filter = "contrast(100%)";
    video.style.filter = "blur(5px)";
  }
}