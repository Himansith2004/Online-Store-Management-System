const formArea = document.getElementById("formArea");
const tableBody = document.getElementById("tableBody");


// ---------- SHOW FORMS ----------

function addCustomer() {
    formArea.innerHTML = `
        <h3>Add Customer</h3>
        <input type="text" id="lid" placeholder="Login ID"><br><br>
        <input type="text" id="fname" placeholder="First Name"><br><br>
        <input type="text" id="lname" placeholder="Last Name"><br><br>
        <input type="text" id="phone" placeholder="Phone"><br><br>
        <input type="text" id="address" placeholder="Address"><br><br>
        <input type="email" id="email" placeholder="Email"><br><br>
        <input type="password" id="password" placeholder="Password"><br><br>
        <button onclick="submitCustomer()">Submit</button>
    `;
}

function addSupplier() {
    formArea.innerHTML = `
        <h3>Add Supplier</h3>
        <input type="text" id="slogin" placeholder="Login ID"><br><br>
        <input type="text" id="sname" placeholder="Supplier Name"><br><br>
        <input type="text" id="sphone" placeholder="Phone"><br><br>
        <input type="text" id="saddress" placeholder="Address"><br><br>
        <button onclick="submitSupplier()">Submit</button>
    `;
}

function addItem() {
    formArea.innerHTML = `
        <h3>Add Item</h3>
        <input type="text" id="supplierid" placeholder="Supplier ID"><br><br>
        <input type="text" id="iname" placeholder="Item Name"><br><br>
        <input type="text" id="price" placeholder="Price"><br><br>
        <input type="text" id="discount" placeholder="Discount"><br><br>
        <input type="text" id="stock" placeholder="Stock Quantity"><br><br>
        <button onclick="submitItem()">Submit</button>
    `;
}

// ---------- SUBMIT DATA ----------

function submitCustomer() {
    const data = {
        loginid: document.getElementById("lid").value,
        fname: document.getElementById("fname").value,
        lname: document.getElementById("lname").value,
        phone: document.getElementById("phone").value,
        address: document.getElementById("address").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    fetch("add_customer.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(msg => {
        if (msg === "OK") {
            alert("Customer added successfully");
            loadCustomers();
            formArea.innerHTML = "";
        } else {
            alert(msg);
        }
    });
}

function submitSupplier() {
    const data = {
        loginid: document.getElementById("slogin").value,
        name: document.getElementById("sname").value,
        phone: document.getElementById("sphone").value,
        address: document.getElementById("saddress").value
    };

    fetch("add_supplier.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(msg => alert(msg));
}

function submitItem() {
    const data = {
        supplierid: document.getElementById("supplierid").value,
        name: document.getElementById("iname").value,
        price: document.getElementById("price").value,
        discount: document.getElementById("discount").value,
        stock: document.getElementById("stock").value
    };

    fetch("add_item.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(msg => alert(msg));
}

// ---------- LOAD DATA (VISUALIZATION) ----------

function loadCustomers() {
    fetch("get_customers.php")
        .then(res => {
            if (!res.ok) throw new Error("HTTP " + res.status);
            return res.json();
        })
        .then(data => {
            document.getElementById("tableHeader").innerHTML = `
                <th>ID</th><th>Login</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Delete</th><th>Update</th>
            `;
            tableBody.innerHTML = "";
            data.forEach(c => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${c.CustomerID}</td>
                        <td>${c.LoginID}</td>
                        <td>${c.FirstName} ${c.LastName}</td>
                        <td>${c.Email}</td>
                        <td>${c.PhoneNumber}</td>
                        <td>${c.Address}</td>
                        <td><button onclick="deleteCustomer(${c.CustomerID})">Delete</button></td>
                        <td><button onclick="updateCustomerForm(${c.CustomerID})">Update</button></td>
                    </tr>
                `;
            });
        })
        .catch(err => alert("Fetch error: " + err.message));
}



function loadSuppliers() {

    fetch("get_suppliers.php")
        .then(res => res.json())
        .then(data => {

            document.getElementById("tableHeader").innerHTML = `
                <th>Supplier ID</th>
                <th>Login ID</th>
                <th>Supplier Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Delete</th>
                <th>Update</th>
            `;

            tableBody.innerHTML = "";

            data.forEach(c => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${c.SupplierID}</td>
                        <td>${c.LoginID}</td>
                        <td>${c.SupplierName}</td>
                        <td>${c.PhoneNumber}</td>
                        <td>${c.Address}</td>
                        <td><button onclick="deleteSupplier(${c.SupplierID})">Delete</button></td>
                        <td><button onclick="updateSupplierForm(${c.SupplierID})">Update</button></td>
                    </tr>
                `;
            });
        })
        .catch(err => alert("Error loading suppliers: " + err));
}

function loadItems() {

    fetch("get_items.php")
        .then(res => res.json())
        .then(data => {

            document.getElementById("tableHeader").innerHTML = `
                <th>Item ID</th>
                <th>Supplier ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Stock</th>
                <th>Delete</th>
                <th>Update</th>
            `;

            tableBody.innerHTML = "";

            data.forEach(i => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${i.ItemID}</td>
                        <td>${i.SupplierID}</td>
                        <td>${i.ItemName}</td>
                        <td>${i.Price}</td>
                        <td>${i.Discount}</td>
                        <td>${i.StockQuantity}</td>
                        <td><button onclick="deleteItem(${i.ItemID})">Delete</button></td>
                        <td><button onclick="updateItemForm(${i.ItemID})">Update</button></td>
                    </tr>
                `;
            });
        })
        .catch(err => alert("Error loading items: " + err));
}



window.onload = function () {
    loadCustomers();   // default view
};

