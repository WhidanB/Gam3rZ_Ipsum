//Menu burger

const burger = document.querySelector(".burger");
const context = document.querySelector(".context");

console.log(burger);
console.log(context);

burger.addEventListener("click", () => {
  context.classList.toggle("active");
});
