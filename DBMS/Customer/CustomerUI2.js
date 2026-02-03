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
        <img src="${product.ItemImage}" alt ="No Image Available">
        <h2>${product.ItemName}</h2>
        <p class="price">Price : LKR ${
          product.ItemPrice - product.ItemDiscount
        }</p>
       ${
         product.ItemDiscount > 0
           ? `<p>(Discount : LKR ${product.ItemDiscount})</p><br>`
           : ""
       }
      
        <p class="quantity">Quantity : ${stock}</p>
        <p>${Number(stock) > 0 ? "✅ In Stock" : "❌ Out of Stock"}</p>
        <button ${stock > 0 ? "" : "disabled"}
        onclick ="buyProduct(${product.ItemID})">

          ${stock > 0 ? "Buy Now" : "Out of Stock"}
        </button>
      </div>
    `;
  });
}

function buyProduct(id) {
  const product = products.find((p) => Number(p.ItemID) === Number(id));

  if (!product) {
    alert("Product Not Available !");
    return;
  }

  let stock = Number(product.ItemStockQuantity);

  if (stock <= 0) {
    alert("Out of stock!");
    return;
  }

  fetch("Order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `item_id=${id}`,
  })
    .then((res) => res.text())
    .then((order_id) => {
      console.log("Order ID: ", order_id);

      product.ItemStockQuantity = stock - 1;
      displayProducts(products);

      window.location.href = "http://localhost/DBMS/Delivery/deliveryindex.php";
    })
    .catch((err) => {
      alert("Order failed");
      console.error(err);
    });
}
function searchProducts() {
  const value = document.getElementById("searchInput").value.toLowerCase();
  const filtered = products.filter((p) =>
    p.ItemName.toLowerCase().includes(value)
  );
  displayProducts(filtered);
}
