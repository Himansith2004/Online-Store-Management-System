function toggleMenu() {
  document.getElementById("sidebar").classList.toggle("active");
}

let products = JSON.parse(localStorage.getItem("products")) || [];

const container = document.getElementById("products-container");

function displayProducts(list) {
  container.innerHTML = "";

  list.forEach(product => {
    container.innerHTML += `
      <div class="product">
        <img src="${product.image}">
        <h2>${product.name}</h2>
        <p class="price">$${product.price}</p>
        <p>${product.inStock ? "✅ In Stock" : "❌ Out of Stock"}</p>
        <button ${product.inStock ? "" : "disabled"}
          onclick="buyProduct(${product.id})">
          ${product.inStock ? "Buy Now" : "Out of Stock"}
        </button>
      </div>
    `;
  });
}

function buyProduct(id) {
  const product = products.find(p => p.id === id);
  if (product && product.inStock) {
    alert("Purchased: " + product.name);
    product.inStock = false;
    localStorage.setItem("products", JSON.stringify(products));
    displayProducts(products);
  }
}

function searchProducts() {
  const value = document.getElementById("searchInput").value.toLowerCase();
  const filtered = products.filter(p =>
    p.name.toLowerCase().includes(value)
  );
  displayProducts(filtered);
}

displayProducts(products);
