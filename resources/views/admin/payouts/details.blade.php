@extends('admin.template')

@section('main')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-8 col-sm-offset-2">
          <div class="box box-info box_info">
            <div class="box-header with-border">
              <h3 class="box-title">Payout Details</h3>
            </div>

            <div class="box-info">

            <table class="table table-borderless">
              <tbody >
                <tr>
                 
                  <th class="text-center" >User name</th>
                  <td>{{ $withDrawal->user->full_name }}</td>
                  
                </tr>
                <tr>
                  
                  <th class="text-center">Payment Method</th>
                  <td>{{ $withDrawal->payment_methods->name }}</td>
                  
                </tr>
                <tr>
                  <th class="text-center">Payment email</th>
                  <td>{{ $withDrawal->payout_settings->email }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment account name</th>
                  <td>{{ $withDrawal->payout_settings->account_name }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment account number</th>
                  <td>{{ $withDrawal->payout_settings->account_number }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment branch name</th>
                  <td>{{ $withDrawal->payout_settings->bank_branch_name }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment branch city</th>
                  <td>{{ $withDrawal->payout_settings->bank_branch_city }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment branch address</th>
                  <td>{{ $withDrawal->payout_settings->bank_branch_address }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment bank name</th>
                  <td>{{ $withDrawal->payout_settings->bank_name }}</td>                  
                </tr>
                <tr>
                  <th class="text-center">Payment swift code</th>
                  <td>{{ $withDrawal->payout_settings->swift_code }}</td>                  
                </tr>
                <tr>
                  
                  <th class="text-center">Payout Amount</th>
                  <td > {!! $withDrawal->currency->symbol !!} {{ $withDrawal->amount }}</td>
                </tr>

                 <tr>
                  
                  <th class="text-center">Status</th>
                  <td >{{ $withDrawal->status }}</td>
                </tr>
              </tbody>
            </table>
              
            </div>

            


        

            <div class="box-footer text-center">
              <a class="btn btn-default" href="{{ url('admin/payouts') }}">Back</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
    
