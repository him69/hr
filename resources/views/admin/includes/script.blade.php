@include('admin.includes.footer')
        <script>
            $(document).ready(function() {
                bymonth()
            });

            function bymonth() {
                let month = $("#month").val();
                let type = document.getElementById('contentSwitcher').value;
                let atype = $('#contentSwitcher option:selected').text();
                let workType = document.getElementById('workFilters').value
                $.get('{{env('APP_URL')}}admin/sales?month=' + month + '&type=' + type + '&workType=' + workType)
                    .done(function(data) {
                        $("#sales").html(data);
                        $('#att_name').html(atype);
                    })
                    .fail(function(xhr, status, error) {
                        $("#sales").html("No data found");
                    });
            }

            function getMarkBackgroundColor(mark) {
                switch (mark) {
                    case 'P':
                        return 'green';
                    case 'NH':
                        return '#0067ff';
                    case 'HPL':
                    case 'H':
                        return '#7c7e7f';
                    case 'LI':
                        return '#009aff88';
                    case 'PL':
                        return '#08463f';
                    case 'UPL':
                        return '#EF4336';
                    case 'A':
                        return '#B33F40';
                    default:
                        return '#B33F40'; // Default case if none of the above matches
                }
            }

            function isCurrentDate(dateString) {
                const today = new Date();
                const date = new Date(dateString);

                return date.getDate() === today.getDate() &&
                    date.getMonth() === today.getMonth() &&
                    date.getFullYear() === today.getFullYear();
            }


            function userReport(date, userId, elemID) {
                fetch('{{env('APP_URL')}}admin/userReport/' + date + '/' + userId).then(Response => Response.json()).then(data => {
                    
                    
                    const userData = data.user[0]; 
                    const container = document.getElementById(elemID);
                    if (!container) {
                        console.error('Element not found:', elemID);
                        return;
                    }
                    if (!userData || !userData.login_time) {
                        // If userData is null or login_time is missing, display "No data available"
                        const content = `<div class="row gx-0 mx-0 p-3"><p class="text-black">No data available for <span class="fw-bold">${date}</span></p></div>`;
                        container.style.width = '110px';
                        container.innerHTML = content;
                    } else {
                        // Update the content of the container
                        const content = `
                            <div class="row gx-0 mx-0 p-3">
                                <p class="text-black">User <span class="fw-bold">"${userData.name}"</span> report of date <span class="fw-bold">${date}</span> </p>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Mark:</p><p class="text-white px-3" style="background:${
                                    isCurrentDate(date) && userData.mark ? getMarkBackgroundColor(userData.mark) :
                                    isCurrentDate(date) && userData.login_time ? '#009aff88' : 
                                    getMarkBackgroundColor(userData.mark ? userData.mark : 'A')
                                };">${
                                    isCurrentDate(date) && userData.mark ? userData.mark :
                                    isCurrentDate(date) && userData.login_time ? 'Li' : 
                                    (userData.mark ? userData.mark : 'Ab')
                                }</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Non Pause:</p> <p class="text-black px-3">${userData.nonpause ? userData.nonpause : "NA"}</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Login Time:</p> <p class="text-black px-3">${userData.login_time}</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Logout Time:</p> <p class="text-black px-3">${userData.logout_time ? userData.logout_time : "NA"}</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Sale Made:</p> <p class="text-white px-3" style="background:green;">${userData.sale_made ? userData.sale_made : "NA"}</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Customer:</p> <p class="text-black px-3">${userData.customer ? userData.customer : "NA"}</p></div>
                                <div class="col-6 px-0 px-2 my-2 d-flex justify-content-between align-items-center"><p class="mb-0 text-black smaTxt fw-bold">Leads:</p> <p class="bg-light text-black px-3">${userData.leads ? userData.leads : "NA"}</p></div>
                            </div>
                        `;
                        container.innerHTML = content;
                    }
                    // Set the innerHTML of the container to the new content


                    const allContainers = document.querySelectorAll('.report-container');
                    // Constructing the content
                    allContainers.forEach(container => {
                        if (container.id === elemID) {
                            container.style.display = 'block';
                        } else {
                            container.style.display = 'none';
                        }
                    });
                })
            }


            // Function to hide the div
            function hideDiv() {
                const elements = document.querySelectorAll('.report-container');
                elements.forEach(el => {
                    el.style.display = 'none';
                });
            }


            document.addEventListener('click', hideDiv);


            document.querySelectorAll('.report-container').forEach(el => {
                el.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
            // report of all user for per day
            // update arrow date
            function getAdjacentDates(currentDate) {
    const dateObj = new Date(currentDate);
    const prevDate = new Date(dateObj.getTime());
    prevDate.setDate(dateObj.getDate() - 1);
    const nextDate = new Date(dateObj.getTime());
    nextDate.setDate(dateObj.getDate() + 1);

    // Format dates back to 'YYYY-MM-DD'
    const prevDateStr = prevDate.toISOString().split('T')[0];
    const nextDateStr = nextDate.toISOString().split('T')[0];

    return { prevDate: prevDateStr, nextDate: nextDateStr };
}

function updateDOM(container, date, totalLogin, totalSales, totalCustomers, totalLeads, userData) {
    // Clear previous content
    container.innerHTML = '';

    // Calculate previous and next dates
    const { prevDate, nextDate } = getAdjacentDates(date);

    // Header with clickable arrows
    const headerDiv = document.createElement('div');
    headerDiv.className = 'd-flex justify-content-between';
    headerDiv.innerHTML = `
        <p class="fw-bold">Date: ${date}</p>
        <div class="d-flex">
            <div class="border rounded-circle d-flex align-items-center justify-content-center mx-3 arrow-left" style="width: 20px;height: 20px; cursor: pointer;"><i class="fa-solid fa-angle-left"></i></div>
            <div class="border rounded-circle d-flex align-items-center justify-content-center arrow-right" style="height: 20px;width: 20px; cursor: pointer;"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
    `;

    // Stats
    const statsDiv = document.createElement('div');
    statsDiv.className = 'd-flex my-3';
    statsDiv.innerHTML = `
        <div><p class="vsmatxt">Total login <span class="px-2 mx-1 bg-light">${totalLogin}</span></p></div>
        <div class="mx-2"><p class="vsmatxt">Total Sales <span class="px-2 mx-1 bg-success">${totalSales}</span></p></div>
        <div class="mx-2"><p class="vsmatxt">Total Cust. <span class="px-2 mx-1 bg-success">${totalCustomers}</span></p></div>
        <div class="mx-2"><p class="vsmatxt">Total Leads <span class="px-2 mx-1 bg-success">${totalLeads}</span></p></div>
    `;

    // Table
    const tableDiv = document.createElement('div');
    tableDiv.className = 'table-responsive fixed-cols';
    tableDiv.style.maxHeight = '80vh';
    tableDiv.style.overflowY = 'auto';
    const table = document.createElement('table');
    table.className = 'table table-bordered';
    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr>
            <th>Names</th>
            <th>Sale Made</th>
            <th>Customers</th>
            <th>Leads</th>
        </tr>
    `;
    const tbody = document.createElement('tbody');
    userData.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.name}</td>
            <th class="bg-white">${item.sale_made}</th>
            <th class="bg-white">${item.customer}</th>
            <th class="bg-white">${item.leads || 'N/A'}</th>
        `;
        tbody.appendChild(tr);
    });
    table.appendChild(thead);
    table.appendChild(tbody);
    tableDiv.appendChild(table);

    // Append everything to the container
    container.appendChild(headerDiv);
    container.appendChild(statsDiv);
    container.appendChild(tableDiv);

    // Add click event listeners to arrows
    headerDiv.querySelector('.arrow-left').addEventListener('click', () => perDayReport(prevDate));
    headerDiv.querySelector('.arrow-right').addEventListener('click', () => perDayReport(nextDate));
}

// fatch data of user per day
function perDayReport(date) {
    fetch('{{env('APP_URL')}}admin/per_day_report/' + date)
    .then(response => response.json())
    .then(data => {
        let container = document.getElementById('rp_container');

        // Initialize counters
        let totalLogin = 0;
        let totalSales = 0;
        let totalCustomers = 0;
        let totalLeads = 0;

        data.user.forEach(item => {
            if (item.mark === "P") {
                totalLogin += 1;
            }
            totalSales += item.sale_made || 0;
            totalCustomers += item.customer || 0;
            totalLeads += item.leads || 0;
        });

        // Call updateDOM to render the content
        updateDOM(container, date, totalLogin, totalSales, totalCustomers, totalLeads, data.user);
    })
    .catch(error => console.error('Fetch error:', error));
}


        </script>