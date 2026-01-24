const btn = document.querySelector(".register-btn");

btn.addEventListener("click", function () {
  const inputs = document.querySelectorAll("input");
  let isEmpty = false;

  inputs.forEach((input) => {
    if (input.value === "") {
      isEmpty = true;
    }
  });

  if (isEmpty) {
    alert("Please fill all fields!");
  } else {
    alert("Registation succesful");
  }
  
});


