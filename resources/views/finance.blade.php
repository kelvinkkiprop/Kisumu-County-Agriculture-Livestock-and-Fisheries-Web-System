@extends('layouts.admin')

<!-----------------------------Section---------------------------------->
@section('content')

    <!-----------------------------DASHBOARD---------------------------------->
    <section id="dashboard">

        <!-----------------------------row---------------------------------->
        <div class="row">

            <!-----------------------------col-md-2---------------------------------->
            <div class="col-md-2"> 
                <!-----------------------------MENU---------------------------------->
                <div class="menu">

                    <!-----------------------------------------Navbar--------------------------------------------------->
                    <nav class="navbar-expand-sm navbar-light">

                    <!-- Toggler button -->
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>


                    <!-- Navbar collapse -->
                    <div class="collapse navbar-collapse" id="mynavbar">
               
                    <!-----------------------------Nav tabs---------------------------------->
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#analytics">
                            <i class="fas fa-database">&nbsp;Analytics</i></a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inpayments">
                            <i class="fas fa-money-bill-alt">&nbsp;Pay (In)</i></a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#outpayments">
                            <i class="fas fa-money-bill">&nbsp;Pay (Out)</i></a>
                        </li> 
                    </ul>
                    <!-----------------------------./Nav tabs---------------------------------->

                    </div>

                    </nav>

                </div>
                <!-----------------------------MENU---------------------------------->
            </div>
            <!-----------------------------./col-md-2---------------------------------->

            <!-----------------------------col-md-10---------------------------------->
            <div class="col-md-10">

                <!-----------------------------HERO---------------------------------->
                <div class="hero">

                <!-----------------------------Tab panes---------------------------------->
                <div class="tab-content">

                <!-----------------------------Messages---------------------------------->
                @include('common.messages')
                <!-----------------------------./Messages---------------------------------->

                <!-----------------------------./Modal Errors---------------------------------->
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>  
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>                            
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-----------------------------./Modal Errors---------------------------------->

                    <!-----------------------------Analytics---------------------------------->
                    <div id="analytics" class="tab-pane active">
                        <h3>ANALYTICS</h3>
                        <div class="well">            
                        <!--Overview-->
                        <div class="card mb-2">
                            <div class="card-header">
                                <h5>Overview</h5>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-book fa-1x">&nbsp;{{$supplies->sum('cost')}}</i></h2>
                                        <h4>Out Payments</h4>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-newspaper fa-1x">&nbsp;{{$orders->sum('cost')}}</i></h2>
                                        <h4>In Payments</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                        <!--Recent Stock-->
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Payments</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($recentpayments)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($recentpayments as $recentpayment)
                                        <tr>
                                            <td>{{$recentpayment->category}}</td>  
                                            <td>{{$recentpayment->cost}}</td>                                            
                                            <td>{{App\User::where('id', $recentpayment->user)->get()->first()->name}}</td> 
                                            <td>{{$recentpayment->quantity}}</td>
                                            <td>{{$recentpayment->location}}</td>
                                            <td>{{$recentpayment->mpesacode}}</td>                                            
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No recent payments</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Recent Stock-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                    <!-----------------------------In Payments---------------------------------->
                    <div id="inpayments" class="tab-pane fade">
                        <h3>IN PAYMENTS</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$orders->sum('cost')}}</strong></h4>
                        <div class="well">
                            @if(count($orders)>0)  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Item</th>
                                        <th>Cost</th>
                                        <th>User</th>
                                        <th>Quantity</th>
                                        <th>Location</th>
                                        <th>MPesa Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->category}}</td>
                                        <td>{{$order->cost}}</td>
                                        <td>{{App\User::where('id', $order->user)->get()->first()->name}}</td>                  
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->location}}</td>
                                        <td>{{$order->mpesacode}}</td>
                                        <td>
                                            @if($order->status==1)
                                                <label class="text-success">Paid</label>
                                            @else
                                                <label class="text-danger">Not paid</label>
                                            @endif
                                        </td>                                       
                                        <td>
                                        @if($order->delivery==0)
                                            @if($order->status==1)
                                            <a class="btn btn-sm btn-danger" href="disapprovepayment/{{$order->id}}">Disapprove Payment</a>
                                            @else
                                                <a class="btn btn-sm btn-warning" href="approvepayment/{{$order->id}}">Approve Payment</a>
                                            @endif
                                        @else 
                                            <a class="btn btn-sm btn-primary" href="#">Delivered</a>                                           
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            @endif
                        </div>
                    </div><!-----------------------------./In payments---------------------------------->

                    <!-----------------------------Out Payments---------------------------------->
                    <div id="outpayments" class="tab-pane fade">
                            <h3>OUT PAYMENTS</h3>
                            <h4>TOTAL:&nbsp;<strong>{{$supplies->sum('cost')}}</strong></h4>
                            <div class="well">
                                @if(count($supplies)>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Cost per Each</th>
                                            <th>Total Cost</th>
                                        </tr>
                                        @foreach($supplies as $supply)
                                        <tr>
                                            <td>{{$supply->category}}</td>
                                            <td>{{$supply->quantity}}</td>
                                            <td>{{$supply->cost/$supply->quantity}}</td>
                                            <td>{{$supply->cost}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div><!-----------------------------./Out payments---------------------------------->

                </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->


<!-----------------------------report---------------------------------->
<div id="report" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">   
                <div class="modal-header bg-info text-white p-2">
                    <i class="fas fa-list-alt fa-1x" aria-hidden="true">&nbsp;Report</i>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>         
                </div>
                <div class="modal-body">   
                    <!-------------------------------Input------------------------------->
                    <div id="report_table">
                    <h4 class="p-1">{{config('app.name')}} Report as on {{Date('D-M-Y')}}</h4>
                    <hr>
                        <table id="tab_customers" class="table table-striped" >        
                                <tr class='warning'>
                                    <th>Incoming Payments</th>
                                    <th>Outgoing Payments</th>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ksh.&nbsp;{{$supplies->sum('cost')}}</td> 
                                    <td class="text-muted">Ksh.&nbsp;{{$orders->sum('cost')}}</td>
                                </tr>
                        </table> 
                        </div>                              
                    <!-------------------------------./Input------------------------------->
                </div>
                <div class="modal-footer bg-dark">
                    <button type="submit" class="btn btn-sm btn-secondary pull-right"  onclick="javascript:demoFromHTML()">&nbsp;Print</button>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------------./report---------------------------------->


    
@endsection
<!-----------------------------./Section---------------------------------->




<script type="text/javascript">
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#report_table')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, {// y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },
    function(dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Receipt.pdf');
    }
    , margins);
}
</script>