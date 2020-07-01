@extends('layouts.app')

<!-----------------------------Section---------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">

                                       
<!-----------------------------NOT YET APPROED ACCOUNT---------------------------------->

    <div class="container">                        
            
        <!-----------------------------Head---------------------------------->
        <div class="m-2">
            <ul type="none">
                <li><strong class="capitalize-text">{{config('app.name')}},</strong></li>
                <li><strong>P.O BOX,</strong></li>
                <li><strong>PRIVATE BAG.</strong></li>
                <p></p>
                <li><strong><?php echo date('d-m-Y')?></strong></li><br/><br>
            </ul>
            <p class="ml-5">Dear {{Auth::user()->name}};</p>
        </div><br>
        <!-----------------------------./Head---------------------------------->

        <!-----------------------------Body---------------------------------->
        <div class="ml-5">
            <p><strong><h5><u>RE: ACCOUNT APPROVAL</u></h5></strong></p><br>
            <p>Thank you for registering to be part our ministry's digital platform. We are really glad to have you here.</p><br> 
            <p>Please, be patient as we process the approval of your account and sorry for any inconviniences caused.</p><br>
            <p>Thank you!</p>
            <p></p><br>
        </div>
        <!-----------------------------./Body---------------------------------->

          <!-----------------------------Footer---------------------------------->
          <div class="m-2">
            <ul type="none">
                <li>Regards;</li>
                <li><strong>{{ config('app.name') }} Team</strong></li>
            </ul>
         </div><br>
         <!-----------------------------./Footer---------------------------------->


    </div>           
    <!-----------------------------./Container---------------------------------->
                    
</div><br/>
<!-----------------------------./NOT YET APPROED ACCOUNT----------------------------------->


<div class="card-footer"></div>

            </div><br>
        </div>
    </div>
</div>
@endsection
<!-----------------------------./Section---------------------------------->