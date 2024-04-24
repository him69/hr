@include('admin.includes.header')
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #FFF !important;
        background-color: #4c4b46 !IMPORTANT;
    }

    .nav-pills .nav-link:hover {
        color: #495057 !important;
        background: #fdfdfd !important;
    }

    .w-fit {
        width: fit-content;
    }

    .nav-pills .nav-link.active:hover {
        color: #fff !important;
        background: #4c4b46d4 !important;
    }
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
        <style>
            .inputicon {
                font-size: 14px;
                color: #696969;
                min-width: 30px;
                text-align: center;
                border-right: 1px solid white;
            }

            .accordion-button::after {
                content: unset;
            }

            .Vsmall.bg-light.rounded-circle.p-1.bibr.d-flex.justify-content-center.align-items-center:after {
                content: 'Add user';
                min-width: 83px;
                position: absolute;
                left: 100%;
                padding: 0 0.5rem;
                opacity: 0;
            }

            .Vsmall.bg-light.rounded-circle.p-1.bibr.d-flex.justify-content-center.align-items-center.position-relative:hover {
                margin-right: 61px;
                transition: all .3s;
            }

            .Vsmall.bg-light.rounded-circle.p-1.bibr.d-flex.justify-content-center.align-items-center.position-relative:hover::after {
                opacity: 1;
                transition: all .3s;
            }
        </style>
        <div class="app-main__outer collapse table-responsive">
            <div class="app-main__inner ">
                <!-- <div class="overflow-hidden lReq baseShadow bg-white my-2 mx-auto">
                    <div class="nav row my-2  px-3 nav-tabs d-flex gx-0 m-0 border-0" id="nav-tab" role="tablist">
                        <div class="col">
                            <h5 class="fw-bold m-0 py-2">Teams Information</h5>
                        </div>
                    </div>
                    <div class="mx-3">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>designation</th>
                                <th>department</th>
                                <th>Salary</th>
                            </tr>
                            @foreach($teams as $team)
                            <tr class="userinfocopy">
                                @csrf
                                <td><a href="{{env('APP_URL')}}admin/attendance/full_report/{{$team->id}}">{{$team->user_id}}</a> </td>
                                <td>{{$team->name}}</td>
                                <td>{{$team->designation}}</td>
                                <td>{{$team->d_name}}</td>
                                <td class="salary">{{$team->salary}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div> -->
                <!-- team lead desigen -->
                <h4 class="fw-bold m-0 py-2">All Teams</h4>
                <div class="row">
                    <div class="col-8">
                        <div class="d-flex">
                            <div class="p-1 bg-white border border-black overflow-hidden rounded-1 ">
                                <!-- department come here- -->
                                <form method="GET" action="">
                                    <select class="border-0 w-100 bg-white p-1 Vsmall text-capitalize" onchange="this.form.submit()" name="teams">
                                        <option class="Vsmall text-capitalize" value="0" {{ $selected == 0 ? 'selected' : '' }}>all</option>
                                        @foreach($department as $dp)
                                        <option value="{{$dp->id}}" class="Vsmall text-capitalize" {{ $selected == $dp->id ? 'selected' : '' }}>{{$dp->d_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        @foreach($teams as $leader)
                        <div class="baseShadow bg-white mx-auto my-2 px-3 py-2 ">
                            <div class="fw-bold para  border-bottom border-light mb-2 d-flex justify-content-between overflow-hidden">
                                <p class="mb-0 text-capitalize">{{$leader->name}}</p>
                                <div class=" Vsmall bg-light rounded-circle p-1 bibr d-flex justify-content-center align-items-center position-relative arrPoin" onclick="began({{$leader->id}},{{$leader->dep_id}},'{{$leader->name}}')">
                                    <i class="fa-solid fa-plus "></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex" style="line-height: 2;">
                                    <div class="teamIcon fs-4 bg-light px-3 py-1 rounded">
                                        <i class="fa-solid fa-hand-holding-dollar text-success"></i>
                                    </div>
                                    <div class="mx-2">
                                        <p class="fw-bold charcoleBlack text-capitalize">{{$leader->d_name}}</p>
                                        <p class=" text-muted Vsmall fontmed text-capitalize">({{ $leader->teams->count() }}) Members</p>
                                    </div>
                                </div>
                                <div class="accordion-button Vsmall bg-light rounded-circle p-1 bibr d-flex justify-content-center align-items-center collapsed arrPoin" type="button" data-bs-toggle="collapse" data-bs-target="#team-{{$leader->id}}" aria-expanded="false" aria-controls="team-{{$leader->id}}">
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>
                            <div id="team-{{$leader->id}}" class="accordion-collapse my-2 collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form method="post">
                                        @csrf
                                        <div class="usersname d-flex flex-wrap">
                                            @foreach($leader->teams as $member)
                                            <span class="badge baseBtnBg rounded-pill p-2 px-3 my-2 mx-2 d-flex align-items-center w-fit">{{$member->name}}<input type="checkbox" name="userIds[]" value="{{$member->id}}" class="mx-2"></span>
                                            @endforeach
                                        </div>
                                        <div class="subbtn row justify-content-end">
                                            <div class="col-3">
                                                <input type="hidden" name="leader_id" value="{{$leader->id}}">
                                                <button type="submit" name="remove_user" class="baseBtnBg border-0 rounded mx-2 text-white  btn  w-100">remove</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-4 ">
                        <div class="nav-pills mb-3 d-flex justify-content-between" id="pills-tab" role="tablist">
                            
                            <div class="d-flex my-2 nav-item" role="presentation">
                                <div class="bg-white p-1 px-3 rounded para d-flex align-items-center justify-content-center nav-link" id="pills-leader-tab" data-bs-toggle="pill" data-bs-target="#pills-leader" type="button" role="tab" aria-controls="pills-leader" aria-selected="false" style="height: 38px;
                                width: 38px;">
                                    <i class="fa-solid fa-plus "></i>
                                </div>
                                <div class="mx-2">
                                    <p class="fw-bold">Make</p>
                                    <p class=" text-muted Vsmall fontmed">Leader</p>
                                </div>
                            </div>
                            <!-- remains it as it is not change  "d-none" -->
                            <div class=" my-2 nav-item d-none" role="presentation">
                                <div class="bg-white p-1 px-3 rounded para d-flex align-items-center justify-content-center nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="height: 38px;
                                 width: 38px;">
                                    <i class="fa-solid fa-plus "></i>
                                </div>
                                <div class="mx-2">
                                    <p class="fw-bold">Add</p>
                                    <p class=" text-muted Vsmall fontmed">Member</p>
                                </div>
                            </div>
                            <div class="d-flex my-2 nav-item" role="presentation">
                                <div class="bg-white p-1 px-3 rounded para d-flex align-items-center justify-content-center nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="height: 38px;
                                width: 38px;">
                                    <i class="fa-solid fa-plus "></i>
                                </div>
                                <div class="mx-2">
                                    <p class="fw-bold">Add</p>
                                    <p class=" text-muted Vsmall fontmed">Department</p>
                                </div>
                            </div>
                            <div class="d-flex my-2 nav-item" role="presentation">
                                <div class="bg-white p-1 px-3 rounded para d-flex align-items-center justify-content-center nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false" style="height: 38px;
                                width: 38px;">
                                    <i class="fa-solid fa-plus "></i>
                                </div>
                                <div class="mx-2">
                                    <p class="fw-bold">Replace</p>
                                    <p class=" text-muted Vsmall fontmed">Leader</p>
                                </div>
                            </div>
                        </div>

                        <!-- team lead form -->
                        <div class="bg-white w-100  tab-content" id="pills-tabContent">
                            <!-- replace team lead  -->
                            <div class="tab-pane fade p-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <form method="post">
                                    @csrf
                                    <p class="h5 text-muted fw-bold mb-2">Replace Team Lead</p>
                                    <div class="row gx-0 gy-2 py-2">
                                        <div class="col-12">
                                            <label for="" class="Vsmall fontmed">Select department</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- department come here- -->
                                                <select class="border-0 w-100 bg-white p-1" onchange="update_leader1(this)" name="dep_id">
                                                    <option class="Vsmall">Select department</option>
                                                    @foreach($department as $dp)
                                                    <option value="{{$dp->id}}" class="Vsmall">{{$dp->d_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- above department leader -->
                                            <label for="" class="Vsmall fontmed">Select team leader</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- user who lead will come here- -->
                                                <select name="leader_id" id="team_lead" class="border-0 w-100 bg-white p-1">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- select new team leader-->
                                            <label for="" class="Vsmall fontmed">Select new team leader</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- user who lead new will come here- -->
                                                <select name="userid" id="usersOfDep" class="border-0 w-100 bg-white p-1">
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <button type="submit" name="add_leader" class="btn mt-2 baseBtnBg border-0 rounded text-white w-100">Add new</button>
                                    <P class=" Vsmall text-muted px-2 fst-italic text-center">After Submitting the form old team leader will remove</P>
                                </form>
                            </div>
                            <!-- add new membar -->
                            <div class="tab-pane fade p-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <form method="post">
                                    @csrf
                                    <p class="h5 text-muted fw-bold mb-2">Add Team member</p>
                                    <div class="row gx-0 py-2">

                                        <div class="col-12">
                                            <label for="" class="Vsmall fontmed">select Team Leader</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- user who lead will come here- -->
                                                <input type="text" value="" class="border-0 w-100 bg-white p-1" id="leader_name" readonly>
                                                <input type="hidden" name="leader_id" value="" class="border-0 w-100 bg-white p-1" id="leader_uid">
                                            </div>
                                        </div>
                                        <style>
                                            .userderopDown {
                                                top: 100%;
                                                z-index: 1;
                                                left: 0;
                                                right: 0;
                                                min-height: calc(6 * 38px);
                                                overflow-y: scroll;
                                            }

                                            input.slect_user:checked+label {
                                                background: blanchedalmond;
                                            }

                                            label.userDname:hover {
                                                background: #e8e8e8;
                                            }
                                        </style>
                                        <div class="col-12">
                                            <!-- select new team leader-->
                                            <label for="" class="Vsmall fontmed">select user</label>
                                            <div class="p-1 border border-black d-flex align-items-center rounded-1 position-relative" id="usershow" style="min-height: 44px;">
                                                <div class="d-flex flex-wrap w-100" id="selectedUsers">
                                                </div>
                                                <div class="userderopDown w-100 position-absolute bg-white rounded border" id="allUsers" style="display: none;">
                                                    <ul style="list-style: none;" class="p-0 mb-0" id="usersbox">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_member" class="btn  baseBtnBg border-0 rounded text-white">Add new</button>

                                </form>
                            </div>
                            <!-- add new department -->
                            <div class="tab-pane fade p-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                <form method="post">
                                    @csrf
                                    <p class="h5 text-muted fw-bold mb-2">Add New Department</p>
                                    <div class="row gx-0 py-2">
                                        <div class="col-12">
                                            <label class="Vsmall fontmed" for="">Department Name<span class="text-danger">*</span></label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <input type="text" classclass="Vsmall" name="d_name" placeholder="Enter department name" required="" class="border-0 w-100 bg-white p-1">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_department" class="btn  baseBtnBg border-0 rounded text-white">Add new</button>
                                </form>
                            </div>
                            <!-- make new leader -->
                            <div class="tab-pane fade p-3" id="pills-leader" role="tabpanel" aria-labelledby="pills-lader-tab" tabindex="0">
                                <form method="post">
                                    @csrf
                                    <p class="h5 text-muted fw-bold mb-2">Make New Leader</p>
                                    <div class="row gx-0 py-2">
                                    <div class="col-12">
                                            <label for="" class="Vsmall fontmed">Select department</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- department come here- -->
                                                <select class="border-0 w-100 bg-white p-1" onchange="update_leader1(this,'new_team_lead')" name="dep_id">
                                                    <option class="Vsmall">Select department</option>
                                                    @foreach($department as $dp)
                                                    <option value="{{$dp->id}}" class="Vsmall">{{$dp->d_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- above department leader -->
                                            <label for="" class="Vsmall fontmed">Select new leader</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <!-- user who lead will come here- -->
                                                <select name="leader_id" id="new_team_lead" class="border-0 w-100 bg-white p-1">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="make_new_leader" class="btn baseBtnBg border-0 rounded text-white">Add new</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script>
            function update_leader1(e,a) {
                const depId = e.value;
                fetch(`{{env('APP_URL')}}admin/getleaderbydiparment/${depId}`).then(res => res.json()).then(data => {
                    let lead_select = document.getElementById('team_lead');
                    let user_select = document.getElementById('usersOfDep')
                    let new_leader_select = document.getElementById('new_team_lead')
                    lead_select.innerHTML = '';
                    user_select.innerHTML = '';
                    new_leader_select.innerHTML = '';
                    if (data.leaders && data.leaders.length > 0) {
                        data.leaders.forEach(leader => {
                            let option = new Option(leader.leader_name, leader.leaderId);
                            lead_select.appendChild(option);
                        })
                    } else {
                        let option = new Option('No leader found', '');
                        lead_select.appendChild(option);
                    }
                    if (data.users && data.users.length > 0) {
                        data.users.forEach(user => {
                            console.log('hello')
                            let userOption = new Option(user.user_id, user.id);
                            
                            user_select.appendChild(userOption);
                            let luserOption = new Option(user.user_id, user.id);
                            new_leader_select.appendChild(luserOption);
                        });
                    } else {
                        let userOption = new Option('No users found', '');
                        user_select.appendChild(userOption);
                    }
                    if(a =='new_team_lead' ){
                        if (data.users && data.users.length > 0) {
                        data.users.forEach(user => {
                            let luserOption = new Option(user.user_id, user.id);
                            new_leader_select.appendChild(luserOption);
                        });
                    } else {
                        let userOption = new Option('No users found', '');
                        new_leader_select.appendChild(luserOption);
                    } 
                    }
                });
            }
          
        </script>
        @include('admin.includes.footer')
        <script>
            function began(leader_id, dep_id, leader_name) {
                $('#pills-profile-tab').tab('show');
                document.getElementById('leader_name').value = leader_name;
                document.getElementById('leader_uid').value = leader_id

                fetch(`{{env('APP_URL')}}admin/getuserbyleader/${dep_id}/${leader_id}`).then(res => res.json()).then(data => {
                    // console.log(44);
                    let user_select = $('#usersbox')
                    user_select.innerHTML = '';

                    if (data.users && data.users.length > 0) {
                        data.users.forEach(user => {
                            let userOption = $(`<li><input type="checkbox" name="userids[]" id="adduser-${user.id}" value="${user.id}" class="d-none slect_user"><label for="adduser-${user.id}" class="w-100 p-2 border-bottom userDname mb-0 arrPoin" onclick="selectUser(this)">
                                                         ${user.user_id} </label> </li>`);
                            user_select.append(userOption);
                        });
                    } else {
                        let userOption = new Option('No users found', '');
                        user_select.appendChild(userOption);
                    }
                });
            }
            document.getElementById('usershow').addEventListener('click', function(event) {
                // event.stopPropagation();

                let users_box = document.getElementById('allUsers');
                let isDisplayed = users_box.style.display === 'block';
                users_box.style.display = isDisplayed ? 'none' : 'block';
            });

            // Listen for clicks on the entire document
            document.addEventListener('click', function(event) {
                let users_box = document.getElementById('allUsers');

                if (!event.target.closest('#usershow')) {
                    users_box.style.display = 'none';
                }
            });

            function addUserBadge(userId, userName) {
                // console.log('addbadge')
                const badgeContainer = document.getElementById('selectedUsers');
                const badge = document.createElement('div');
                badge.className = 'badge rounded-pill text-bg-light mr-2 my-1';
                badge.innerHTML = `${userName} <i class="fa-solid fa-xmark arrPoin" data-userid="${userId}" onclick="removebage(this)"></i>`;
                badgeContainer.appendChild(badge);

                // Event listener for removing the badge
            }

            function removebage(elem) {
                console.log(elem);
                let userId = elem.getAttribute('data-userid')
                var checkbox = document.getElementById(`adduser-${userId}`)
                if (checkbox) {
                    checkbox.checked = false; // Uncheck the checkbox
                } else {
                    console.log('Checkbox not found for user ID:', userId);
                }
                elem.parentNode.remove();
            }

            function selectUser(elem) {
                const checkBoxId = elem.getAttribute('for');
                document.getElementById(checkBoxId).addEventListener('change', function() {
                    // console.log(this.checked);
                    const userId = this.value;

                    if (this.checked) {
                        const userName = elem.textContent.trim();
                        addUserBadge(userId, userName);
                    } else if(!this.checked ) {
                        console.log(userId);
                        let icon = document.querySelectorAll(`.badge .fa-xmark[data-userid="${userId}"]`)
                        let badge = icon.closest('.badge')
                        console.log(badge)
                        if (badge) {
                            // console.log('working on removinf the badge');
                            removebage(badge);
                        }
                    }
                });
            }
        </script>