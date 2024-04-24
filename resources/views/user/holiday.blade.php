@include('user.includes.header')
<style>
    .btncash {
        background-color: #006396 !important;
        color: white !important;
    }

    .btncash i {
        border-radius: 50% !important;
        padding: 5px !important;
        color: #006396 !important;
        background-color: white !important;
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
  <div class="app-main">
    @include('user.includes.sidebar')
    <div class="app-main__outer table-responsive">
      <div class="app-main__inner mb-5">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-12 col-lg-7 ms-auto d-flex justify-content-between mt-5 mb-2">
              <h3 class="fontmed">My Holidays</h3>
              <a href="{{env('APP_URL')}}request_for_leave">
                <button type="button" class="btn btncash"><i class="fa-solid fa-person-walking-arrow-right"></i> Go request Leave</button></a>
            </div>
            <div class="col-12 p-4 ">
              <div class="row py-4 baseShadow borderRadius ">
                <div class="col-12 d-flex justify-content-between ">
                  <h5 class="fontmed mb-0">Here are your Gazetted holidays (2023 - 2024)</h5>
                </div>
                <p class="smaTxt">The holidays are divided into two categories, which is as per Australian Standards &
                  as per Indian
                  Standards.</p>
              </div>
            </div>
            <div class="col-6 p-4">
              <table class="table">
                <tbody class="row  baseShadow borderRadius p-4">
                  <tr>
                    <th>Indian Gazetted (National) Holidays</th>
                  </tr>
                  <tr class="col-6 p-0">
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">01 Jan 2023
                          (Sun)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">26 Jan 2023
                          (Thu)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">08 Mar 2023
                          (Wed)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">15 Aug 2023
                          (Tue)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">30 Aug 2023
                          (Wed)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">02 Oct 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">24 Oct 2023
                          (Tue)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">12 Nov 2023
                          (Sun)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">13 Nov 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">25 Dec 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                  </tr>
                  <tr class="col-6 p-0">
                    <th class="d-flex justify-content-between smaTxt ">New Year
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Republic Day
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Holi
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Independence Day
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Rakhi
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Gandhi Jayanti
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Dussehra
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Diwali
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Goverdhan Pooja
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Christmas
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-6 p-4">
              <table class="table">
                <tbody class="row  baseShadow borderRadius p-4">
                  <tr>
                    <th>Australian Gazetted (National) Holidays</th>
                  </tr>
                  <tr class="col-6 p-0">
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">01 Jan 2023
                          (Sun)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">26 Jan 2023
                          (Thu)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">07 Apr 2023
                          (Fri)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">10 Apr 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">25 Apr 2023
                          (Tue)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">12 Jun 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">25 Dec 2023
                          (Mon)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">NIL
                          (Nil)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">NIL
                          (Nil)</span> </div> <span>:</span>
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">
                      <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed">NIL
                          (Nil)</span> </div> <span>:</span>
                    </th>
                  </tr>
                  <tr class="col-6 p-0">
                    <th class="d-flex justify-content-between smaTxt ">New Year
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Australia Day
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Good Friday
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Easter Monday
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Anzac Day
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">King’s Birthday
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">Christmas
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">N/A
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">N/A
                    </th>
                    <th class="d-flex justify-content-between smaTxt ">N/A
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('user.includes.footer')
<script>
  flatpickr("#myDatepicker", {
    dateFormat: "Y-m-d",
    minDate: "{{date('Y')}}-01-01",
    inline: "true"
  });
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>