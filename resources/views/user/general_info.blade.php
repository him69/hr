@include("user.includes.header")
<style>
  .scrollspy::-webkit-scrollbar {
    display: none;
  }

  .scrollspy {
    position: relative;
    height: 480px;
    overflow: auto;
    scroll-behavior: smooth;
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #006396;
  }


  .policy a {
    color: black;
  }

  .policy p {
    margin-top: 0.5rem !important;
  }

  .policy p,
  .policy ul li {
    font-size: 12px;
    font-weight: 500;
    /* margin: 10px 0; */
  }

  .policy b {
    font-weight: 600;
  }

  .policy h6 {
    margin: 10px 0;
  }


  .arroww::before {
    margin-left: -13px;
    content: "\00BB";
    font-size: 21px;
  }

  .policytable th,
  .policytable td {
    font-size: 18px;
    border: 1px solid;
  }
</style>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
  @include("user.includes.top_nav")
  <div class="ui-theme-settings">
    <div class="theme-settings__inner">
      <div class="scrollbar-container">

      </div>
    </div>
  </div>
  <div class="app-main">
    @include("user.includes.sidebar")
    <div class="app-main__outer">
      <div class="app-main__inner mt-5">
        @if(!$policies->isEmpty())
        <div class="container policy">
          <div class="row">
            <div class="col-3 p-0">
              <nav id="navbar-example3"
                class="navbar navbar-light bg-light flex-column align-items-stretch baseShadow borderRadius">
                <nav class="nav nav-pills flex-column">
              
                  @foreach($policies as $policy)
                  @if($policy->user_type == 1 && $user->user_type==1)
                  <a class="nav-link {{$loop->first ? 'active' :''}}" href="#item-{{$policy->id}}"><b>{{$policy->name}}</b></a>
                  @elseif($policy->user_type == 4 && $user->user_type==4)
                  <a class="nav-link {{$loop->first ? 'active' :''}}" href="#item-{{$policy->id}}"><b>{{$policy->name}}</b></a>
                  @elseif($policy->user_type == 0)
                  <a class="nav-link {{$loop->first ? 'active' :''}}" href="#item-{{$policy->id}}"><b>{{$policy->name}}</b></a>
                  @endif
                  @endforeach
                </nav>
              </nav> 
              </nav>
            </div>
            <div class="col-9 ">
              <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy"
                tabindex="0">
                @foreach($policies as $policy)
                @if($policy->user_type == 1 && $user->user_type==1)
                <div class="baseShadow borderRadius p-3 my-3" id="item-{{$policy->id}}">
                  <h4 class="text-center"><b>{{$policy->name}}</b></h> 
                  {!!$policy->content!!}  
                </div>
                @elseif($policy->user_type == 4 && $user->user_type==4)
                <div class="baseShadow borderRadius p-3 my-3" id="item-{{$policy->id}}">
                  <h4 class="text-center"><b>{{$policy->name}}</b></h> 
                  {!!$policy->content!!}  
                </div>
                @elseif($policy->user_type == 0)
                <div class="baseShadow borderRadius p-3 my-3" id="item-{{$policy->id}}">
                  <h4 class="text-center"><b>{{$policy->name}}</b></h> 
                  {!!$policy->content!!}  
                </div>
                @endif
                @endforeach
                
              </div>
            </div>
          </div>
        </div>
      @else
      <p class="text-center h2 text-muted fw-bold">
        No policy found or you don't have accepted any
      </p>
      @endif
      </div>
    </div>
  </div>
</div>

@include("user.includes.footer")