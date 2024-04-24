@include('admin.includes.header')
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
<style>
    #nav-tab p.active{
        color: #006396;
    }
    .policy .tab-content{
      height: 500px;
      overflow: hidden;
      overflow-y: scroll;
    }
</style>
    <div class="app-main">
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse d-block">
            <div class="app-main__inner">
                <div class="row">
                    <div class="col-12">
                        <div class=" baseShadow rounded bg-white m-auto p-3 " style="width: 98%;">
                            <div class="">
                                <p class="SubHeding m-0 text-center">Add or Update Policies</p>
                            </div>
                            <form action="{{env('APP_URL')}}admin/policies" method="post">
                                @csrf
                                <div id="idInput"></div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Full Name<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="name" id="pname" required placeholder="Enter Policy name" required="" class=" border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Select User type <span class="text-muted">(Leave unchecked  for all user)</span><span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center">    
                                            <div class="d-flex align-items-center"><input type="radio" name="user_type" id="user_type_it" value="4">
                                                <label for="user_type_it" class="m-0">IT</label></div>
                                            <div class="mx-2 d-flex align-items-center"><input type="radio" name="user_type" value="1" id="user_type_sale">
                                                <label for="user_type_sale" class="m-0">Sale</label></div>      
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="fontmed labelstyle" for="">Write<span class="text-danger">*</span></label>
                                        <div class="p-1 border border-black overflow-hidden rounded-1 ">
                                            <textarea id="summernote" class="PolicyArea" name="content" required placeholder="Write Policy"  class=" border-0 w-100 bg-white p-1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-column  justify-content-center align-items-center my-3">
                                    <button class="p-2 col-3 baseBtnBg border-0 rounded mx-2 text-white" id="cr_up">
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="container policy my-3">
                    <div class="row">
                        <div class="col-3 p-0">
                            <div class="nav d-block bg-white rounded baseShadow bg-white p-3" id="nav-tab" role="tablist">
                                <p class="text-center SubHeding">All Policies</p>
                                @php $counter = 0; @endphp 
                                @foreach($get_policies as $gp)
                                @php $counter++; @endphp 
                                <p class="fw-bold {{ $loop->first ? 'active' : '' }}" id="nav-tab-{{$gp->id}}" data-bs-toggle="tab" data-bs-target="#nav-tab-pane-{{$gp->id}}" type="button" role="tab" aria-controls="nav-tab-pane-{{$gp->id}}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{$counter}}. {{$gp->name}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="nav-tabContent">
                                @foreach($get_policies as $gp)
                                <div class="tab-pane fade m-auto mb-0 bg-white baseShadow rounded position-relative bg-white p-3 {{ $loop->first ? 'show active' : '' }}" id="nav-tab-pane-{{$gp->id}}" role="tabpanel" aria-labelledby="nav-tab-{{$gp->id}}">
                                    <div class="ml-3 text-danger fw-bold my-2 position-absolute top-0 start-0" style="
                                    "><pn class="arrPoin" onclick="expPolicy(this,'{{$gp->id}}')">mark as deprecated</p></div>
                                    <div class="editPolicies rounded-circle d-flex para text-success p-2 position-absolute top-0 " style="right:1%;">
                                    @if($gp->user_type == 1) <div id="PolicyStatus-{{$gp->id}}" class="alert alert-success  rounded-pill py-1 px-2 smaTxt">Sale</div>
                                     @elseif($gp->user_type == 4) <div id="PolicyStatus-{{$gp->id}}" class="alert alert-info rounded-pill py-1 px-2 smaTxt">IT</div>
                                     @else<div id="PolicyStatus-{{$gp->id}}" class="alert alert-primary  rounded-pill py-1 px-2 smaTxt">All User</div> 
                                     @endif
                                    <i class="bi bi-pencil-square mx-2 arrPoin" onclick="policyUpdate({{$gp->id}})"></i>
                                    </div>
                                    <p class="h4 text-center fw-bold mt-3" id="name-{{$gp->id}}">{{$gp->name}}</p>
                                    <div id="Pcontent-{{$gp->id}}">{!! $gp->content !!}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="showmsg" class="alert alert-success position-fixed end-0" role="alert" style="display:none; top: 25%;
    z-index: 19;"></div>

@include('admin.includes.footer')
<script>
   $(document).ready(function() {
    $('#summernote').summernote({
        height: 400,
        placeholder: 'Write Policies',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontname']], // Include 'fontname' dropdown
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
        fontNames: ['Montserrat', 'Arial', 'Times New Roman', 'Verdana'],
        fontNamesIgnoreCheck: ['Montserrat'],
        styleTags: ['p', 'blockquote', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
        callbacks: {
            onInit: function() {
                var iframeDocument = $('#summernote').next('.note-editor').find('.note-editable').prop('contentDocument');
                $(iframeDocument.body).css('font-family', "'Montserrat', sans-serif");
            }
        }
    });
});

    // update policy
    function policyUpdate(id) {
    let idInput = document.getElementById('idInput');
    if (idInput) {
      
        createInput = document.createElement('input');
        createInput.type = 'hidden';
        createInput.id = 'idInput';
        createInput.name = 'id';
        createInput.value = id;
        idInput.append(createInput);
    }
    let policyStatus = document.getElementById(`PolicyStatus-${id}`);
    console.log(policyStatus.innerText);
    let name = document.getElementById(`name-${id}`).innerText; 
    let content = document.getElementById(`Pcontent-${id}`).innerHTML; 
    let inputName = document.getElementById('pname');
    if (inputName) {
        inputName.value = name; 
    }
    let inputContent = document.getElementsByClassName('PolicyArea')[0];
    if (inputContent) { let content = document.getElementById(`Pcontent-${id}`).innerHTML;
    $(inputContent).summernote('code', content);
    }
    let update = document.getElementById('cr_up');
    update.innerHTML = 'Update';
    if(policyStatus.innerHTML == 'Sale') { 
        document.getElementById('user_type_sale').checked = true;
    } else if(policyStatus.innerHTML == 'IT') { 
        document.getElementById('user_type_it').checked = true;
    }
}
function expPolicy(elem,id) {

    $.get('{{env('APP_URL')}}adper/policyExpire?id='+id+'&status=0', function(status){
        console.log(`Status: ${status}`);
   
    $('#showmsg').text("Policy marked as deprecated").show();
    setTimeout(function() {
            $('#showmsg').fadeOut('slow');
        }, 3000); 
    }) .fail(function() {
       
        alert("There was a problem with the request. Please try again.");
        
    });
}


</script>