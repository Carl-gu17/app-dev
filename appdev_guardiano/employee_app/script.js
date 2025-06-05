const base_url = "http://localhost/appdevmo/appdevlangsakalam/galla_appdev";
let selectedItemRecno = 0;


async function getEmployee() {
  let request_url = `${base_url}/getemployee/`;
  try {
    const response = await fetch(request_url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const json = await response.json();
    renderEmployeeTable(json);
  } catch (error) {
    console.error(error.message);
  }
}




function renderEmployeeTable(data) {
  let table = document.getElementById("employee-table");
  table.innerHTML = "";
  data.forEach((item, index) => {
    let row = document.createElement("tr");
    let numberData = document.createElement("td");
    numberData.innerText = index + 1;
    let employeeIdData = document.createElement("td");
    employeeIdData.innerText = item.employeeid;
    let fullnameData = document.createElement("td");
    fullnameData.innerText = item.fullname;

    let deleteButton = document.createElement('button')
    deleteButton.innerText = "Delete"

    deleteButton.addEventListener('click', ()=>{
      deleteEmployee(item)
    })

    row.appendChild(numberData);
    row.appendChild(idData);
    row.appendChild(fullnameData);
    row.appendChild(deleteButton)

    row.addEventListener('click', function onClick(){ 
      const form = document.getElementById('editemployee')
      form.employeeid.value = item.employeeid,
      form.fullname.value = item.fullname
      selectedItemRecno = item.recno
    })

    table.appendChild(row);
  });
}

async function addEmployee(event) {
  event.preventDefault();
  let body = {
    employeeid: event.target.employeeid.value,
    fullname: event.target.fullname.value,
  };

  let request_url = `${base_url}/addemployee/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getEmployee();

  } catch (error) {
    console.error(error.message);
  }
}

async function editEmployee(event) {
  event.preventDefault();
  let body = {
    employeeid: event.target.employeeid.value,
    fullname: event.target.fullname.value,
    recno: selectedItemRecno
  };

  let request_url = `${base_url}/editemployee/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getEmployee();

  } catch (error) {
    console.error(error.message);
  }
}

async function deleteEmployee(item) {
  
  let body = {
    recno: item.recno
  };

  let request_url = `${base_url}/deleteemployee/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getEmployee();

  } catch (error) {
    console.error(error.message);
  }
}