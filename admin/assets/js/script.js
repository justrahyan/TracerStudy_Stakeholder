const hamburger = document.getElementById("hamburger");
const sidebar = document.getElementById("sidebar");
const overlay = document.createElement("div");
const closeBtn = document.getElementById("close-btn");
overlay.className = "overlay";
document.body.appendChild(overlay);

hamburger.addEventListener("click", function () {
  sidebar.classList.toggle("open");
  overlay.classList.toggle("active");
});

closeBtn.addEventListener("click", function () {
  sidebar.classList.remove("open");
  overlay.classList.remove("active");
});

overlay.addEventListener("click", function () {
  sidebar.classList.remove("open");
  overlay.classList.remove("active");
});
