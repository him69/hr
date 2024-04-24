@include('user.includes.header')
<style>
    canvas {
        border: 1px black solid;
    }

    #textCanvas {
        display: none;
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

    <style>
        input {
            height: 30px;
            border-left: 0;
            width: 100%;
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
        .cropper-container{
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
    <div class="container " style="margin-top: 70px;">
       
        <div style="margin-top: 70px;">
            <form action="{{env('APP_URL')}}profile/edit" class="row ss-item-required" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="bg-white p-4 rounded-4 my-4">
                    <div class="col-12 d-flex" style="margin-top: -87px;">
                        <label for="inputTag" style="position: relative; overflow: hidden; border-radius: 50%; margin: auto; border: 2px solid;height: 120px;width: 120px; background-color: white ;">

                            <img src="{{ $user->photo ? env('APP_URL') .'public/uploads/'.$user->photo : env('APP_URL') . 'public/assets/images/46547084.jpg' }}" style="border-radius: 50%;object-fit: cover;height: 100%; width: 100%;" id="prve">
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" id="inputTag" name="photo">
                            <input type="hidden" id="croppedImage" name="croppedImage">
                            <div class="btn position-absolute bottom-0 start-0 end-0 text-white"><i style="background-color: #4c4b46;padding: 10px; border-radius: 50%;" class="fa-solid fa-user-pen"></i> </div>
                        </label>

                    </div>
                    <div class="row">
                        <div class="col-12">

                            <p class="h4 fw-bold text-center">Personal Details</p>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="fontmed" for="">Full Name<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <i class="fa-solid fa-user inputicon"></i>
                                        <input type="text" name="name" value="{{$user->name}}" oninput="this.value = this.value.replace(/[^A-Za-z- ]/g, '').toUpperCase();" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="fontmed" for="">Email ID<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <i class="fa-solid fa-envelope inputicon"></i>
                                        <input type="email" name="email" value=" {{$user->email}}" placeholder="Enter your Email" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            <label class="fontmed" for="">Contact Number<span class="text-danger">*</span></label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                <span class="inputicon" style="font-size: 16px;">+91</span>
                                                <input type="number" name="mobile" value="{{$user->mobile}}" oninput="this.value = this.value.substring(0, 10); this.setCustomValidity(this.value.length < 10 ? 'Minimum 10 digits required.' : '');" class="border-0 w-100 bg-white p-1" required>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <label class="fontmed" for="">Date Of Birth<span class="text-danger">*</span></label>
                                            <div class="row">
                                                @php($dob = explode('-',$user->dob ? $user->dob : date('0-0-0')))
                                                <div class="col-12">
                                                    <input type="date" name="dob" class="form-control" value="{{$user->dob}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            <label class="fontmed" for="">Alternative Number</label>
                                            <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                <span class="inputicon" style="font-size: 16px;">+91</span>
                                                <input type="number" name="alt_mobile" value="{{$user->alt_mobile}}" oninput="this.value = this.value.substring(0, 10); this.setCustomValidity(this.value.length < 10 ? 'Minimum 10 digits required.' : '');" class="border-0 w-100 bg-white p-1" required>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <label class="fontmed" for="">Date of Joining the company
                                                <span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="date" name="joining_date" class="form-control" value="{{$user->joining_date}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex position-absolute bottom-0">
                                <div class="mt-auto">
                                    <img src="{{env('APP_URL')}}icon/adam.png" alt="" class="w-100 ">
                                </div>
                            </div>
                        </div>

                        <div class="col-6 position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <label class="fontmed" for="">Current Address<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <i class="fa-solid fa-map-location inputicon"></i>
                                        <input type="text" name="curnt_adrs" value="{{$user->curnt_adrs}}" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="fontmed" for="">Permanent Address<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <i class="fa-solid fa-map-location inputicon"></i>
                                        <input type="text" name="prmt_adrs" value="{{$user->prmt_adrs}}" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="fontmed" for="">Gender<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <i class="fa-solid fa-venus-mars inputicon"></i>
                                        <select name="gender" id="gender" value="{{$user->gender}}" class="border-0 w-100 bg-white p-1" required>
                                            <option value="" disabled selected>Choose</option>
                                            <option value="male" @if($user->gender === 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if($user->gender === 'female') selected
                                                @endif>Female</option>
                                            <option value="other" @if($user->gender === 'other') selected @endif>Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" bg-white p-4 rounded-4 my-4">
                    <div class="row">
                        <div class="col-12">
                            <p class="h4 fw-bold text-center">Professional Details</p>
                            <p class="text-center smaTxt">Upload a clear photo with clear background</p>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label class="fontmed" for="">Aadhaar Card Number<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <div class="inputicon"> <img src="{{env('APP_URL')}}public/icon/Aadhar-Black.svg" style="width: 25px; border: 1px solid;">
                                        </div>
                                        <input type="text" value="{{$user->adhar_no}}" name="adhar_no" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 12).replace(/(\d{4})(?=\d)/g, '$1-');this.setCustomValidity(this.value.length < 12 ? 'Enter a valid Aadhaar Card Number.' : '');" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-5 p-0 align-self-end mt-5">
                                    <button type="button" class="btn btnupload" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Aadhar <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                    <span style="font-size: 10px;" class="text-muted p-1">Upload both front &
                                        Back
                                        of your Aadhaar</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label class="fontmed" for="" class="m-0">PAN Card Number<span class="text-danger">*</span></label>
                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                        <div class="inputicon">
                                            <i class="fa-solid fa-id-card fa-xl inputicon"></i>
                                        </div>
                                        <input type="text" value="{{$user->pan_no}}" name="pan_no" oninput="this.value = this.value.replace(/[^A-Za-z\d\-]/g, '').substring(0, 10);this.setCustomValidity(this.value.length < 10 ? 'Enter a valid PAN Card Number.' : '');" class="border-0 w-100 bg-white p-1" required>
                                    </div>
                                </div>
                                <div class="col-5 p-0 align-self-end mt-">
                                    <button type="button" class="btn btnupload m-auto" data-bs-toggle="modal" data-bs-target="#panmodal">Upload PAN <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class=" bg-white p-4 rounded-4 my-4">
                    <p class="text-center h4 fw-bold">Banking Details</p>
                    <p class="text-center">Make sure to provide correct information, In case of wrong information
                        company
                        will not be
                        responsible for salary delays or misplace of your salary.</p>

                    <div class="row">
                        <div class="col-6 p-0">
                            <div class="col-12">
                                <label class="fontmed" for="">Account Holder Name<span class="text-danger">*</span></label>
                                <div class="   p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="bank_account_holder_name" oninput="this.value = this.value.replace(/[^A-Za-z- ]/g, '').toUpperCase();" value="{{$user->bank_account_holder_name}}" class="border-0 w-100 bg-white p-1" placeholder="Enter your Account Holder Name" required>

                                </div>
                            </div>
                            <div class="col-12">
                                <label class="fontmed" for="">Account Number<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="number" name="account_no" value="{{$user->account_no}}" class="border-0 w-100 bg-white p-1" placeholder="Enter your Account Number" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div class="col-12">
                                <label class="fontmed" for="">Bank Name<span class="text-danger">*</span></label>
                                <div class="   p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="bank_name" value="{{$user->bank_name}}" oninput="this.value = this.value.replace(/[^A-Za-z- ]/g, '').toUpperCase();" class="border-0 w-100 bg-white p-1" placeholder="Enter Bank Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="fontmed" for="">IFSC Code<span class="text-danger">*</span></label>
                                <div class=" p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="ifsc_code" value="{{$user->ifsc_code}}" oninput="this.value = this.value.replace(/[^A-Za-z\d\-]/g, '').substring(0,11);this.setCustomValidity(this.value.length < 11 ? 'Enter a valid IFSC Code.' : '');" class="border-0 w-100 bg-white p-1" placeholder="Enter Bank IFSC Code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-white border-0 mt-5">
                        <button type="submit" class="btn baseBtnBg text-white"><i class="fa-solid fa-user-pen"></i> Save
                            Information</button>
                    </div>

                </div>
                <!-- Modal uplode adhar card and priview -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg  mycontainer p-0 ">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h2 class="modal-title" id="exampleModalLabel" style="font-size: 25px;">Upload Aadhaar
                                    Card
                                </h2>
                            </div>
                            <div class="modal-body mycontainer">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3>Upload your Aadhar Card</h3>
                                        <p>upload clear image for successful verification</p>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                                            <div class="col-6 row justify-content-center align-items-center">
                                                <div class="col-7">

                                                    <input type="file" name="aadhar_card" accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="ua">
                                                    <label for="ua" class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                    </label>
                                                    <p class="text-center vsmatxt"><b style="color: #0099C7;">Re Upload
                                                            Again?</b></p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <p class="text-center smaTxt my-2"><b>Preview of your front
                                                            Aadhaar</b></p>
                                                    <div class="col-12 d-flex justify-content-center align-items-center">

                                                        <img src="{{$user->aadhar_card ? env('APP_URL').'public/uploads/'.$user->aadhar_card : env('APP_URL'.'icon/frontaadhaar.png')}}" style="width: 276p;height: 163px;" id="prvei">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                                            <div class="col-6 row justify-content-center align-items-center">
                                                <div class="col-7">
                                                    <input type="file" name="aadhar_card_back" accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="uba">
                                                    <label for="uba" class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                    </label>
                                                    <p class="text-center vsmatxt"><b style="color: #0099C7; ">Re Upload
                                                            Again?</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    let input = document.getElementById("uba");
                                                    let privewIg = document.getElementById("ubip")
                                                    input.addEventListener("change", () => {
                                                        let fileSelect = input.files[0];
                                                        if (fileSelect) {
                                                            const reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                privewIg.setAttribute('src', e.target.result);
                                                            }

                                                            reader.readAsDataURL(fileSelect);
                                                        }
                                                    });
                                                });
                                            </script>
                                            <div class="col-6">
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <p class="text-center smaTxt my-2"><b>Preview of your back
                                                            Aadhaar</b></p>
                                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                                        <img src="{{$user->aadhar_card_back ? env('APP_URL').'public/uploads/'.$user->aadhar_card_back : env('APP_URL'.'icon/backaadhaar.png')}}" style="width: 276p;height: 163px;" id="ubip">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <button type="button" data-dismiss="modal" class="btn m-auto baseBtnBg fontmed text-center col-3 btn-lg smaTxt">SAVE</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- uplode pan card -->
                <div class="modal fade" id="panmodal" tabindex="-1" aria-labelledby="panModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg  mycontainer p-0 ">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h2 class="modal-title" id="panModalLabel" style="font-size: 25px;">Upload Pan Card</h2>
                            </div>
                            <div class="modal-body mycontainer">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3>Upload your pan Card</h3>
                                        <p>upload clear image for successful verification</p>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                                            <div class="col-6 row justify-content-center align-items-center">
                                                <div class="col-7">

                                                    <input type="file" name="pan_card" accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="pa">
                                                    <label for="pa" class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                    </label>
                                                    <p class="text-center vsmatxt"><b style="color: #0099C7;">Re Upload
                                                            Again?</b></p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <p class="text-center smaTxt my-2"><b>Preview of your front
                                                            Aadhaar</b></p>
                                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                                        <img src="{{$user->pan_card ? env('APP_URL').'public/uploads/'.$user->pan_card : env('APP_URL'.'icon/pan.png')}}" style="width: 276p;height: 163px;" id="prveiw">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn m-auto baseBtnBg fontmed text-center col-3 btn-lg  smaTxt">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- crop image -->
    <div class="modal fade" id="cropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="imageToCrop" style="max-width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="emptyCropper" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn baseBtnBg text-white" id="cropImage">Crop and Save</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var pass = "{{base64_encode($user->password.csrf_token())}}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        
        function getsalary(e) {
            let a = prompt('Please Enter Password');
            a = btoa(a + {
                {
                    csrf_token()
                }
            });
            if (pass == a) {
                $(e).html('{{$user->salary}}/-');
            }
        }

        // function formcheck() {
        //     var requiredElements = document.querySelectorAll('.ss-item-required select, .ss-item-required textarea, .ss-item-required input');
        //     var fields = [];

        //     requiredElements.forEach(function (element) {
        //         console.log(element,element.value);
        //         if (element.value === '') {
        //             // element[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        //             element.parentNode.classList.add('red-border');
        //             element.focus();

        //         } else {
        //             element.parentNode.classList.remove('red-border'); // Remove 'red-border' when the field is not empty
        //         }

        //     });

        //     return fields; // Optionally, you can return the 'fields' array for further processing
        // }
    </script>
    <script>
        //  Profile pic
        let cropper;
        document.getElementById('inputTag').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imageToCrop').src = e.target.result;
                    $('#cropModal').modal('show');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#cropModal').on('shown.bs.modal', function() {
            cropper = new Cropper(document.getElementById('imageToCrop'), {
                aspectRatio: 1,
                viewMode: 1,
            });
        });

        document.getElementById('cropImage').addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas();
            document.getElementById('prve').src = canvas.toDataURL();
            document.getElementById('croppedImage').value = canvas.toDataURL();
            
        });
        document.getElementById('emptyCropper').addEventListener('click',function(){
             $('#cropModal').modal('hide');
            cropper.destroy();
        })
        $(document).ready(function(){
        document.getElementById('cropImage').addEventListener('click',function(){
    let cropedImage = document.getElementById('croppedImage').value;

    $.ajax({
        url:'{{env('APP_URL')}}profile/edit',
        type:'POST',
        data:{
            _token: "{{ csrf_token() }}", 
            croppedImage: cropedImage
        },success:function(res){
            $('#cropModal').modal('hide');
            cropper.destroy();
            console.log(cropedImage);
        },error:function(xhr,status,e){
            console.log(cropedImage);
            console.log('error',e);
        }
    })
    
})

});

        // aadhaar card
        document.addEventListener("DOMContentLoaded", function() {
            let input = document.getElementById("ua");
            let privewIg = document.getElementById("prvei")
            input.addEventListener("change", () => {
                let fileSelect = input.files[0];
                if (fileSelect) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        privewIg.setAttribute('src', e.target.result);
                    }

                    reader.readAsDataURL(fileSelect);
                }
            });
        });

        // Pan 
        document.addEventListener("DOMContentLoaded", function() {
            let input = document.getElementById("pa");
            let privewIg = document.getElementById("prveiw")
            input.addEventListener("change", () => {
                let fileSelect = input.files[0];
                if (fileSelect) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        privewIg.setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(fileSelect);
                }
            });
        });
    </script>
   
    <script></script>
