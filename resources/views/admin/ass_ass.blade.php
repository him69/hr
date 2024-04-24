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
  <div class="app-main overflow-hidden">
    @include('admin.includes.sidebar')
    <div class="app-main__outer collapse">
      <div class="app-main__inner container mt-4">
        <div class="row "> 
          <div class="col-md-12">
            <style>
              label.picture {
                border: 2px dashed grey;
                height: 162px;
                width: 162px;
                position: relative;
                background: gainsboro;
                cursor: pointer;
              }

              label.picture::before {
                content: "Add image file";
                position: absolute;
                top: 50%;
                left: 50%;
                text-align: center;
                transform: translate(-50%, -50%);
                color: #006396;
                font-weight: 600;

              }

              #imagePreview {
                background: url("https://ingoodcompany.asia/images/products_attr_img/matrix/default.png");
                height: 100%;
                display: block;
                width: 100%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
              }

              .ass_pro::before {
                content: "";
                position: absolute;
                width: 2px;
                background: #006396;
                height: 111%;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
                z-index: -1;
              }

              .bf {
                position: relative;
              }

              .bf::after {
                position: absolute;
                content: "";
                top: 0;
                right: 0;
                width: 2px;
                height: 100%;
                background-color: #eee;
              }
              .modal-dialog.inputFile{
                width: 74%;
              }
              .nav-tabs .nav-link:hover {
    color: inherit ;
}
.nav-tabs .nav-link{
    background-color: white;
    border-radius: 26px 42px 0 0;
    padding: 7px 48px;
    position: relative;
    color: black;
    border-bottom: 0;
}
.nav-tabs .nav-link.active{
    color: white;
    background-color: #006396 !important;
    border-radius: 26px 42px 0 0;
    padding: 0 48px;
    position: relative;
}
.nav-tabs .nav-link.active::before{
    content: "";
    height: 100%;
    position: absolute;
    left: 0;
    background: #006396;
    width: 23px;
    top: 0;
    transform: skewX(335deg);
    border-radius: 10px 0 0 0;
    transition: all .3s ease;
}
.nav-tabs .nav-link::before{
    content: "";
    height: 100%;
    position: absolute;
    left: 0;
    background: white;
    width: 23px;
    top: 0;
    transform: skewX(335deg);
    border-radius: 10px 0 0 0;
    transition: all .3s ease;
}
.nav-tabs .nav-link.active::after{
    content: "";
    height: 100%;
    position: absolute;
    right: 0;
    background: #006396;
    width: 23px;
    top: 0;
    transform: skewX(30deg);
    border-radius: 0 10px 0 0;
    transition: all .3s ease;
}
.nav-tabs .nav-link::after{
    content: "";
    height: 100%;
    position: absolute;
    right: 0;
    background: white;
    width: 23px;
    top: 0;
    transform: skewX(30deg);
    border-radius: 0 10px 0 0;
    transition: all .3s ease;
}
            </style>
            <!-- my code  -->
            <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3">
              <div class="row text-center">
                <div class="col-4 bf">
                  <p class="h3 sfont font-weight-bold cttext">{{$ass_count}}</p>
                  <p class="">Total Inventry</p>
                </div>
                <div class="col-4 bf">
                  <p class="h3 sfont font-weight-bold cttext">{{$assign_count}}</p>
                  <p class="">Total assignd</p>
                </div>
                <div class="col-4">
                  <p class="h3 sfont font-weight-bold text-danger">{{$faulty}}</p>
                  <p class="">Miscellaneous Item </p>
                </div>
              </div>
            </div>
            <div class="nav justify-content-around nav-tabs d-flex gx-0 p-0 m-0 border-0" id="nav-home-tab" role="tablist">
              <button class="nav-link  text-center " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Create</button>
              <button class="nav-link text-center active" id="nav-leave-tab" data-bs-toggle="tab" data-bs-target="#nav-leave" type="button" role="tab" aria-controls="nav-leave" aria-selected="true">Asset Management</button>
              <button class="nav-link text-center " id="nav-file-tab" data-bs-toggle="tab" data-bs-target="#nav-file" type="button" role="tab" aria-controls="nav-file" aria-selected="true">lost/damaged/returned</button>
            </div>
            <!-- tabs content -->
            <!-- message -->
            @if (session('success'))
            <div class="alert alert-success position-fixed" style="right: 0; top:27%;" id="success-alert">
              {{ session('success') }}
              @if (session('uploaded_count'))
            <br>Uploaded Count: {{ session('uploaded_count') }}
        @endif
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger position-fixed" style="right: 0; top:27%;" id="error-alert">
              {{ session('error') }}
              @if (session('duplicates'))
            <br>Duplicate Serial Numbers:
            <ul>
                @foreach(session('duplicates') as $duplicate)
                    <li>{{ $duplicate }}</li>
                @endforeach
            </ul>
        @endif
            </div>
            @endif
            <!-- message -->

            <div class="tab-content " id=" nav-tabContent" style=" margin-top: -8px;">
              <div class="tab-pane fade m-auto mb-0 " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3" style="width: 98%; ">
                  <div class=" align-items-center my-2 mt-4">
                    <p class="SubHeding m-0 text-center">Genral Info</p>
                  </div>



                  <form method="POST" action="{{env('APP_URL')}}admin/ass_ass" enctype="multipart/form-data">
                    @CSRF
                    <div class="row">
                      <div class="col-12">
                        <p class="fontmed labelstyle mb-0 mt-3">Product Image</p>
                        <label class="picture position-relative" for="picture__input" tabIndex="0">
                          <span class="" id="imagePreview"></span>
                        </label>

                        <input type="file" name="product_img" id="picture__input" style="display: none;" onchange="previewImage()">
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Product Code<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-hashtag inputicon"></i>
                          <input type="text" name="product_code" id="product-code" placeholder="e.g.PD/LAP/0001/2023(for laptops)" required class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Serial no.<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-hashtag inputicon"></i>
                          <input type="text" name="serial_number" placeholder="Enter Serial number of assets" required class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>

                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Asset Type<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-laptop inputicon"></i>
                          <input type="text" name="asset_type" list="types" placeholder="Asset Type" class="border-0 w-100 bg-white p-1" id="asset-type" onchange="generateProductCode()">
                          <datalist class="py-3" id="types">
                            <option value="Laptop">Laptop</option>
                            <option value="Mouse">Mouse</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Phone">Phone</option>
                            <option value="Head set">Head set</option>
                            <option value="Charger">Charger</option>
                          </datalist>
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Asset Name<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-desktop inputicon"></i>
                          <input type="text" name="asset_name" placeholder="Enter assets name" required="" class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Specification<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-microchip inputicon"></i>
                          <input type="text" name="ass_spec" placeholder="Enter Specifications of assets" required="" class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class=" align-items-center my-2 mt-4">
                        <p class="SubHeding m-0 text-center">Ownership</p>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Asset owner<span class="text-danger">*</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-chalkboard-user inputicon"></i>
                          <select list="user" name="asset_owner" class="border-0 w-100 bg-white p-1">
                            <option value="Pantheon">Pantheon</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">vendor</label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-desktop inputicon"></i>
                          <input type="text" name="vander" placeholder="Enter vander name" class="border-0 w-100 bg-white p-1" list="vanders">
                          <datalist id="vanders">
                            <option value="Pantheon">
                            <option value="Ankan Enterprise">
                            <option value="IT SOLUTION">
                          </datalist>
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="" require>Purchase date</label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-desktop inputicon"></i>
                          <input type="date" name="purchase_date" placeholder="Enter purchase date" value="{{date('Y-m-d')}}" class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Warranty in month</label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-desktop inputicon"></i>
                          <input type="text" name="warranty" placeholder="Enter warranty in month" class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class=" align-items-center my-2 mt-4">
                        <p class="SubHeding m-0 text-center">assign User</p>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Assigned to</label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-chalkboard-user inputicon"></i>
                          <select list="user" name="user_id" class="border-0 w-100 bg-white p-1" onchange="timeP()">
                            <option value="">Assigned to user(optional)</option>
                            @foreach($alluser as $auser)
                            <option value="{{$auser->id}}">{{$auser->user_id}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class=" align-items-center my-2 mt-4">
                        <p class="SubHeding m-0 text-center">Invoice</p>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Invoice <span class="text-muted">(select a invoice doc or file)</span></label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-chalkboard-user inputicon"></i>
                          <input type="file" name="invoice" class="border-0 w-100 bg-white p-1">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="fontmed labelstyle mb-0 mt-3" for="">Remark </label>
                        <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                          <i class="fa-solid fa-chalkboard-user inputicon"></i>
                          <input type="text" name="remark" class="border-0 w-100 bg-white p-1" placeholder="Add a Remark">
                        </div>
                      </div>


                      <div class="col-6 d-flex  align-self-end mt-3">
                        <button class="form-control p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">Create</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="tab-pane fade m-auto active show" id="nav-leave" role="tabpanel" aria-labelledby="nav-leave-tab">
                <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3" style="width: 98%;">
                  <div class="row align-items-center my-1">
                    <div class="col-12">
                      <p class="SubHeding m-0 text-center">Asset Management</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between ">
                    <div class="d-flex my-2 align-items-center bg-white px-2 py-2 border border-light rounded">
                      <p class="font-weight-bold" style="
    width: max-content;
">Filter By</p>
                      <select onchange="Filter(this)" class="px-2 p-1 border-0" id="slStatus" data-name="asset_type">
                        <option value="">Category</option>
                        @foreach($total_ass->unique('asset_type') as $ts)
                        <option value="{{$ts->asset_type}}">{{$ts->asset_type}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="d-flex ml-2 my-2 align-items-center bg-white px-3 py-2 rounded border border-light rounded">
                      <p class="font-weight-bold" style="
    width: max-content;
">Filter By</p>
                      <select name="" class="px-2 p-1 border-0" id="filterdate" data-name="date" onchange="Filter(this)">
                        <option value="">Date</option>
                        <option value="today">today</option>
                        <option value="yesterday">yesterday</option>
                        <option value="week">week</option>
                        <option value="fortnight">fortnight</option>
                        <option value="month">month</option>
                        <option value="six-month">six month</option>
                        <option value="year">Year</option>
                      </select>
                    </div>
                    <div class="d-flex ml-2 my-2 align-items-center bg-white px-3 py-2 rounded border border-light rounded">
                      <p class="font-weight-bold" style="
    width: max-content;
">Filter By</p>
                      <select name="" data-name="user" class="px-2 p-1 border-0" id="userFill" onchange="Filter(this)">
                        <option value="">User</option>
                        @foreach($alluser as $auser)
                        <option value="{{$auser->id}}">{{$auser->user_id}}</option>
                        @endforeach
                                              </select>
                    </div>
                    <div class="d-flex ml-2 my-2 align-items-center bg-white px-3 py-2 rounded border border-light rounded">
                      <p class="font-weight-bold" style="
    width: max-content;
">Filter By</p>
                      <select name="" data-name="assorunass" class="px-2 p-1 border-0" id="userFill" onchange="Filter(this)">
                        <option value="">Type</option>
                        <option value="unassignd">unassignd</option>
                        <option value="assign">assign</option>
                      </select>
                    </div>
                  </div>
                  <div class="bg-white rounded">
                    <div class="row mx-0 my-2 align-items-center bg-white px-3 py-2 rounded border-dark gx-2">
                      <p class="font-weight-bold col-2">Custom Filter </p>
                      <input type="text" class="px-2 py-2 border border-light rounded col-3" placeholder="Enter Serial Number,assignd or unassignd" data-name="custome_filter" id="csFill">
                      <div class="col-3"> <button class="form-control mx-2 baseBtnBg border-0 rounded  text-white" onclick="submitFilter()">search</button></div>
                      <div class="col-2 arrPoin" id="refreshButton">Reset Fillter <span><i class="bi bi-arrow-clockwise baseColor para"></i></span></div>
                      <div class="col-2 arrPoin" data-bs-toggle="modal" data-bs-target="#bulkUpload">Bluk Uploade<span><i class="bi bi-filetype-csv baseColor para mx-1"></i></span></div>
                    </div>

                    <div id="data-table">


                    </div>
                  </div>
                  <div id="pagination" class="py-3">

                  </div>

                </div>
              </div>
              <div class="tab-pane fade m-auto " id="nav-file" role="tabpanel" aria-labelledby="nav-leave-tab">
                <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3" style="width: 98%;">
                  <table class="table table-bordered text-center table-striped">
                    <tbody>
                      <tr>
                        <th>no.</th>
                        <th>Product Code</th>
                        <th>Serial no.</th>
                        <th>Type</th>
                        <th>Asset Name</th>
                        <th>Specification</th>
                        <th>Action</th>
                        <th>Action</th>
                      </tr>
                      @foreach($defaulty_ass as $assets)
                      @if($assets->status == 'faulty' || $assets->status == 'lost' || $assets->status == 'return')
                      <tr>
                        <td>@csrf</td>
                        <td>{{$assets->product_code ? $assets->product_code:'na'}}</td>
                        <td>{{$assets->serial_number}}</td>
                        <td>{{$assets->asset_type}}</td>
                        <td>{{$assets->asset_name}}
                        </td>
                        <td>{{$assets->ass_spec}}</td>
                        <td>{{$assets->status}}</td>
                        <td>{{$assets->purchase_date}}</td>
                        <td class="text-center">
                          <a href="{{env('APP_URL')}}admin/resolved/{{$assets->id}}" class="mx-2">
                            Move Back to Assets
                          </a>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- my code end  -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- modal bluk upload -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="bulkUpload" tabindex="-1" aria-labelledby="BulkLable" aria-hidden="true">
  <div class="modal-dialog inputFile modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="p-4 w-50 mx-auto" style="border: 5px dashed #dee2e6; border-radius: 12px;">
          <form action="{{env('APP_URL')}}admin/bulkUpload" method="POST" enctype="multipart/form-data" class="row">
            @csrf <label for="bulkuplod" class="w-100 text-center arrPoin">
              <div><i class="bi bi-upload fs-2 fw-bold"></i>
                <p class="fs-4">Drag &amp; drop any file here
                  <br> or <span class="baseColor">browse </span> file from device
                </p>
                <p id="FileSDhow">File Name:<span id="showFile" class="baseColor"></span> </p>
              </div><input type="file" class="d-none" name="bulkUpload" id="bulkuplod" required="">
            </label>
            <button type="submit" class="mx-auto col-3 btn align-self-center baseBtnBg border-0 rounded  text-white para" style="box-shadow: 0px 0px 40px -5px #006192;">Upload</button>
            <p class="text-muted text-center">Only upload CSV file</p>
          </form>
        </div>
        <div class="my-3">
          <p class="text-center">Example Data: <a href="{{env('APP_URL')}}/public/uploads/imgs/demo.csv" download="demo.csv">Download</a> </p>
        <table class="table sam table-bordered">
                <tbody>
                <tr>
                  <th>assets name</th>
                  <th>asset type</th>
                  <th>serial number</th>
                  <th>asset specification</th>
                  <th>assets owner</th>
                  <th>vender</th>
                  <th>purchase date</th>
                  <th>warranty</th>
                  <th>remark</th>
                </tr>  
                <tr>
                  <td>Dell</td>
                  <td>Laptop</td>
                  <td>AJDGH78T6DS</td>
                  <td>256gb ram,8gb storage</td>
                  <td>Panteon</td>
                  <td>Panteon</td>
                  <td>01-01-2024</td>
                  <td>01 year</td>
                  <td>Remark</td>
                </tr>
              </tbody></table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal bulk upload end -->
<style>
  .offcanvas-body::-webkit-scrollbar {
    width: 6px;
    height: 7px;
  }

  /* Track */
  .offcanvas-body::-webkit-scrollbar-track {
    background: #ffffff;
  }

  /* offcanvas-body */
  .offcanvas-body::-webkit-scrollbar-thumb {
    background: #F1F4F6;
  }

  .offcanvas.offcanvas-end {
    width: 50% !important;
  }

  .nav-pills .nav-link.active,
  .nav-pills .nav-link.active:hover {
    color: black !important;
  }

  .nav-pills .nav-link.active {
    background: transparent;
    color: black;
    position: relative;
  }

  .nav-pills .nav-link {
    background: transparent;
    color: black;
    text-transform: capitalize;
  }

  .nav-pills .nav-link.active::before {
    content: "";
    background: #006396;
    position: absolute;
    height: 3px;
    width: 100%;
    top: 100%;
    left: 50%;
    opacity: 1;
    transform: translateX(-50%);
    border-radius: 9px 10px 0 0;
    transition: all .3s ease-in;
  }

  .nav-pills .nav-link:not(.active)::before {
    content: "";
    background: #006396;
    position: absolute;
    height: 3px;
    width: 100%;
    top: 100%;
    left: 50%;
    transition: all .3s ease-in;
    transform: translateX(-100%);
    opacity: 0;
    border-radius: 9px 10px 0 0;
  }
</style>

@include('admin.includes.footer')
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Product Serial Number</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav nav-pills pb-3 mb-0 justify-content-around border-bottom border-light" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false">edit</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Asset detail</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="get_history()">Asset history</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

        <form method="POST" action="{{env('APP_URL')}}admin/ass_ass">
          @CSRF
          <input type="hidden" id="assid" name="id">
          <input type="hidden" id="aid" name="asset_id">
          <input type="hidden" id="uid" name="uid">
          <div class="row">
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Serial no.<span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-hashtag inputicon"></i>
                <input type="text" name="serial_number" placeholder="Enter Serial number of assets" id="sn" required class="border-0 w-100 bg-white p-1">
              </div>
            </div>

            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Asset Type<span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-laptop inputicon"></i>
                <input type="text" name="asset_type" list="types" placeholder="Asset Type" required class="border-0 w-100 bg-white p-1" id="at">
                <datalist class="py-3" id="types">
                  <option value="Laptop">Laptop</option>
                  <option value="Mouse">Mouse</option>
                  <option value="Keyboard">Keyboard</option>
                  <option value="Phone">Phone</option>
                  <option value="Head set">Head set</option>
                  <option value="Charger">Charger</option>
                </datalist>
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Asset Name<span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-desktop inputicon"></i>
                <input type="text" name="asset_name" placeholder="Enter assets name" required id="an" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Specification<span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-microchip inputicon"></i>
                <input type="text" name="ass_spec" placeholder="Enter Specifications of assets" required="" id="sp" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Asset owner<span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-chalkboard-user inputicon"></i>
                <input id="ao" name="asset_owner" list="assetowner" class="border-0 w-100 bg-white p-1" required>
                <datalist class="py-3" id="assetowner">
                  <option value="Pantheon">Pantheon</option>
                  <option value="Other">Other</option>
                </datalist>
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">vendor</label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-desktop inputicon"></i>
                <input type="text" name="vander" id="va" placeholder="Enter vander name" class="border-0 w-100 bg-white p-1" required list="vanders">
                <datalist id="vanders">
                  <option value="Pantheon">
                  <option value="Ankan Enterprise">
                  <option value="IT SOLUTION">
                </datalist>
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Purchase date <span class="text-danger">*</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-desktop inputicon"></i>
                <input type="date" name="purchase_date" id="pd" placeholder="Enter purchase date" required value="{{date('Y-m-d')}}" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Warranty in month</label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-desktop inputicon"></i>
                <input type="text" name="warranty" placeholder="Enter warranty in month" id="wim" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Change status to:</label>
              <div class="mt-3"><input type="radio" name="status" value="faulty">
                <label for="html">Damaged</label>
                <input type="radio" name="status" value="return">
                <label for="css">Return</label>
                <input type="radio" name="status" value="lost">
                <label for="javascript">lost</label>
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Invoice <span class="text-muted">(select a invoice doc or file)</span></label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-chalkboard-user inputicon"></i>
                <input type="file" name="invoice" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Remark </label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-chalkboard-user inputicon"></i>
                <input type="text" name="remark" class="border-0 w-100 bg-white p-1" placeholder="Add a Remark">
              </div>
            </div>
            <div class="col-6" id="atunot">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Assigned user</label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-chalkboard-user inputicon"></i>
                <input type="text" name="user_name" id="atu" placeholder="assignd User" class="border-0 w-100 bg-white p-1">
              </div>
            </div>
            <div class="col-6">
              <label class="fontmed labelstyle mb-0 mt-3" for="">Assigned to new</label>
              <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                <i class="fa-solid fa-chalkboard-user inputicon"></i>
                <select list="user" name="user_id" class="border-0 w-100 bg-white p-1">
                  <option value="">Assigned to user(optional)</option>
                  @foreach($alluser as $auser)
                  <option value="{{$auser->id}}">{{$auser->user_id}}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="col-6 d-flex  align-self-end mt-3">
              <button class="form-control p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row">
          <p class="fw-bold pb-3 fs-4 text-center">Genral Info</p>
          <div class="col-5" style="height: 142px;">
            <div class="rounded w-100 position-relative" style="overflow: hidden;height: 100%;">
              <div id="faultyStatus"></div>
              <img src="http://localhost/hr/public/assets/images/lp.jpg" class="w-100" style="object-fit: cover;height: 100%;" id="ass_img" alt="">
            </div>
          </div>
          <div class="col-7">
            <p class=" mt-2"><span class="font-weight-bold">Name : </span><span id="assetNmae"></span> </p>
            <p class=" mt-2"><span class="font-weight-bold">Serial Number: </span><span id="serialNo"></span></p>
            <p class=" mt-2"><span class="font-weight-bold">Spec : </span> <span id="spec"></span></p>
            <p class=" mt-2"><span class="font-weight-bold">Purchase Date : </span> <span id="buydate"></span> </p>
            <p class=" mt-2"><span class="font-weight-bold">Type : </span> <span id="asType"></span></p>
          </div>
        </div>
        <div class="row mx-0">
          <p class="fw-bold py-3 fs-4 text-center">Ownership</p>
          <div class="col-6 py-2 px-1  mt-2">
            <div class="row">
              <div class="col-6 text-muted">Assets Owner:</div>
              <div class="col-6 font-weight-bold" id="assOwner"></div>
            </div>

          </div>
          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">vendor:</div>
              <div class="col-6 font-weight-bold" id="assetVendor"></div>
            </div>
          </div>
          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">Assiged status:</div>
              <div class="col-6 font-weight-bold">
                <p class="px-2" style="background: lightgreen;text-align: center;border-radius: 20px;color: darkgreen;width: fit-content;" id="assignStatus">assignd (demo)
                </p>
              </div>
            </div>
          </div>
          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">Invoice</div>
              <div class="col-6 d-flex" id="invbox">
                <a href="" id="viewInvoice" class=" text-primary text-decoration-underline" target="_blank">view</a>
                <a download href="" id="dowInvoice" class="ml-3 text-primary text-decoration-underline">Download</a>
              </div>
            </div>
          </div>
          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">Time Period</div>
              <div class="col-6 ">
                <p id="dateRange"><span id="Afrom"></span> <br><span class="font-weight-bold" id="Ato"></span>
                </p>
              </div>
            </div>
          </div>

          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">User Name</div>
              <div class="col-6 ">
                <p>
                  <span id="usName"></span><a id="munass" target="_blank" class="text-danger text-center mx-2" title="mark unassign" href="">
                    Mark Unassign
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-6 py-2 px-1 mt-2">
            <div class="row">
              <div class="col-6 text-muted">Remark</div>
              <div class="col-6 ">
                <p id="remarkA"></p>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <!-- current historyn and privious history of an item -->
        <div class="">
          <div id="history-container" class="position-relative">
            <div class="row align-items-center position-relative">
              <p class="text-muted" style="position: absolute;top: 127%;left: 17%;"> <i class="bi bi-arrow-down"></i></p>
              <div class="col-2 ass_pro d-flex justify-content-center">
                <div style="width: 45px;height: 45px;border-radius: 50%;overflow: hidden;position: relative;">
                  <img id="a_img_h" src="http://localhost/hr//public/uploads/imgs/22Ymn28uhAi5Pis2cjFtjoEf4gtUe9V11GamoXIq.jpg" alt="" style="width: 100%;object-fit: cover;height: 100%;object-position: top;">
                </div>
              </div>
              <div class="col-8">
                <p style="font-weight: 600;font-family: 'Montserrat', sans-serif !important;"></p>
                <div class="d-flex">
                  <p style="background: lightgreen;text-align: center;border-radius: 20px;color: darkgreen;width: fit-content;width: fit-content;padding: 0 10px;"> assigned</p>
                  <p class="mx-2 text-muted">1-jan-2024</p>
                </div>
              </div>
            </div>

            <div class="row align-items-center mt-5">
              <div class="col-2 ass_pro d-flex justify-content-center">
                <div style="width: 45px;height: 45px;border-radius: 50%;overflow: hidden;position: relative;">
                  <img src="http://localhost/hr//public/uploads/imgs/22Ymn28uhAi5Pis2cjFtjoEf4gtUe9V11GamoXIq.jpg" alt="" style="width: 100%;object-fit: cover;height: 100%;object-position: top;">
                </div>
              </div>
              <div class="col-8">
                <p style="font-weight: 600;font-family: 'Montserrat', sans-serif !important;"></p>
                <div class="d-flex">
                  <p style="background: orange;text-align: center;border-radius: 20px;color: maroon;width: fit-content;padding: 0 10px;"></p>
                  <p class="mx-2 text-muted"></p>

                </div>
              </div>
            </div>
          </div>
          <!-- current historyn and privious history of an item -->
        </div>
      </div>
    </div>
  </div>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  // hide alert message
  function hideAlert(id, delay) {
    setTimeout(function() {
      let alertElement = document.getElementById(id);
      if (alertElement) {
        alertElement.style.display = 'none';
      }
    }, delay);
  }

  document.addEventListener('DOMContentLoaded', function() {
    hideAlert('success-alert', 3000);
    hideAlert('error-alert', 3100);
    // show csv file name
    var filediv = document.getElementById('FileSDhow')
      filediv.style.display='none'
    document.getElementById('bulkuplod').addEventListener('change',function(e){
      filediv.style.display='block';
      var fileName = '';
      if(this.files && this.files.length>0){
        fileName = this.files[0].name;
      }
      document.getElementById('showFile').textContent=fileName;
    })
  });
  // product code genrate
  function generateProductCode() {
    var assetType = document.getElementById('asset-type').value;
    var assetCode = assetType.substring(0, 3).toUpperCase();
    var currentYear = new Date().getFullYear();
    var lastProductCode = "{{ $lastval ? $lastval->product_code : '' }}";
    var parts = lastProductCode.split('/');
    var lastNumberPart = parts.length >= 3 ? parseInt(parts[2]) : 0;
    var uniqueNumber = lastNumberPart + 1;
    var fUniqueNumber = String(uniqueNumber).padStart(4, '0');

    var productCode = 'PD/' + assetCode + '/' + fUniqueNumber + '/' + currentYear;
    document.getElementById('product-code').value = productCode;
  }
  // model data
  async function fatchdata(e) {
    const ass_id = e.getAttribute('data-id');
    await fetch('{{env('APP_URL')}}admin/ass_ass/' + ass_id).then(Response => Response.json()).then(data => {

      const dataMappings = {
        'assid': data.id,
        'sn': data.serial_number,
        'at': data.asset_type,
        'aid': data.assets_id,
        'an': data.asset_name,
        'sp': data.ass_spec,
        'ao': data.asset_owner,
        'va': data.vander,
        'pd': data.purchase_date,
        'wim': data.warranty
      };
      Object.keys(dataMappings).forEach(key => {
        const element = document.getElementById(key);
        if (element) {
          element.value = dataMappings[key] || '';
        }
      });

      if (data.status == 'assign') {
        document.getElementById('atu').value = data.user_id;
        document.getElementById('atunot').style.display = 'block';
      } else if (data.status == 'unassignd' || data.status == null) {
        document.getElementById('atunot').style.display = 'none';
        document.getElementById('atu').value = '';
      }
      if (data.uid !== '' && data.uid != null) {
        document.getElementById('uid').value = data.uid;

      }

      const innerHTMLMappings = {
        'assetNmae': data.asset_name,
        'serialNo': data.serial_number,
        'offcanvasRightLabel': data.serial_number,
        'spec': data.ass_spec,
        'buydate': data.purchase_date,
        'asType': data.asset_type,
        'assOwner': data.asset_owner,
        'assetVendor': data.vander,
        'remarkA': data.remark
      };

      Object.keys(innerHTMLMappings).forEach(key => {
        const element = document.getElementById(key);
        if (element) {
          element.innerHTML = innerHTMLMappings[key] || '';
        }
      });
      if (data.status == 'assign') {
        document.getElementById('assignStatus').innerHTML = 'assignd';
        document.getElementById('munass').href = '{{env('APP_URL')}}admin/unassigend/' + data.id + '/' + data.uid;

        document.getElementById('munass').style.display = 'inline';
        document.getElementById('usName').innerText = data.user_id
        document.getElementById('Afrom').innerText = data.from + ' to '
        document.getElementById('Ato').innerText = 'Current'
      } else if (data.status == 'unassigned' || data.status == null) {
        document.getElementById('assignStatus').innerHTML = 'not assign';
        document.getElementById('assignStatus').style.background = '#e6e6e6';
        document.getElementById('assignStatus').style.color = 'black';
        document.getElementById('usName').innerText = 'none'
        document.getElementById('munass').style.display = 'none';
        document.getElementById('Afrom').innerText = 'none';
        document.getElementById('Ato').style.display = 'none';
      }
      if (data.asset_status == 'faulty') {
        document.getElementById('faultyStatus').innerHTML = `<i class="bi bi-x-lg position-absolute" style="font-size: 120px;left: 50%;top: 50%;transform: translate(-50%, -50%);backdrop-filter: saturate(0.5);width: 100%;display: flex;align-items: center;justify-content: center;height: 100%;COLOR: RED;"></i>`;
      }
      let url = '{{env('APP_URL')}}public/uploads/';
      if (data.invoice !== '' && data.invoice !== null) {
        document.getElementById('viewInvoice').href = url + data.invoice;
        document.getElementById('dowInvoice').href = url + data.invoice;
      } else {
        document.getElementById('invbox').innerHTML = 'not Uploaded';
        document.getElementById('ass_img').href = '{{env('APP_URL')}}public/assets/images/27002.jpg';
      }
      if (data.product_img !== '' && data.product_img !== null) {
        document.getElementById('ass_img').src = url + data.product_img;
      } else {
        document.getElementById('ass_img').src = '{{env('APP_URL')}}public/assets/images/27002.jpg';
      }

    }).catch(err => {
      console.log('eror', err);
    });
    await get_history();
    $('#offcanvasRight').offcanvas('show');
  }

  // show slected product image
  function previewImage() {
    var file = document.getElementById("picture__input").files;
    if (file.length > 0) {
      var fileReader = new FileReader();
      // console.log('running')
      fileReader.onload = function(event) {
        document.getElementById("imagePreview").style.backgroundImage = "url(" + event.target.result + ")";
      };

      fileReader.readAsDataURL(file[0]);
    }
  }
  var rOnce = false;
  // form user assign
  let currentPage = 1;
  let itemsPerPage = 15;
  // filters
  document.addEventListener('DOMContentLoaded', function() {

    var input = document.getElementById('csFill');


    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        submitFilter();
      }
    });
  });

  function submitFilter() {
    var inputElement = document.getElementById('csFill');
    Filter(inputElement);
    currentPage = 1;
  }

  function Filter(e) {
    let fill_type = e.getAttribute('data-name');
    let val = e.value;
    // console.log(val);  
    // console.log(fill_type);
    fetch('{{env('APP_URL')}}admin/filter/?' + fill_type + '=' + val).then(Response => Response.json()).then(data => {
      // console.log(data);
      // console.log(data);
      updateTable(data);
    })
  }
  // data on refrash
  function getall() {
    // let fill_type = e.getAttribute('data-name');
    // let val = e.value;
    // console.log(val);  
    // console.log(fill_type);
    fetch('{{env('APP_URL')}}admin/getall/').then(Response => Response.json()).then(data => {
      // console.log(data);
      updateTable(data);
    })
  }
  // table data update 
  function updateTable(data) {
    const div = document.getElementById('data-table');
    div.innerHTML = ''; // Clear existing content

    // Start building the table HTML as a string
    let table = '<table class="table table-bordered text-center table-striped">'; // Add your CSS class for styling if needed

    // Add table headers (adjust these headers to match your data keys)
    table += '<tr><th>no.</th><th>product code</th><th>Serial no.</th><th>Type</th><th>Asset Name</th><th>Specification</th><th>Action</th></tr>';

    let startIndex = (currentPage - 1) * itemsPerPage;
    let endIndex = Math.min(startIndex + itemsPerPage, data.length);

    for (let i = startIndex; i < endIndex; i++) {
      let item = data[i];
      let assi_status = '';
      if (item.assignment_status == 'assign') {
        assi_status = `<p style="background: lightgreen;text-align: center;border-radius: 20px;color: darkgreen;width: fit-content;padding: 0 10px;height: 23px;">${item.assignment_status}</p>`;
      } else if (item.assignment_status == 'unassigned') {
        assi_status = ''
      }
      table += `<tr>
                <td>${i + 1}@csrf</td>
                <td>${item.product_code}</td>
                <td>${item.serial_number}</td>
                <td>${item.asset_type}</td> 
                <td><div class="d-flex justify-content-between">
                            <p>${item.asset_name}</p>
                            ${assi_status}
                          </div></td> 
                <td>${item.ass_spec}</td> 
                <td class="text-center d-flex ">
                          <p type="button" data-id="${item.id}" class="mx-2 editAsset" onclick='fatchdata(this)'>
                            <i class="bi bi-pencil-square para arrPoin baseColor" title="edit/detail"></i>
                          </p>
                        </td>
              </tr>`;
      // count++;
    };

    table += '</table>';
    div.innerHTML = table;
    updatePaginationLinks(data, data.length);
  }
  // pagination
  function updatePaginationLinks(data, totalItems) {
    const paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = ''; // Clear existing pagination links

    let totalPages = Math.ceil(totalItems / itemsPerPage);
    let currentPageNum = parseInt(currentPage, 10); // Ensure currentPage is a number
    let endPage = Math.min(currentPageNum + 2, totalPages);

    // Create the unordered list element
    let ul = document.createElement('ul');
    ul.className = 'd-flex align-items-center justify-content-center';
    ul.style.listStyle = 'none';

    // Previous Page Link
    let prevLi = document.createElement('li');
    prevLi.className = 'd-flex';
    let prevLink = document.createElement('a');
    prevLink.href = '#';
    prevLink.innerText = 'Prev';
    prevLink.onclick = function() {
      if (currentPage > 1) {
        currentPage--;
        updateTable(data);
      }
      return false;
    };
    prevLi.appendChild(prevLink);
    ul.appendChild(prevLi);

    // Page Numbers
    let startPage = Math.max(currentPage - 2, 1);
    // console.log(startPage + 'start')
    // let endPage = Math.min(currentPage + 2, totalPages);
    // console.log(endPage + 'end')
    // Ellipses for Previous Pages
    if (currentPage > 3) {
      let ellipses = document.createElement('li');
      ellipses.innerText = '...';
      ul.appendChild(ellipses);
    }

    for (let i = startPage; i <= endPage; i++) {
      let li = document.createElement('li');
      li.className = 'mx-3 baseBtnBg rounded-circle px-2 py-2 d-flex justify-content-center align-items-center';
      li.style.height = '34px';
      li.style.width = '34px';

      let link = document.createElement('a');
      link.href = '#';
      link.className = 'text-white';
      link.innerText = i;
      // console.log("Current Page:", currentPage, "Total Pages:", totalPages);
      // Update the current page and re-render the table when a page link is clicked
      link.onclick = function() {
        currentPage = parseInt(i, 10);
        updateTable(data);
        // console.log(data)
        updatePaginationLinks(data, totalItems);
        return false;
      };

      li.appendChild(link);
      ul.appendChild(li);
    }


    // Ellipses for Future Pages
    if (currentPage < totalPages - 2) {
      let ellipses = document.createElement('li');
      ellipses.innerText = '...';
      ul.appendChild(ellipses);
    }

    // Next Page Link
    if (currentPage < totalPages) {
      let nextLi = document.createElement('li');
      nextLi.className = 'd-flex';
      let nextLink = document.createElement('a');
      nextLink.href = '#';
      nextLink.innerText = 'Next';
      nextLink.onclick = function() {
        if (currentPage < totalPages) {
          currentPage++;
          updateTable(data);
        }
        return false;
      };
      nextLi.appendChild(nextLink);
      ul.appendChild(nextLi);
    }

    paginationDiv.appendChild(ul);
  }

  // get history in model
  async function get_history() {
    let id = document.getElementById('assid').value;
    await fetch('{{env('APP_URL')}}admin/asset_history/' + id)
      .then(Response => Response.json())
      .then(data => {
        // console.log(data);
        const container = document.getElementById('history-container');
        container.innerHTML = ''; // Clear existing content

        // Sort data by 'created_at' in descending order
        data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

        data.forEach((item, index) => {
          const rowDiv = document.createElement('div');
          rowDiv.className = 'row align-items-center position-relative mt-5';
          let imageUrl;
          if (item.photo === null) {
            imageUrl = '{{env('APP_URL')}}/public/assets/images/user.svg'
          } else {
            imageUrl = '{{env('APP_URL')}}/public/uploads/' + item.photo;
          }
          // Adjust according to your data structure
          let latest_ass;
          let dateRange = '';
          if (item.status == 'assign') {
            latest_ass = '<div class="assign rounded-circle" style="position: absolute;right: 24%;z-index: 1;color: limegreen;font-size: 18px;top: 58%;background: white;height: 28px;width: 28px;display: grid;place-items: center;"><i class="bi bi-check2-circle"></i></div>'

            dateRange = ` ${item.from} to current`;

          } else if (item.status == 'unassigned' || item.status == null) {
            latest_ass = '';
            dateRange = ` ${item.from} to ${item.to}`;
          }
          rowDiv.innerHTML = `
                    <div class="col-2 ass_pro d-flex justify-content-center position-relative">
                          ${latest_ass}
                        <div style="width: 45px;height: 45px;border-radius: 50%;overflow: hidden;position: relative;">
                            <img src="${imageUrl}" alt="" style="width: 100%;object-fit: cover;height: 100%;object-position: top;">
                        </div>
                    </div>
                    <div class="col-8">
                        <p style="font-weight: 600;font-family: 'Montserrat', sans-serif !important;">${item.user_id}</p>
                        <div class="d-flex">
                            <p class="mx-2 text-muted">${dateRange}</p>
                        </div>
                    </div>`;

          container.appendChild(rowDiv);

          // Add the "previously assigned" element after the first (latest) item
          if (index === 0 && data.length > 1) {
            const prevAssigned = document.createElement('p');
            prevAssigned.className = 'text-muted';
            prevAssigned.style.cssText = 'position: absolute; top: 60px; left: 17%;';
            prevAssigned.innerHTML = 'Previously assigned <i class="bi bi-arrow-down"></i>';
            container.appendChild(prevAssigned);
          }
        });
        if (data.length <= 1) {
          const prevAssigned = document.querySelector('.text-muted');
          if (prevAssigned) {
            prevAssigned.style.display = 'none';
          }
        }else{
          console.log('hello');
          container.innerHTML = "Asset don't have any history";
        }
      });
  }
  getall();
  document.getElementById('refreshButton').addEventListener('click', function() {
    window.location.reload();
  });
  document.addEventListener('DOMContentLoaded', function() {
    function geturl(param) {
      const url = new URLSearchParams(window.location.search)
      return url.get(param)
    }
    let serialno = geturl('sn');
    if (serialno) {
      document.getElementById('csFill').value = serialno;
      submitFilter()
    }
  })
</script>