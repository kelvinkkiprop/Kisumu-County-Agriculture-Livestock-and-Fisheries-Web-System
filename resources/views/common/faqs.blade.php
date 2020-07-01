@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-question-circle fa-2x">&nbsp;FAQs</i>
                    </div>

                    <div class="card-body">
                            
                    <!-----------------------------------------FAQS------------------------------------------------->
                    <div id="faqs">                             
                            
                        <div class="container">	<!--container -->                                    
                            <h4> Is ordering online secure?</h4>
                            <p>Yes. We take the utmost care with the information that you provide 
                            us when placing an order on our website (or through any other means). 
                            The server that hosts our stores encrypts the transmission of all payments 
                            and personal customer information using the Internet-standard SSL (Secure 
                            Sockets Layer) protocol.</p>
                                
                           <h4>How is my order shipped?</h4>
                            <p>Orders are shipped Monday through Saturday, excluding  public holidays. 
                                Any orders placed on Sunday will be shipped the following week.</p>
                               
                               
                            <h4>  Which counties do you ship to?</h4>                          
                            <p>Currently,  we only ships to towns within the Kisumu county.</p>
                               
                            <h4>How do I know that my order has been successfully submitted?</h4>
                            <p>You will receive an  acknowledgement containing the order reference number 
                                and details of your purchase. Your order will be only dispatched upon 
                                receipt of payment.</p>
                          
                            <h4>  How can I pay for my order?</h4> 
                            <p>We accept payment through Mpesa. Please note that all payments are charged 
                                in Kenyan shilling.</p> 
                               
                            <h4> Do I need to register and set up an account to shop?</h4>                          
                            <p>It is  mandatory to register. only Customers with active account can buy 
                                through online ordering.</p>
                               
                          <h4>How can I track my orders & payment?</h4>
                          <p>After logging into your account, the status of your checkout history can be 
                              found under Order History.</p>  
                            
                           <h4>  Is there a minimum order value?</h4>
                           <p>There is no minimum order requirement.  Delivery charges will remain as specified.</p>
                               
                            <h4>Is my personal information kept private?</h4>
                            <p>Any information that you share with us is private and confidential. At no point will 
                                we share, rent or sell your personal information without your consent, except as 
                                required by law or to fulfill an order contract with you.</p>
        
                        </div><!--/.container-->                
                            
                    </div><!-----------------------------------------./FAQS------------------------------------------------->
            
                    </div>
                    <div class="card-footer">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-----------------------------./Section---------------------------------->