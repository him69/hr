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
        <div class="">
          <div class="row justify-content-between px-3">
            <div class="col-12  ms-auto ">
              <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
                <h3 class="fontmed">My Holidays</h3>
              </div>
            </div>

            <div class=" col-12  mb-3">
              <div class="bg-white p-3">
                <div class="  d-flex justify-content-between ">
                  <h5 class="fontmed mb-0">
                    <?php
                    $currentYear = date("Y"); // Current year, e.g., "2023"
                    $nextYear = date("Y", strtotime("+1 year")); // Next year, e.g., "2024"

                    echo "Here are your Gazetted holidays ($currentYear - $nextYear)";
                    ?>
                  </h5>
                </div>
                <p class="smaTxt">The holidays are divided into two categories, which is as per Australian Standards &
                  as per Indian
                  Standards.</p>
              </div>

            </div>
            <div class="col-6 ">
              <div class="p-3 bg-white">
                <p class="fw-bold">Indian Gazetted (National) Holidays</p>
                <table class="table">
                  <tbody class="">
                    <tr class="row border-0">
                      @foreach($holi as $holii)
                      @if($holii->user_type !== 1)
                      <?php
                      $date = new DateTime($holii->hdate);
                      $displayDate = $date->format(' j F Y (D)');
                      ?>
                      <th class="d-flex justify-content-between smaTxt col-6 border-0">
                        <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed"> {{ $displayDate }}</span> </div> <span>:</span>
                      </th>
                      <th class="d-flex justify-content-between holibox smaTxt col-6 border-0">{{ $holii->description }}
                      </th>
                      @endif
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
            <div class="col-6 ">
              <div class=" p-3 bg-white">
                <p class="fw-bold">Australian Gazetted (National) Holidays</p>
                <table class="table">
                  <tbody class="">
                    <tr class="row mx-0 border-0">
                      @foreach($holi as $holi)
                      @if($holi->user_type == 1 || $holi->user_type == 0)
                      <?php
                      $date = new DateTime($holi->hdate);
                      $displayDate = $date->format('j F Y (D)');
                      ?>
                      <th class="d-flex justify-content-between smaTxt col-6 border-0">
                        <div><i class="fa-regular fa-circle fa-2xs me-2"></i> <span class="smaTxt m-0 fontmed"> {{ $displayDate }}</span> </div> <span>:</span>
                      </th>
                      <th class="d-flex justify-content-between smaTxt holibox col-6 border-0">{{ $holi->description }}
                      </th>
                      @endif
                      @endforeach
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


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>