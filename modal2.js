const myModal = document.getElementById("exampleModal");

const btnSuppr = document.querySelectorAll(".delBtn");
const confirmDel = document.querySelector(".confirmDel");
let id;

btnSuppr.forEach((e) =>
  e.addEventListener("click", () => {
    id = e.getAttribute("data-id").valueOf();
    $("#exampleModal").modal("show");
  })
);

confirmDel.addEventListener("click", () => {
  window.location.replace("userdel.php?id=" + id);
});
