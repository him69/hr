@if(str_contains(Request::url(), 'adper'))
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}public/assets/scripts/main.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>
<script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
<script>
    $( document ).ready(function() {
        document.querySelector('.app-main__outer').classList.toggle('collapse');
    })
</script>
@else
<script type="text/javascript" src="{{env('APP_URL')}}public/assets/scripts/main.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{env('APP_URL')}}public/boot/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
@endif
<script>
        document.getElementById('ham_nav_icon').addEventListener('click', function() {
        // Toggle 'close' class for the sidebar
        var sidebar = document.querySelector('.app-sidebar');
        sidebar.classList.toggle('close');

        // Toggle 'close' class for the header
        var header = document.querySelector('.app-header');
        header.classList.toggle('close');

        // Toggle 'collapse' class for the main content
        var mainContent = document.querySelector('.app-main__outer');
        mainContent.classList.toggle('collapse');
        mainContent.classList.toggle('d-block');
    });
</script>
</body>
</html>
