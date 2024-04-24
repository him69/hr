@include('user.includes.header')
<style>
th {width: 95px;}
table {
  width: 100%;
  border-collapse: collapse;
}

th {
  background: #fff!important;
  position: sticky;
  top: 0; /* Don't forget this, it's important */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
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
        <div class="app-main__outer collapse table-responsive">
            <div class="app-main__inner ">
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-3 py-3 "
                    style="width: 98%;">
                    <div class="row align-items-center my-2">
                            <div class="col-4">
                                <form>
                                        <div class="row m-0  align-items-center bg-white baseShadow rounded-2">
                                            <div class="col-6 p-0">
                                                <input type="month" name="month" value="{{$cmo}}"
                                                    class="form-control border-0">
                                            </div>
                                            <div class="col-6 p-0">
                                                <button class="btn baseBtnBg w-100" type="submit">
                                                    <span style="color: #fff;">Search by month</span>
                                                </button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        <div class="col-12">
                            <p class="SubHeding m-0 text-center">User Information</p>
                        </div>
                    </div>
                    <div class="table-responsive" style="height: 400px;
  overflow: auto;">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>Names </th>
                                <th>Salary </th>
                                <th>Department </th>
                                <th>Date of Joining</th>
                                <th>Incentives</th>
                                <th>PF</th>
                                <th>P | H | A</th>
                                <th>Total Paid</th>
                                <th>Total Unpaid</th>
                                <th>Deduction </th>
                                <th>Net Salary</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td><a href="{{env('APP_URL')}}adper/attendance/full_report/{{$user->id}}">{{$user->name ?? $user->user_id}}</a> </td>
                                <!--{{$total_working}}-->
                                </td>
                                <td>{{$user->csalary}}</td>
                                <td>{{$user->d_name}}</td>
                                <td>{{$user->joining_date}}</td>
                                <td class="@if($user->isPayable == 2){{'bg-success'}}@else{{ $user->isPayable ? 'bg-success' : 'bg-danger' }}@endif">@if($user->isPayable == 2){{'NA'}}@else{{$user->total_incentive ? $user->total_incentive+$user->payableAmount : 0}}@endif</td>
                                <td> @if($user->pf == 1) {{$user->total_salary * 0.4 * 0.12}} @else 0 @endif</td>
                                
                                <td><span style="color:#198C15;">{{$user->total_P+$user->total_PL+$hsun}}</span> <span style="color:#7c7e7f">| {{$user->total_H+($user->total_HPL)}}</span> <span style="color:#ff0000">| {{$user->total_A+$user->total_UPL+($user->total_HPL/2)}}</span></td>
                                
                                <td>{{$user->total_P+($user->total_HPL/2)+($user->total_H/2)+$user->total_PL+$hsun}}</td>
                                <td>{{$user->total_A+$user->total_UPL+($user->total_HPL/2)+($user->total_H/2)}}</td>
                                <td>{{$user->csalary - $user->total_salary}}</td>
                                <td>{{$user->total_salary}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@include('user.includes.footer')