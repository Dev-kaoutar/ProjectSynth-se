function afficherMessage(message, type = "success") {
  const msgDiv = document.getElementById("message");
  msgDiv.style.display = "block";
  msgDiv.textContent = message;
  msgDiv.style.color = type === "success" ? "green" : "red";
  msgDiv.style.fontWeight = "bold";
  msgDiv.style.backgroundColor = type === "success" ? "#d4edda" : "#f8d7da";
  msgDiv.style.border =
    "1px solid" + type === "success" ? "#c3e6cb" : "#f5c6cb";
  msgDiv.style.padding = "10px";
  msgDiv.style.borderRadius = "5px";

  setTimeout(() => {
    msgDiv.style.display = "none";
    msgDiv.textContent = "";
  }, 4000);
}
