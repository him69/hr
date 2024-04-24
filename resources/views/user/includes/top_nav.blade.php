<style>
    .mainlogo {
        width: 220px;
    }

    .app-header .app-header__content {
        visibility: visible;
        opacity: 1;
    }
</style>
<div class="app-header header-shadow justify-content-between">
    <div class="app-header__logo">
        <div><img src="https://pantheondigitals.com/img/logo.webp" class="mainlogo"></div>
    </div>
    <div class="d-flex">
        <ul class="header-menu nav d-none d-md-flex">
            <li class="btn-group nav-item align-items-center px-2 py-1 baseShadow rounded-pill bg-white m-2">
                <a href="{{ env('APP_URL') }}" class="text-decoration-none">
                    <i class="fa-solid fa-house-chimney baseBtnBg p-1 m-1 vsmatxt rounded-circle"
                        style="color: #ffffff;"></i>
                    <span class="cttext fw-bold">Home</span>
                </a>
            </li>
            <li class="btn-group nav-item align-items-center px-2 py-1 baseShadow rounded-pill bg-white m-2">
                <a href="{{ env('APP_URL') }}profile" class="text-decoration-none">
                    <i class="fa-solid fa-user  baseBtnBg p-1 m-1 vsmatxt rounded-circle" style="color: #ffffff;"></i>
                    <span class="cttext fw-bold">profile</span>
                </a>
            </li>
            <li class="btn-group nav-item align-items-center px-2 py-1 baseShadow rounded-pill m-2 bg-white fw-bold"
                onclick="logout()" style="cursor: pointer;">
                <i class="fa-solid fa-door-open p-1 m-1 vsmatxt rounded-circle"
                    style="color: #ffffff; background:#ED4136;"></i>
                <span style="color:#ED4136;">Logout</span>

            </li>
        </ul>
        <div class="rounded-circle mx-4 "
            style="    overflow: hidden;
            height: 50px;
            width: 50px;">
            <a href="{{ env('APP_URL') }}profile" @if (Request::url() == 'https://hr.pantheondigitals.com/profile') class="mm-active" @endif
                title="profile">
                @if ($user->photo)
                    <img src="{{ env('APP_URL') }}public/uploads/{{ $user->photo }}" alt=""
                        style="height:100%; width:100%; object-fit:cover ;">
                @else
                    <img src="{{ env('APP_URL') }}public/assets/images/user.svg" alt=""
                        style="height:100%; width:100%; object-fit:cover ;">
                @endif
            </a>
        </div>
    </div>


</div>


<div class="col-3" id="logdropdown"
    style="display: none; background-color: #EEFAFB; border-radius: 0px 0px 10px 10px;position: fixed;top: 9%;right: 50px; z-index: 9;">
    <div class="my-4">
        <h3 class="text-center h3 m-auto my-4">
            <b>Do you want to logout?</b>
        </h3>
        <div class="d-flex justify-content-around">
            <button onclick="cancel()" class="btn btn-lg" style="background-color:#FFDE58;">
                <b>cancel</b>
            </button>
            <a href="{{ env('APP_URL') }}logout">
                <button class="btn btn-lg" style="background-color:#ED4136;color: white;"><b>logout</b>
                </button>
            </a>
        </div>
    </div>
</div>
<script>
    function logout() {
        let logbox = document.getElementById("logdropdown");
        logbox.style.display = "block";
    }

    function cancel() {
        let logbox = document.getElementById("logdropdown");
        logbox.style.display = "none";
    }
</script>
