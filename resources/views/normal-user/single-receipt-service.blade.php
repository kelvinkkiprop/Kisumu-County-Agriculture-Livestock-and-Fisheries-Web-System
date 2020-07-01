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
                    <div class="container">  
                   
                        
                        <div id="receipt_table">
                            <table id="tab_customers" class="table table-striped" >
                                    <colgroup>
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="20%">
                                    </colgroup>         
                                        <tr class='warning'>
                                            <th>Organization.</th>
                                            <th>Service</th>
                                            <th>Cost</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr> 
                                        <tr>
                                        <td class="text-muted">{{config('app.name')}}</td> 
                                        <td class="text-muted">{{App\OfferingService::where('id', $service->service)->get()->first()->name}}</td>
                                        <td class="text-muted">Ksh.&nbsp;{{$service->cost}}</td>
                                        <td class="text-muted">{{$service->location}}</td>
                                        <td class="text-muted">{{$service->created_at}}</td>  
                                        <td class="text-muted">
                                            @if($service->status==1)
                                                Approved
                                            @else
                                                Pending
                                            @endif
                                        </td>  
                                    </tr> 

                                </tr>
                            </table> 
                        </div>
                    </div>
                    <!-----------------------------./Container---------------------------------->

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