@include('admin.includes.header')
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>
<style>
    .dropdown-check-list {
        display: inline-block;
    }

    .dropdown-check-list .anchor {
        position: relative;
        cursor: pointer;
        display: inline-block;
        padding: 5px 50px 5px 10px;
        /* border: 1px solid #ccc; */
    }

    .dropdown-check-list .anchor:after {
        position: absolute;
        content: "";
        border-left: 2px solid black;
        border-top: 2px solid black;
        padding: 5px;
        right: 10px;
        top: 20%;
        transform: rotate(-135deg);
    }

    .dropdown-check-list .items {
        display: none;
        padding: 2px;
        border: 1px solid #ccc;
        position: absolute;
        background-color: #FFF;
        z-index: 3;
        max-width: fit-content;
        min-width: 148px;

    }

    .dropdown-check-list .items li {
        list-style: none;
        padding: 5px 10px;
    }

    .dropdown-check-list .items li:hover {
        background-color: #F0F0F0;
    }

    .dropdown-check-list.visible .items {
        display: block;
        display: block;
        max-height: 142px;
        min-height: 42px;
        overflow: scroll;
    }

    .selected-items-pills .pill {
        display: inline-block;
        padding: 5px 10px;
        margin: 2px;
        background-color: #006396;
        color: white;
        border-radius: 4px;
        font-size: 14px;
    }

    /* .selected-items-pills .pill .remove-pill {
        margin-left: 5px;
        cursor: pointer;
    } */
</style>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('admin.includes.top_nav')
    <div class="ui-theme-settings">

        <div class="theme-settings__inner">
            <div class="scrollbar-container">

            </div>
        </div>
    </div>
    <div class="app-main">
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse table-responsive">
            <div class="app-main__inner container mt-4 overflow-hidden ">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post">@csrf
                            <div class=" baseShadow rounded bg-white mx-auto p-3 my-3">
                                <p class="SubHeding m-0 text-center">User Info</p>
                                <div class="row gy-2">
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Full Name<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="name" placeholder="Enter candidate name" @if(isset($us)) value="{{$us->name}} @endif" required class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Gender<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <select name="gender" class="border-0 w-100 bg-white p-1" required>
                                                <option value="">Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Email ID</label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-envelope inputicon"></i>
                                            <input type="email" name="email" placeholder="Enter candidate email" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Contact Number<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <span class="inputicon" style="font-size: 16px;">+91</span>
                                            <input type="number" required name="mobile" placeholder="Enter candidate mobile number" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label class="fontmed labelstyle" for="">Select Work Type </label>
                                        <div class="d-flex align-items-center mt-2 p-1">
                                            <div class="d-flex align-items-center "><input type="radio" name="work_type" id="work_type_remote" value="2">
                                                <label for="work_type_it" class="m-0">Remote</label>
                                            </div>
                                            <div class="mx-2 d-flex align-items-center"><input type="radio" name="work_type" value="1" id="work_type_inoff" checked>
                                                <label for="work_type_inoff" class="m-0">Inoffice</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label class="fontmed labelstyle" for="">Select Pf </label>
                                        <div class="d-flex align-items-center mt-2 p-1">
                                            <div class="d-flex align-items-center "><input type="radio" name="pf" id="pf_yes" value="1">
                                                <label for="pf_yes" class="m-0">Yes</label>
                                            </div>
                                            <div class="mx-2 d-flex align-items-center"><input type="radio" name="pf" value="0" id="pf_no" checked>
                                                <label for="pf_no" class="m-0">no</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6" id="pfns">
                                        <label class="fontmed labelstyle" for="">PF Number</label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-regular fa-money-bill-1 inputicon"></i>
                                            <input type="text" name="pf_no" placeholder="Enter Pf Number" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Joining Date<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <input type="date" required name="joining_date" placeholder="Enter candidate joining_date" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Salary<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-regular fa-money-bill-1 inputicon"></i>
                                            <input type="number" required name="salary" placeholder="Enter candidate salary" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Designation<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <input type="text" required name="designation" placeholder="Enter candidate designation" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">User Id<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="user_id" id="" required placeholder="Enter Candidate unique id" @if(isset($us)) value="{{$us->user_id}} @endif" class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Password<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-lock inputicon"></i>
                                            <input type="text" name="password" id="password" placeholder="Enter unique Password"  class="border-0 w-100 bg-white p-1 ">
                                        </div>
                                        <div id="passwordError" class="text-danger vsmatxt"></div>
                                    </div>
                                </div>
                            </div>
                            <div class=" baseShadow rounded bg-white mx-auto p-3 my-3">
                                <p class="SubHeding m-0 text-center">Lead info</p>
                                <div class="row gy-2">
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Department<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input name="d_name" list="dep_name" class="border-0 w-100 bg-white p-1" required onchange="updateUsersDropdown(this)" placeholder="select Department">
                                            <datalist id="dep_name">
                                                @foreach ($depatment as $dp)
                                                <option value="{{ $dp->d_name }}">
                                                @endforeach
                                                </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6" id="serv">
                                        <label class="fontmed labelstyle" for="">Choose server<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-tower-cell inputicon"></i>
                                            <input list="Server" name="server_ip" id="depar" placeholder="Choose server for candidate" class="border-0 w-100 bg-white p-1">
                                            <datalist id="Server">
                                                <option value="122.186.6.91">
                                                <option value="144.76.0.239">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Is he/she lead ?</label>
                                        <div class="d-flex align-items-center mt-2 p-1">
                                            <div class="d-flex align-items-center "><input type="radio" id="lead_y" name="lead" value="1">
                                                <label for="lead_to" class="m-0">Yes</label>
                                            </div>
                                            <div class="mx-2 d-flex align-items-center"><input type="radio" name="lead" value="0" id="lead_n" checked>
                                                <label for="lead_n" class="m-0">no</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="fontmed labelstyle">Lead By</label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <!-- user who lead will come here- -->
                                            <select name="leader_id" class="border-0 w-100 bg-white p-1">
                                                @foreach ($users as $us)
                                                @if ($us->lead == 1)
                                                <option value="{{ $us->id }}">{{ $us->user_id }}</option>
                                                @endif
                                                @endforeach
                                                <option value="" selected>none</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="whomToLeadSection">
                                        <label for="" class="fontmed labelstyle">Whom to lead?</label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <!-- users of particular department come here - -->
                                            <div id="list1" class="dropdown-check-list" tabindex="100">
                                                <span class="anchor">Select Items</span>
                                                <ul class="items">
                                                    <!-- by selecting department user come here  -->
                                                </ul>
                                            </div>
                                            <!-- Hidden input for collecting IDs -->
                                            <input type="hidden" id="selectedIds" name="userIds">
                                            <!-- Container for displaying selected items as pills -->
                                            <div id="selectedItemsPills" class="selected-items-pills"></div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-column  justify-content-center align-items-center my-3">
                                        <button class="p-2 col-3 baseBtnBg border-0 rounded mx-2 text-white">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@include('admin.includes.footer')
<script>
    function editRow(button) {
        var row = button.parentNode.parentNode;
        console.log(row);
        var cells = row.getElementsByTagName("td");

        for (var i = 1; i < cells.length - 1; i++) {
            var cell = cells[i];
            var value = cell.innerHTML;

            cell.innerHTML = '<input type="text" value="' + value + '">';
        }

        var editButtonCell = cells[cells.length - 1];
        editButtonCell.innerHTML = '<i class="bi bi-check-lg para text-success" onclick="saveRow(this)"></i>';
    }

    function saveRow(button) {
        var row = button.parentNode.parentNode;
        var cells = row.getElementsByTagName("td");
        for (var i = 1; i < cells.length - 1; i++) {
            var cell = cells[i];
            var input = cell.getElementsByTagName("input")[0];
            var value = input.value;
            cell.innerHTML = value;
        }
        var editButtonCell = cells[cells.length - 1];
        editButtonCell.innerHTML = '<i class="bi bi-pencil-square para baseColor" id="edit" onclick="editRow(this)"></i>';
    }

    function ut(e) {
        
    }
    // pf number show hide

    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle the display of the PF number section
        function PFs() {
            const pfYes = document.getElementById('pf_yes');
            const pfns = document.getElementById('pfns');
            const pfInput = document.querySelector('[name="pf_no"]');

            if (pfYes.checked) {
                pfns.style.display = 'block';
            } else {
                pfInput.value = '';
                pfns.style.display = 'none';
            }
        }

        const pfYes = document.getElementById('pf_yes');
        const pfNo = document.getElementById('pf_no');
        if (pfYes && pfNo) { // Check if elements exist before adding event listeners
            pfYes.addEventListener('change', PFs);
            pfNo.addEventListener('change', PFs);
        }
        // Call the function on page load in case the form is pre-filled or to set the initial state
        PFs();

        function leadTo() {
            const leYes = document.getElementById('lead_y');
            const whomToLeadSection = document.getElementById('whomToLeadSection');
            const userids =document.getElementById('selectedIds')
            if (leYes.checked) {
                whomToLeadSection.style.display = 'block';
            } else {
                userids.value = '';
                whomToLeadSection.style.display = 'none';
            }
        }

        const leYes = document.getElementById('lead_y');
        const leNo = document.getElementById('lead_n')
        if (leYes && leNo) {
            leYes.addEventListener('change', leadTo);
            leNo.addEventListener('change', leadTo);
        }
        leadTo();

    });

    var checkList = document.getElementById('list1');
    checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
        if (checkList.classList.contains('visible'))
            checkList.classList.remove('visible');
        else
            checkList.classList.add('visible');
    };

    function updateSelectedItems() {
        var selectedIds = [];
        var selectedNames = [];
        var checkboxes = document.querySelectorAll('#list1 .items input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedIds.push(checkbox.value);
                selectedNames.push({
                    id: checkbox.value,
                    name: checkbox.getAttribute('data-name')
                });
            }
        });
        document.getElementById('selectedIds').value = selectedIds.join(',');

        // Update pills display
        var pillsContainer = document.getElementById('selectedItemsPills');
        pillsContainer.innerHTML = ''; // Clear existing pills
        selectedNames.forEach(function(item) {
            var pill = document.createElement('span');
            pill.className = 'pill';
            pill.textContent = item.name;
            pillsContainer.appendChild(pill);
        });
    }

    // Attach the update function to checkbox changes
    var checkboxes = document.querySelectorAll('#list1 .items input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateSelectedItems);
    });

    function updateUsersDropdown(element) {
        if (element.value != 'sales') {
            console.log(44);
            $('#serv').hide();
        } else {
            $('#serv').show();
        } 
        const departmentId = element.value;
        fetch(`{{env('APP_URL')}}admin/getuserbydiparment/${departmentId}`)
            .then(response => response.json())
            .then(data => { 
                const usersCheckboxList = document.querySelector('#list1 .items');
                usersCheckboxList.innerHTML = ''; // Clear current checkboxes
                data.forEach(user => {
                    // Create each checkbox item
                    const listItem = document.createElement('li');
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `user-${user.userId}`;
                    checkbox.value = user.userId;
                    checkbox.setAttribute('data-name', user.name);
                    checkbox.addEventListener('change', updateSelectedItems); // Assuming you have this function to handle changes

                    const label = document.createElement('label');
                    label.htmlFor = `user-${user.userId}`;
                    label.appendChild(document.createTextNode(user.name));

                    listItem.appendChild(checkbox);
                    listItem.appendChild(label);
                    usersCheckboxList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
$(document).ready(function() {
  $('input[name="name"]').on('input', function() {
    var name = $(this).val();
    var empId = name.replace(/\s+/g, '_');
    empId = empId.toLowerCase();
    $('input[name="user_id"]').val(empId+'_{{$last_id->id+1}}');
  });
});

// password check and not include special charecters
document.getElementById('password').addEventListener('paste', function(event) {
    var key = event.clipboardData.getData('text');
    var passwordError = document.getElementById('passwordError');
    if (!isAlphaNumeric(key)) {
        passwordError.textContent = 'Special characters are not allowed';
        event.preventDefault();
        return false;
    } else {
        passwordError.textContent = '';
    }
});

function isAlphaNumeric(char) {
    return /^[a-zA-Z0-9]+$/.test(char);
}
//   
  document.getElementById('password').addEventListener('keypress', function(event) {
    var key = event.key;
        var passwordError = document.getElementById('passwordError');
        if (!isAlphaNumeric(key)) {
            passwordError.textContent = 'Special characters are not allowed';
            event.preventDefault();
        } else {
            passwordError.textContent = '';
        }
    });
</script>