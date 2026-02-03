let products = JSON.parse(localStorage.getItem("products")) || [];

function addProduct(event) {
  event.preventDefault();

  const name = document.getElementById("name").value;
  const price = document.getElementById("price").value;
  const image = document.getElementById("image").value;

  products.push({
    id: Date.now(),
    name: name,
    price: price,
    image: image,
    inStock: true
  });
  
  localStorage.setItem("products", JSON.stringify(products));
  alert("Product added successfully!");

  event.target.reset();
}
