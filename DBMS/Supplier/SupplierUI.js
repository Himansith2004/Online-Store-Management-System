function toggleMenu() {
  document.getElementById("sidebar").classList.toggle("active");
}

const container = document.getElementById("products-container");

let products = [];

fetch("connect2.php")
  .then((res) => res.json())
  .then((data) => {
    products = data;
    displayProducts(products);
  })
  .catch((err) => console.error(err));

function displayProducts(list) {
  container.innerHTML = "";
  list.forEach((product) => {
    const stock = Number(product.ItemStockQuantity);
    container.innerHTML += `
      <div class="product">
        <img src="${product.ItemImage}" a ="No Image Available">
        <h2>${product.ItemName}</h2>
        <p class="price">Price : LKR ${product.ItemPrice}</p>
        <p class="quantity">Quantity : ${stock}</p>
      </div>
    `;
  });
}

function searchProducts() {
  const value = document.getElementById("searchInput").value.toLowerCase();
  const filtered = products.filter((p) =>
    p.ItemName.toLowerCase().includes(value)
  );
  displayProducts(filtered);
}
