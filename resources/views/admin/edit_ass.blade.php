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
            <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3" style="width: 98%; ">
              <div class=" align-items-center my-2">
                <p class="SubHeding m-0 text-center">Add Assets</p>
              </div>
              <form method="POST" action="">
                @CSRF
                @if (session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Serial no.<span class="text-danger">*</span></label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-hashtag inputicon"></i>
                      <input type="text" name="serial_number" placeholder="Enter Serial number of assets" required
                        class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->serial_number : '' }}">
                    </div>
                   </div>

                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Asset Type<span class="text-danger">*</span></label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-laptop inputicon"></i>
                      <input type="text" name="asset_type" list="types" placeholder="Asset Type"
                        class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->asset_type : '' }}">
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
                      <input type="text" name="asset_name" placeholder="Enter assets name" required=""
                        class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->asset_name : '' }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Specification<span class="text-danger">*</span></label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-microchip inputicon"></i>
                      <input type="text" name="ass_spec" placeholder="Enter Specifications of assets" required=""
                        class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->ass_spec : '' }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Asset owner<span class="text-danger">*</span></label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-chalkboard-user inputicon"></i>
                      <input type="text" list="asset_owner" name="asset_owner" placeholder="Enter assets owner" required="" class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->asset_owner : '' }}">
                      <datalist id="asset_owner" class="border-0 w-100 bg-white p-1">
                        <option value="Pantheon">Pantheon</option>
                        <option value="Other">Other</option>
                      </datalist>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">vander</label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-desktop inputicon"></i>
                      <input type="text" name="vander" placeholder="Enter vander name"
                        class="border-0 w-100 bg-white p-1" list="vanders"  value="{{ isset($edit) ? $edit->vander : '' }}">
                        <datalist id="vanders">
                          <option value="Pantheon">
                          <option value="Ankan Enterprise">
                          <option value="IT SOLUTION">
                        </datalist>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Purchase date</label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-desktop inputicon"></i>
                      <input type="date" name="purchase_date" placeholder="Enter purchase date" value="{{ isset($edit) ? $edit->purchase_date : date('Y-m-d') }}" class="border-0 w-100 bg-white p-1">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Warranty in month</label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-desktop inputicon"></i>
                      <input type="text" name="warranty" placeholder="Enter warranty in month" class="border-0 w-100 bg-white p-1" value="{{ isset($edit) ? $edit->warranty : '' }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="fontmed labelstyle mb-0 mt-3" for="">Assigned to</label>
                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                      <i class="fa-solid fa-chalkboard-user inputicon"></i>
                      <select list="user" name="user_id"  class="border-0 w-100 bg-white p-1">
                        <option value="none">Assigned to user(optional)</option>
                        @foreach($alluser as $auser)
                        <option value="{{$auser->id}}"  {{ !empty($edit->user_id) ? 'selected' : '' }}>{{$auser->user_id}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-6 d-flex  align-self-end mt-3">
                    <button class="form-control p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">Create</button>
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
@include('admin.includes.footer')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>