@include('admin.includes.header')

        <div class="row ">
          <div class="col-md-12">
            <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3" style="width: 98%; ">
              <div class=" align-items-center my-2">
                <p class="SubHeding m-0 text-center">Announcement</p>
              </div>
              <form method="POST" action="">
                @CSRF
                <div class="row">
                  <div class="d-flex flex-column col-12">
                    <label for="" class="para">By user Department</label>
                    <select name="by_user_type" class="form-control" onchange="uidfetch()" id="by_type">
                        <option value="0">All</option>
                        <option value="1">Sale</option>
                        <option value="2">QA</option>
                        <option value="3">HR</option>
                        <option value="4">IT</option>
                        <option value="osw">Only share with</option>
                    </select>
                  </div>
                  <div class="d-flex flex-column col-12">
                      <div id="uid">
                        <label for="" class="para">By user ID</label>
                        <select class="form-control" name="user_ids[]" id="choices-multiple-remove-button" placeholder="Select users" multiple>
                            @foreach($users as $us)
                                <option>{{$us->user_id}}-{{$us->name}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="d-flex flex-column col-12">
                    <label for="" class="para">Subject</label>
                    <input type="text" class="form-control" name="subject">
                  </div>
                  <div class="d-flex flex-column col-12">
                    <label for="" class="para">Message</label>
                    <textarea name="message" class="form-control"></textarea>
                  </div>
                  <div class="col-12 d-flex  align-self-end mt-3">
                    <button class="form-control p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">Post</button>
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
  
<script>
    $(document).ready(function(){
     var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
      }); 
 });
</script>
<script>
    function uidfetch(){
        let a = $('#by_type').val();
        if(a == 'osw'){
            $('#uid').show();
        }else{
            $('#uid').hide();
        }
    }
</script>