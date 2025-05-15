function search() {
  let searchInput = document.querySelector(".search-bar");
  let filter = searchInput.value.toLowerCase();
  let rows = document.querySelectorAll("table tbody tr");

  rows.forEach((row) => {
    let text = row.textContent.toLowerCase();
    row.style.display = text.includes(filter) ? "" : "none";
  });
}
