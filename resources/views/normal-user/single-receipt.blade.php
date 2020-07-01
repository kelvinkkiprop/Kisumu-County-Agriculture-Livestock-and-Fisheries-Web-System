@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">                    
                    <div class="row">
                        <div class="col-md-10">
                            <i class="fas fa-list-alt fa-2x">&nbsp;Receipt</i>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="/receipts">
                                <i class="fas fa-arrow-circle-left mr-auto">&nbsp;Back</i>
                            </a>                             
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        

                        
                    <!-----------------------------Container---------------------------------->
                    {{-- <div id="receipt_table1">
                    <div class="container">  
                        <div class="row p-4">                                   
                            <div class="col-md-5">                                             
                                <h6><strong>No.:</strong></h6>                                             
                                <h6><strong>Organization:</strong></h6>                                          
                                <h6><strong>Product:</strong></h6>  
                                <ul type="none"> 
                                    <li><small><strong>Price:</strong></small></li> 
                                    <li><small><strong>Delivery charges:</strong></small></li>                                                 
                                </ul>                              
                                <h6><strong>Total Cost:</strong></h6>                               
                                <h6><strong>Delivery Location:</strong></h6> 
                                <h6><strong>Driver:</strong></h6>
                                <h6><strong>Quantity:</strong></h6>
                                <h6><strong>Date:</strong></h6>
                                <h6><strong>Status:</strong></h6>
                            </div>
                            <div class="col-md-7">
                                <h6 class="text-muted">{{$product->id}}</h6> 
                                <h6 class="text-muted">{{config('app.name')}}</h6>
                                <h6 class="text-muted">{{$product->category}}</h6> 
                                    <ul type="none"> 
                                        <li  class="text-muted"><small><strong>Ksh.&nbsp;{{$product->cost}}</strong></small></li> 
                                        <li  class="text-muted"><small><strong>Ksh.&nbsp;{{$product->driver_charges}}</strong></small></li>                                                 
                                    </ul>
                                <h6 class="text-muted">Ksh.&nbsp;{{$product->cost+$product->driver_charges}}</h6> 
                                <h6 class="text-muted">{{$product->location}}</h6>  
                                <h6 class="text-muted">{{App\User::where('id', App\DriverCharges::where('charges', $product->driver_charges)->get()->first()->id)->get()->first()->name}}</h6>  
                                <h6 class="text-muted"><small>{{$product->quantity}}</small></h6>
                                <h6 class="text-muted"><small>{{$product->created_at}}</small></h6>   
                                    <h6 class="text-muted">
                                    @if($product->status==1)
                                        Approved
                                    @else
                                        Pending
                                    @endif
                                </h6>                                                                                     
                            </div>                            
                            
                        </div>
                    </div>
                    </div> --}}
                    <!-----------------------------./Container---------------------------------->

                    <div id="receipt_table">
                        <h3 class="p-2">{{config('app.name')}}</h3>
                        <table id="tab_customers" class="table table-striped" > 
                            @foreach ($products as $product)       
                                <tr class='warning'>
                                    <th>Receipt No.</th>
                                    <th>Product</th>
                                    <th>Product cost</th>
                                    <th>Delivery cost</th>
                                    <th>Total cost</th>                                    
                                    <th><strong>Delivery location</strong></th>
                                    <th><strong>Driver</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Status</strong></th>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{$product->receipt_no}}</td> 
                                    <td class="text-muted">{{$product->category}}</td>
                                    <td class="text-muted">Ksh.&nbsp;{{$product->cost}}</td>
                                    <td class="text-muted"> Ksh.&nbsp;{{$product->driver_charges}}</td>
                                    <td class="text-muted">Ksh.&nbsp;{{$product->sum('cost')+$product->driver_charges}}</td>  
    
                                    <td class="text-muted">{{$product->location}}</td>  
                                    <td class="text-muted">{{App\User::where('id', App\DriverCharges::where('charges', $product->driver_charges)->get()->first()->id)->get()->first()->name}}</td>  
                                    <td class="text-muted"><small>{{$product->quantity}}</small></td>
                                    <td class="text-muted"><small>{{$product->created_at}}</small></td>   
                                    <td class="text-muted">
                                        @if($product->status==1)
                                            Approved
                                        @else
                                            Pending
                                        @endif
                                    </td> 
                                </tr> 
                                <p></p>                                   
                                @endforeach
                        </table> 
                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-10">
                            
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-success" onclick="javascript:demoFromHTML()">
                                <i class="fas fa-download mr-auto">&nbsp;Download</i>
                            </button>                             
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<script type="text/javascript">
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#receipt_table')[0];

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
            top: 20,
            bottom: 5,
            left: 20,
            width: 1000
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