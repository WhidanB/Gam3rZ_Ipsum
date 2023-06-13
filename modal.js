const myModal = document.getElementById("exampleModal");

const btnSuppr = document.querySelectorAll(".delBtn");
const confirmDel = document.querySelector(".confirmDel");
let id;
console.log(btnSuppr);

btnSuppr.forEach((e) =>
  e.addEventListener("click", () => {
    id = e.getAttribute("data-id").valueOf();
    console.log(id);
    $("#exampleModal").modal("show");
  })
);

confirmDel.addEventListener("click", () => {
  window.location.replace("delete.php?id=" + id);
});
