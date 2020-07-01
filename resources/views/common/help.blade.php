@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-hands-helping fa-2x">&nbsp;Help</i>
                    </div>

                    <div class="card-body">
                            
                    <!-----------------------------------------FAQS------------------------------------------------->
                    <div id="faqs">                             
                            
                        <div class="container">	<!--container -->                                    
                            <h4>How to make orders</h4>
                            <ul>
                                <li>To make an order you need to first create an account. Click on the register  link and you will be presented with a form. Fill in the required details and click on the register button. If successful you will see a message. You will have access to your account after it has been activated by the admin</li>
                                <li>To login to your account you need to login using your email and password. To make an order click in the home button. To add items to your cart click on the cart icon and the item will be added to your cart. To view your cart click on the cart icon on the top navber. To update your cart click on the refresh button to update the quantity of your cart. <br>
                                To remove items to your cart click on the remove icon and the item will removed from your cart.</li>
                                <li> To submit your order click on the check out button. On the page that appear you will be required to enter the expected delivery date. Click on the order button to submit your order.<br>
                                You will only be able to submit your order if you have entered your shipment details. To enter the shipment details click on the enter shipment link on the checkout page. Enter the required details and click on the submit button   </li>
                            </ul>
                            <h4>How to view order status</h4>
                            <ul>
                                <li> Login to your account and while in profile click on the order status button. Under order status you will see the status of your order. If your order is approved you will see the make payment button. Click on it and on the payment form that appear enter the mpesa code and the order total cost.<br>
                                Click on the submit button to submit the order. </li>
                            </ul>
                            <h4>How to send a feedback</h4>
                            <ul>
                                <li> You need to logged in to your account. Click on the send feedback button and on the page that appear enter a short feedback and click on the send button.<br>
                                To view feedback history click on the feedback history </li>
                            </ul>
        
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