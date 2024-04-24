@include('user.includes.header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style type="text/css">
  .table-condensed {
    width: 100%;
  }

  .table-head {
    background-color: #0557AF;
    color: white;
    font-weight: bold;
    font-size: 18px;
    padding: 20rem;
  }

  .hol-box {
    text-align: center;
    padding: 1rem 2rem;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 5px 10px 0 rgb(0 0 0 / 25%);
  }

  .hol-box p {
    font-size: 25px;
  }

  .box-flex {
    justify-content: space-around;
  }

  .occasion {
    background-color: #abc4f1;
    padding: 10px;
    border-radius: 10px;
    font-size: 20px;
    box-shadow: 0 5px 10px 0 rgb(0 0 0 / 25%);
  }


  .holidays {
    margin-left: auto;
    margin-top: 4rem;
    /* display: flex; */
  }

  .format {
    font-size: 20px;
    display: flex;
    align-items: center;
  }

  .date {
    background-color: #0557AF;
    padding: 5px;
    width: 44%;
    color: white;
    margin: auto;
    box-shadow: 0 5px 10px 0 rgb(0 0 0 / 25%);
    border-radius: 8px;
  }

  .in {
    border-radius: 4px;
    margin: 10px;
    padding: 5px;
    width: 23rem;
    font-size: mediu;
  }

  .flatpickr-calendar.rangeMode.animate.inline {
    width: 100%;
    box-shadow: none;
  }

  .flatpickr-weekdays {
    width: 100% !important;
  }

  .flatpickr-days {
    width: 100% !important;
  }

  .dayContainer {
    width: 307.875px;
    min-width: 100%;
    max-width: 297.875px;
  }

  .flatpickr-day {
    max-width: 14%;
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
    height: auto;
  }

  .flatpickr-rContainer {
    width: 90%;
  }

  .flatpickr-innerContainer {
    justify-content: center;
  }
  .holibox .hoili_delete{
    opacity: 0;
    color: #4c4b46;
  }
  .holibox:hover  .hoili_delete{
opacity: 1;
  }

  /* csv modal  */
  .modal-dialog.inputFile {
    /* width: 74%; */
  }
</style>

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
    <div class="app-main__outer  table-responsive">
      <div class="app-main__inner mb-5">
        <div class="">
          <div class="row justify-content-between px-3">
            <div class="col-12  ms-auto ">
              <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
                <h3 class="fontmed">My Holidays</h3>
                <div>
                  <button class="btn" style="border: 2px solid #4c4b46;" data-bs-toggle="modal" data-bs-target="#bulkUpload"> Uploade <span><i class="bi bi-filetype-csv mx-1"></i></span></button>
                  <button type="button" class="btn baseBtnBg" type="button" data-bs-toggle="offcanvas" data-bs-target="#addholiday" aria-controls="addholiday"><i class="fa-solid fa-person-walking-arrow-right"></i>Add Holidays</button>
                </div>
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
                      <th class="d-flex justify-content-between holibox smaTxt col-6 border-0">{{ $holii->description }} <form action="" method="post"> @csrf <input type="hidden" name="id" value="{{$holii->id}}"> <button class="bg-transparent border-0" type="submit" name="delete_holi"> <i class="fa-solid fa-trash hoili_delete"></i></button></form></th>
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
                      <th class="d-flex justify-content-between smaTxt holibox col-6 border-0">{{ $holi->description }} <form action="" method="post"> @csrf <input type="hidden" name="id" value="{{$holi->id}}"> <button class="bg-transparent border-0" type="submit" name="delete_holi"> <i class="fa-solid fa-trash hoili_delete"></i></button></form></th>
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



  <!-- Modal -->
  <div class="modal fade" id="bulkUpload" tabindex="-1" aria-labelledby="BulkLable" aria-hidden="true">
    <div class="modal-dialog inputFile">
      <div class="modal-content">
        <div class="modal-body">
          <div class="p-4 mx-auto" style="border: 5px dashed #dee2e6; border-radius: 12px;">
            <form action="{{env('APP_URL')}}adper/bh" method="POST" enctype="multipart/form-data" class="row">
              @csrf <label for="blukholiday" class="w-100 text-center arrPoin">
                <div><i class="bi bi-upload fs-2 fw-bold"></i>
                  <p class="fs-4">Drag &amp; drop any file here
                    <br> or <span class="baseColor">browse </span> file from device
                  </p>
                  <p id="FileSDhow">File Name:<span id="showFile" class="baseColor"></span> </p>
                </div><input type="file" class="d-none" name="blukholiday" id="blukholiday" required="">
              </label>
              <button type="submit" class="mx-auto col-3 btn align-self-center baseBtnBg border-0 rounded  text-white para">Upload</button>
              <p class="text-muted text-center">Only upload CSV file</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- holiday form offset -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="addholiday" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header py-2">
      <h5 class="offcanvas-title text-center  fw-bold  m-auto" id="offcanvasRightLabel">Add Holiday</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <form action="" method="post">
      @csrf


      <div class="offcanvas-body px-3">
        <div class="d-flex flex-column pb-3">
          <label for="" class="samllText  fw-bold  px-1">Depatment</label>
          <select name="user_type" class="py-2 px-1 border-dark rounded border">
            <option value="#">Select Department</option>
            <option value="">All</option>
            @foreach($dep as $dep)
            <option value="{{$dep->id}}">{{$dep->d_name}}</option>
            @endforeach
          </select>
        </div>
        <div id="myCalendar" style="max-width: 300px; margin: auto;"></div>
        <input type="hidden" name="from" id="from">
        <input type="hidden" name="to" id="to">
        <!-- <div class="d-flex flex-column ">
          <label for="" class="samllText  fw-bold  px-1">From Date</label>
          <input type="date" name="name" class="py-2 px-1 border-dark rounded border" placeholder="Select from date">
        </div>
        <div class="d-flex flex-column ">
          <label for="" class="samllText  fw-bold  px-1">To Date</label>
          <input type="date" name="name" class="py-2 px-1 border-dark rounded border" placeholder="Select to date">
        </div> -->
        <div class="d-flex flex-column py-3">
          <label for="" class="samllText  fw-bold  px-1">Occassion</label>
          <input type="text" name="description" class="py-2 px-1 border-dark rounded border" placeholder="Enter occassion name">
        </div>
        <div class="d-flex justify-content-end ">
          <button type="submit" class="btn col-5 py-2 baseBtnBg align-self-end text-white m-0">Create</button>
        </div>
      </div>


    </form>
  </div>

  @if (session('success'))
  <div class="alert alert-success position-fixed" style="right: 0; top:27%;  z-index:99;" id="success-alert">
    {{ session('success') }}
    @if (session('uploaded_count'))
    <br>Uploaded Count: {{ session('uploaded_count') }}
    @endif
  </div>
  @endif
  @if (session('error'))
  <div class="alert alert-danger position-fixed" style="right: 0; top:27%; z-index:99;" id="error-alert">
    {{ session('error') }}
    @if (session('duplicates'))
    <br>Duplicate holidays:
    <ul>
      @foreach(session('duplicates') as $duplicate)
      <li>{{ $duplicate }}</li>
      @endforeach
    </ul>
    @endif
  </div>
  @endif

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr("#myCalendar", {
        mode: "range",
        dateFormat: "Y-m-d",
        inline: true, // This makes the calendar always visible
        onChange: function(selectedDates, dateStr, instance) {
          console.log(selectedDates)
          if (selectedDates.length >= 1) {
            var offset = new Date().getTimezoneOffset();

            // Always adjust the start date for the time zone offset
            var adjustedStartDate = new Date(selectedDates[0].getTime() - (offset * 60000));
            var startDate = adjustedStartDate.toISOString().substring(0, 10);

            // Initialize endDate as startDate in case only one date is selected
            var endDate = startDate;

            // If a second date is selected, adjust the end date for the time zone offset
            if (selectedDates.length == 2) {
              var adjustedEndDate = new Date(selectedDates[1].getTime() - (offset * 60000));
              endDate = adjustedEndDate.toISOString().substring(0, 10);
            }

            // Update the input fields
            document.getElementById('from').value = startDate;
            document.getElementById('to').value = endDate;
          }

          // console.log(dateStr);
        }
      });
    });

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
      filediv.style.display = 'none'
      document.getElementById('blukholiday').addEventListener('change', function(e) {
        filediv.style.display = 'block';
        var fileName = '';
        if (this.files && this.files.length > 0) {
          fileName = this.files[0].name;
        }
        document.getElementById('showFile').textContent = fileName;
      })
    });
  </script>