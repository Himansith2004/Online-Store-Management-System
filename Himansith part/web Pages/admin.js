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

    const formData = new FormData();
    formData.append("loginid", document.getElementById("lid").value);
    formData.append("fname", document.getElementById("fname").value);
    formData.append("lname", document.getElementById("lname").value);
    formData.append("phone", document.getElementById("phone").value);
    formData.append("address", document.getElementById("address").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("password", document.getElementById("password").value);

    fetch("add_customer.php", {
        method: "POST",
        body: formData
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

    const formData = new FormData();
    formData.append("loginid", document.getElementById("slogin").value);
    formData.append("name", document.getElementById("sname").value);
    formData.append("phone", document.getElementById("sphone").value);
    formData.append("address", document.getElementById("saddress").value);

    fetch("add_supplier.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        if (msg === "OK") {
            alert("Supplier added successfully");
            loadSuppliers();
            formArea.innerHTML = "";
        } else {
            alert(msg);
        }
    });
}


function submitItem() {

    const formData = new FormData();
    formData.append("supplierid", document.getElementById("supplierid").value);
    formData.append("name", document.getElementById("iname").value);
    formData.append("price", document.getElementById("price").value);
    formData.append("discount", document.getElementById("discount").value);
    formData.append("stock", document.getElementById("stock").value);

    fetch("add_item.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        if (msg === "OK") {
            alert("Item added successfully");
            loadItems();
            formArea.innerHTML = "";
        } else {
            alert(msg);
        }
    });
}


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
    loadCustomers();   
};

function updateCustomerForm(id) {
    fetch("get_customers.php")
    .then(res => res.json())
    .then(data => {
        const c = data.find(x => x.CustomerID == id);

        formArea.innerHTML = `
            <h3>Update Customer</h3>
            <input type="hidden" id="cid" value="${c.CustomerID}">
            <input type="text" id="lid" value="${c.LoginID}"><br><br>
            <input type="text" id="fname" value="${c.FirstName}"><br><br>
            <input type="text" id="lname" value="${c.LastName}"><br><br>
            <input type="text" id="phone" value="${c.PhoneNumber}"><br><br>
            <input type="text" id="address" value="${c.Address}"><br><br>
            <input type="email" id="email" value="${c.Email}"><br><br>
            <button onclick="saveCustomerUpdate()">Update</button>
        `;
    });
}

function saveCustomerUpdate() {
    const formData = new FormData();
    formData.append("id", document.getElementById("cid").value);
    formData.append("loginid", lid.value);
    formData.append("fname", fname.value);
    formData.append("lname", lname.value);
    formData.append("phone", phone.value);
    formData.append("address", address.value);
    formData.append("email", email.value);

    fetch("update_customer.php", { method: "POST", body: formData })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadCustomers();
        formArea.innerHTML = "";
    });
}

function updateSupplierForm(id) {
    fetch("get_suppliers.php")
    .then(res => res.json())
    .then(data => {
        const s = data.find(x => x.SupplierID == id);

        formArea.innerHTML = `
            <h3>Update Supplier</h3>
            <input type="hidden" id="sid" value="${s.SupplierID}">
            <input type="text" id="slogin" value="${s.LoginID}"><br><br>
            <input type="text" id="sname" value="${s.SupplierName}"><br><br>
            <input type="text" id="sphone" value="${s.PhoneNumber}"><br><br>
            <input type="text" id="saddress" value="${s.Address}"><br><br>
            <button onclick="saveSupplierUpdate()">Update</button>
        `;
    });
}

function saveSupplierUpdate() {
    const formData = new FormData();
    formData.append("id", sid.value);
    formData.append("loginid", slogin.value);
    formData.append("name", sname.value);
    formData.append("phone", sphone.value);
    formData.append("address", saddress.value);

    fetch("update_supplier.php", { method: "POST", body: formData })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadSuppliers();
        formArea.innerHTML = "";
    });
}

function updateItemForm(id) {
    fetch("get_items.php")
    .then(res => res.json())
    .then(data => {
        const i = data.find(x => x.ItemID == id);

        formArea.innerHTML = `
            <h3>Update Item</h3>
            <input type="hidden" id="iid" value="${i.ItemID}">
            <input type="text" id="supplierid" value="${i.SupplierID}"><br><br>
            <input type="text" id="iname" value="${i.ItemName}"><br><br>
            <input type="text" id="price" value="${i.Price}"><br><br>
            <input type="text" id="discount" value="${i.Discount}"><br><br>
            <input type="text" id="stock" value="${i.StockQuantity}"><br><br>
            <button onclick="saveItemUpdate()">Update</button>
        `;
    });
}

function saveItemUpdate() {
    const formData = new FormData();
    formData.append("id", iid.value);
    formData.append("supplierid", supplierid.value);
    formData.append("name", iname.value);
    formData.append("price", price.value);
    formData.append("discount", discount.value);
    formData.append("stock", stock.value);

    fetch("update_item.php", { method: "POST", body: formData })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadItems();
        formArea.innerHTML = "";
    });
}

function deleteCustomer(id) {
    if (!confirm("Are you sure you want to delete this customer?")) return;

    const formData = new FormData();
    formData.append("id", id);

    fetch("delete_customer.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadCustomers();
    });
}

function deleteSupplier(id) {
    if (!confirm("Are you sure you want to delete this supplier?")) return;

    const formData = new FormData();
    formData.append("id", id);

    fetch("delete_supplier.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadSuppliers();
    });
}

function deleteItem(id) {
    if (!confirm("Are you sure you want to delete this item?")) return;

    const formData = new FormData();
    formData.append("id", id);

    fetch("delete_item.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        loadItems();
    });
}
