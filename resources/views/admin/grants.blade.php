@include('admin.includes.header')
<style>
    #uid {
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('admin.includes.top_nav')
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">
            </div>
        </div>
    </div>
    <div class="app-main overflow-hidden">
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse">
            <div class="app-main__inner">
            @if(session('error'))
                        <div class="alert alert-danger" id="error-alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                        @endif
                <form action="" method="post">
                    @csrf
                    <div>
                        <label for="">permisions for</label>
                        <select name="uid" id="">
                            <option value="">select permision</option>
                            @foreach($grants as $grant)
                            <option value="{{$grant->id}}">{{$grant->permission_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="">permisions to</label>
                        <select name="permission_id" id="">
                            <option value="">select user</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->user_id}}</option>
                            @endforeach
                        </select>
                    </div>
                 <button class="" type="submit">Give access</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')