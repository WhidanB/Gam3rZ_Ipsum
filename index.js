const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const screen = document.querySelectorAll(".screen");

let NTMsalechieng = window.innerWidth;

console.log(NTMsalechieng);

screen.forEach((event) =>
  event.addEventListener("click", () => {
    overlay.classList.toggle("active");
    modal.classList.toggle("active");
  })
);

overlay.addEventListener("click", () => {
  overlay.classList.toggle("active");
  modal.classList.toggle("active");
});

console.log(screen);

//SLIDER
function previous() {
  const widthSlider = document.querySelector(".slider").offsetWidth;
  const sliderContent = document.querySelector(".slider_content");
  sliderContent.scrollLeft -= widthSlider;
  const scrollLeft = sliderContent.scrollLeft;
  const itemsSlider = sliderContent.querySelectorAll(".slider_content_item");

  //Revenir au début du slider
  //   if (scrollLeft == widthSlider * (itemsSlider.length - 1)) {
  //     sliderContent.scrollLeft = 0;
  //   }
  if (scrollLeft == widthSlider) {
    document.querySelector(".slider_nav_prev").style.display = "none";
  } else {
    document.querySelector(".slider_nav_next").style.display = "block";
  }
}

function next() {
  const widthSlider = document.querySelector(".slider").offsetWidth;
  const sliderContent = document.querySelector(".slider_content");
  sliderContent.scrollLeft += widthSlider;
  const scrollLeft = sliderContent.scrollLeft;
  const itemsSlider = sliderContent.querySelectorAll(".slider_content_item");

  //Revenir au début du slider
  //   if (scrollLeft == widthSlider * (itemsSlider.length - 1)) {
  //     sliderContent.scrollLeft = 0;
  //   }
  if (scrollLeft == widthSlider * (itemsSlider.length - 2)) {
    document.querySelector(".slider_nav_next").style.display = "none";
  } else {
    document.querySelector(".slider_nav_prev").style.display = "block";
  }
}
