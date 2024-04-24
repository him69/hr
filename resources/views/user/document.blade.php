@include('user.includes.header')
<style>
    input {
        /* height: 30px; */
        border-left: 0;
        /* width: 100%; */
        background-color: white;
    }

    label {
        font-size: 17px;
        margin-top: 24px;
        margin-bottom: 0px;
    }

    .br {
        border-radius: 5px;
        border: 1px solid #707070;
        overflow: hidden;
        padding: 4px;
        display: flex;
        align-items: center;
    }

    .inputicon {
        font-size: 20px;
        background: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        min-width: 30px;
        text-align: center;
        border-right: 1px solid #707070;
    }

    .dobstyle {
        padding: 6px 13px;
        border: 1px solid;
    }

    .dobstyle:focus {
        padding: 6px 13px;
        border: 1px solid;
    }

    .btnupload {
        color: white;
        background-color: #4c4b46;
        width: 100%;
    }

    .mycontainer h2 {
        font-weight: 900;
    }

    input[type="file"] {
        display: none;
    }

    label {
        cursor: pointer;
    }

    .red-border {
        border: 2px solid red !important;
    }

    .cropper-container {
        /* crop image container  */
        width: 100% !important;
    }

    .fixed-header .app-header {
        position: fixed;
        width: calc(100% - 100px);
        top: 0;
        margin-left: 0;
        background: #f1f4f6;
        width: 100%;
    }
</style>
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('user.includes.top_nav')
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">
            </div>
        </div>
    </div>
    <div class="container " style="margin-top: 70px;">
        @if (session('error'))
        <div class="alert alert-danger" id="error-alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif
        <div style="margin-top: 70px;">

            <div class="bg-white p-4 rounded-4 my-4">
                
                <form action="{{ env('APP_URL') }}profile/documentUpload" enctype="multipart/form-data"  class="row ss-item-required" method="post"
                    enctype='multipart/form-data'>
                    @csrf
                    <div class="col-12 d-flex" style="margin-top: -87px;">
                        <label for="inputTag"
                            style="position: relative; overflow: hidden; border-radius: 50%; margin: auto; border: 2px solid;height: 120px;width: 120px; background-color: white ;">

                            <img src="{{ $user->photo ? env('APP_URL') . 'public/uploads/' . $user->photo : env('APP_URL') . 'public/assets/images/46547084.jpg' }}"
                                style="border-radius: 50%;object-fit: cover;height: 100%; width: 100%;" id="prve">
                        </label>

                    </div>
                    <p class="text-center my-2 vsmatxt font-italic text-muted">You have Uploaded @foreach($document as $user_doc)
                        @if($user_doc->doc_verify == 0 || $user_doc->doc_verify == 1)
                        {{$user_doc->document_name}}, @endif
                         @endforeach .</p>
                    <p class="text-center my-2 vsmatxt font-italic text-danger">Your @foreach($document as $doc_rej)
                        @if($doc_rej->doc_verify == 2)
                        {{$doc_rej->document_name}}
                        @endif
                         @endforeach is rejected upload it again.</p>
                    <input type="hidden" name="document_name" value="Aadhaar Card">
                    <input type="hidden" name="uid" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-12">
                            <p class="h4 fw-bold text-center">Upload documents</p>
                        </div>
                        <div class="col-6">
                            <label class="fontmed" for="">Aadhaar Card Number<span
                                    class="text-danger">*</span></label>
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                <div class="inputicon"> <img src="{{ env('APP_URL') }}public/icon/Aadhar-Black.svg"
                                        style="width: 25px; border: 1px solid;">
                                </div>
                                <input type="text" value="" class="border-0"
                                    name="document_value"  oninput="formatAadhaar(this);" maxlength="14" required>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6">
                            <label class="fontmed" for="">Aadhaar Front<span
                                    class="text-danger">*</span></label>
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1">
                                <label for="aadhaar_front" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                    <input type="file" name="document_image[]" id="aadhaar_front" class="d-none" required>
                                    <div style="display: flex"
                                        class=" justify-content-center align-items-center w-100 h-100" id="plus">
                                        <i class="fa-solid fa-plus fs-5"></i>
                                    </div>
                                    <img src="" class="w-100 h-100" alt="" id="prvei"
                                        style="display: none ;object-fit:contain;">
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="fontmed" for="">Aadhaar Back<span class="text-danger">*</span></label>
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1">
                                <label for="aadhaar_back" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                    <input type="file" name="document_image[]" required id="aadhaar_back" class="d-none">
                                    <div style="display: flex"
                                        class=" justify-content-center align-items-center w-100 h-100" id="pluss">
                                        <i class="fa-solid fa-plus fs-5"></i>
                                    </div>
                                    <img src="" class="w-100 h-100" alt="" id="prveii"
                                        style="display: none ;object-fit:contain;">
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="aadhaar" class="btn baseBtnBg text-white my-3"><i
                                    class="fa-solid fa-user-pen"></i> Upload Aadhaar</button>
                        </div>
                    </div>
                </form>
                <form action="{{ env('APP_URL') }}profile/documentUpload" enctype="multipart/form-data" class="row ss-item-required" method="post"
                    enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="document_name" value="Pan Card">
                    <input type="hidden" name="uid" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-6">
                            <label class="fontmed" for="">Pan Card Number<span
                                    class="text-danger">*</span></label>
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                <div class="inputicon"> <i class="fa-solid fa-id-card fa-xl inputicon"></i>
                                </div>
                                <input type="text" value="" name="document_value" class="border-0" maxlength="10" oninput="formatPAN(this);" required>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6">
                            <label class="fontmed" for="">Pan Image<span class="text-danger">*</span></label>
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1">
                                <label for="pan_image" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                    <input type="file" required name="document_image" id="pan_image" class="d-none">
                                    <div style="display: flex"
                                        class=" justify-content-center align-items-center w-100 h-100" id="pan_plus">
                                        <i class="fa-solid fa-plus fs-5"></i>
                                    </div>
                                    <img src="" class="w-100 h-100" alt="" id="pan_prev"
                                        style="display: none ;object-fit:contain;">
                                </label>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-4">
                            <button type="submit" name="pancard" class="btn baseBtnBg text-white my-3"><i
                                    class="fa-solid fa-user-pen"></i> Upload pan</button>
                        </div>
                    </div>
                </form>
                <form action="{{ env('APP_URL') }}profile/documentUpload" enctype="multipart/form-data" class="row ss-item-required" method="post"
                    enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="uid" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-12">
                            <p class="h4 fw-bold text-center">Last Company Document</p>
                        </div>
                        <div class="col-6">
                            <label class="fontmed border-0" for=""> Select One<span
                                    class="text-danger">*</span></label>
                            <div class="d-flex">
                                <div class="p-1 d-flex align-items-center  ">
                                    <label class="fs-6 mt-0 d-flex align-items-center" for=""><span><i
                                                class="fa-solid fa-envelope-open-text me-2"></i></span>Experianse &
                                        releving <input required type="radio" name="document_name" class="mx-2"
                                            id="" value="Experianse & releving"></label>
                                </div>
                                <div class="mx-3 p-1 d-flex align-items-center  ">
                                    <label for="" class="fs-6 mt-0 d-flex align-items-center"> <span><i
                                                class="fa-solid fa-file-invoice-dollar me-2"></i></span> Salary
                                        slip</label>
                                    <input required type="radio" name="document_name" class="mx-2" id="" value="Salary slip">
                                </div>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-6">
                            {{-- <label class="fontmed" for=""><span
                                    class="text-danger">*</span></label> --}}
                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1">
                                <label for="comp_doc" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                    <input type="file" required name="document_image" id="comp_doc" class="d-">
                                    <div style="display: flex"
                                        class=" justify-content-center align-items-center w-100 h-100" id="comp_plus">
                                        <i class="fa-solid fa-plus fs-5"></i>
                                    </div>
                                    <img src="" class="w-100 h-100" alt="" id="comp_prev"
                                        style="display: none ;object-fit:contain;">
                                </label>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-4">
                            <button type="submit" name="lastcom" class="btn baseBtnBg text-white my-3"><i
                                    class="fa-solid fa-user-pen"></i> Upload Document</button>
                        </div>
                    </div>
                </form>
                <form action="{{ env('APP_URL') }}profile/documentUpload" enctype="multipart/form-data" class="row ss-item-required" method="post"
                    enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="uid" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-12">
                            <p class="h4 fw-bold text-center">Upload Study documents</p>
                        </div>
                        {{-- <div class="col-6"></div> --}}
                        <div class="col-6">
                            <label class="fontmed" for="">Document One<span
                                    class="text-danger">*</span></label>
                            <div
                                class="p-1 my-2 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                <div class="inputicon"> <i class="fa-solid fa-graduation-cap "></i>
                                </div>
                                <select type="text" required  name="document_name_one" class="border-0">
                                    <option value="Secondary">Secondary</option>
                                    <option value="Higher secondary">Higher secondary</option>
                                    <option value="Highest Education">Any Highest Education</option>
                                </select>
                            </div>

                            <label for="document_image_one" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                <input type="file" name="document_image_one" id="document_image_one" class="d-none">
                                <div style="display: flex"
                                    class=" justify-content-center align-items-center w-100 h-100" id="one_plus">
                                    <i class="fa-solid fa-plus fs-5"></i>
                                </div>
                                <img src="" class="w-100 h-100" alt="" id="one_prev"
                                    style="display: none ;object-fit:contain;">
                            </label>
                        </div>

                        <div class="col-6">
                            <label class="fontmed" for="">Document two<span
                                    class="text-danger">*</span></label>
                            <div
                                class="p-1 my-2 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                <div class="inputicon"> <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <select type="text" required name="document_name_two" class="border-0">
                                    <option value="Secondary">Secondary</option>
                                    <option value="Highest secondary">Higher secondary</option>
                                    <option value="Highest Education">Any Highest Education</option>
                                </select>
                            </div>

                            <label for="document_image_two" class="border w-100 mt-0" style="aspect-ratio:16/9;">
                                <input type="file" required name="document_image_two" id="document_image_two"  class="d-none">
                                <div style="display: flex"
                                    class=" justify-content-center align-items-center w-100 h-100" id="two_plus">
                                    <i class="fa-solid fa-plus fs-5"></i>
                                </div>
                                <img src="" class="w-100 h-100" alt="" id="two_prev"
                                    style="display: none ;object-fit:contain;">
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="studydoc" class="btn baseBtnBg text-white my-3"><i
                                class="fa-solid fa-user-pen"></i>
                            Upload Study Document</button>
                    </div>
            </form>
            
        </div>

    </div>
</div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    // Function to set up the file input listener
    function setUpInputListener(inputId, previewImgId, plusDivId) {
        let input = document.getElementById(inputId);
        let previewImg = document.getElementById(previewImgId);
        let plusDiv = document.getElementById(plusDivId);

        input.addEventListener("change", () => {
            let fileSelected = input.files[0];
            if (fileSelected) {
                const reader = new FileReader();
                previewImg.style.display = 'block';  // Show the preview image
                plusDiv.style.display = 'none';  // Hide the plus icon

                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(fileSelected);
            }
        });
    }

    // Set up listeners for both Aadhaar front and back images
    setUpInputListener("aadhaar_front", "prvei", "plus");
    setUpInputListener("aadhaar_back", "prveii", "pluss");
    setUpInputListener("pan_image", "pan_prev", "pan_plus");
    setUpInputListener("comp_doc", "comp_prev", "comp_plus");
    setUpInputListener("document_image_one", "one_prev", "one_plus");
    setUpInputListener("document_image_two", "two_prev", "two_plus");
});

    // rejex
    function formatAadhaar(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.slice(0, 12);
    const formatted = value.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');
    input.value = formatted;
}
function formatPAN(input) {
    let value = input.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
    value = value.slice(0, 10);
    input.value = value;
}
</script>
