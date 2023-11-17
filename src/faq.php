<?php
    // require functions.php file
    require('func/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    ob_start();
    // include header.php file
    include('func/header.php');
?>

    <main id="main-site">     
        <section id="faq">
            <div class="container py-4">
            <link rel="stylesheet" type="text/css" href="css/faq.css">
                <h4 class="font-size-20">Frequently Asked Questions</h4>
                <hr>
        
                <!-- FAQ Search Box -->
                <input type="text" id="faqSearch" class="form-control mb-3" placeholder="Search FAQ">
        
                <!-- FAQ List -->
                <ul id="faqList">
                    <!-- FAQ Item 1 -->
                    <li>
                        <h5 class="faq-question">What is the return policy?</h5>
                        <p class="faq-answer">Our return policy allows you to return items within 30 days of purchase. Please refer to our <a href="return-policy.php">return policy</a> for more details.</p>
                    </li>
        
                    <!-- FAQ Item 2 -->
                    <li>
                        <h5 class="faq-question">How can I track my order?</h5>
                        <p class="faq-answer">You can easily track your order by visiting the <a href="track-order.php">order tracking page</a> and entering your order number and email address.</p>
                    </li>
        
                    <!-- FAQ Item 3 -->
                    <li>
                        <h5 class="faq-question">Do you offer international shipping?</h5>
                        <p class="faq-answer">Yes, we offer international shipping to select countries. You can check the list of eligible countries in our <a href="shipping-info.php">shipping information</a>.</p>
                    </li>
        
                    <!-- FAQ Item 4 -->
                    <li>
                        <h5 class="faq-question">What payment methods do you accept?</h5>
                        <p class="faq-answer">We accept a variety of payment methods, including credit cards, debit cards, PayPal, and more. You can view the full list of accepted payment methods at our <a href="payment-options.php">payment options</a> page.</p>
                    </li>
        
                    <!-- FAQ Item 5 -->
                    <li>
                        <h5 class="faq-question">Can I change my order after it's been placed?</h5>
                        <p class="faq-answer">Yes, you can make changes to your order, such as adding or removing items, before it has been shipped. Please contact our customer support for assistance with order modifications.</p>
                    </li>
        
                    <!-- FAQ Item 6 -->
                    <li>
                        <h5 class="faq-question">How long does it take to process an order?</h5>
                        <p class="faq-answer">Order processing typically takes 1-2 business days. Once your order is processed and shipped, you will receive a confirmation email with tracking information.</p>
                    </li>
        
                    <!-- FAQ Item 7 -->
                    <li>
                        <h5 class="faq-question">Do you offer gift wrapping services?</h5>
                        <p class="faq-answer">Yes, we offer gift wrapping services for a nominal fee. During the checkout process, you can select the gift wrapping option and add a personalized message.</p>
                    </li>
        
                    <!-- FAQ Item 8 -->
                    <li>
                        <h5 class="faq-question">What is your warranty policy for products?</h5>
                        <p class="faq-answer">We provide a warranty for our products. The warranty duration and terms may vary by product. Please consult the product documentation or contact our support team for warranty information.</p>
                    </li>
        
                    <!-- FAQ Item 9 -->
                    <li>
                        <h5 class="faq-question">How can I return a defective product?</h5>
                        <p class="faq-answer">If you receive a defective product, please contact our customer support within 30 days of purchase, and we will assist you with the return and replacement process.</p>
                    </li>
        
                    <!-- FAQ Item 10 -->
                    <li>
                        <h5 class="faq-question">Is my personal information secure when I make a purchase?</h5>
                        <p class="faq-answer">Yes, we take the security of your personal information seriously. Our website employs encryption and security measures to protect your data during the purchase process. You can learn more about our data security practices in our <a href="privacy-policy.php">privacy policy</a>.</p>
                    </li>
        
                </ul>
            </div>
        </section>
    </main>
    
    <?php 
        // include footer.php file
        include('func/footer.php');
    ?>

    <script>
        // Function to handle FAQ search
        function searchFAQ() {
            const input = document.getElementById('faqSearch').value.toLowerCase();
            const faqList = document.getElementById('faqList').getElementsByTagName('li');
    
            for (const item of faqList) {
                const question = item.querySelector('.faq-question').innerText.toLowerCase();
                const answer = item.querySelector('.faq-answer').innerText.toLowerCase();
                const answerParagraph = item.querySelector('.faq-answer');
    
                if (question.includes(input) || answer.includes(input)) {
                    item.style.display = 'block';
                    answerParagraph.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
        }
    
        // Add event listener for search input
        document.getElementById('faqSearch').addEventListener('input', searchFAQ);
    
        // Add click event listener to make answers collapsible
        const faqAnswers = document.querySelectorAll('.faq-answer');
        faqAnswers.forEach(answer => {
            answer.style.display = 'none'; // Initially hide answers
            answer.previousElementSibling.addEventListener('click', () => {
                if (answer.style.display === 'none') {
                    answer.style.display = 'block';
                } else {
                    answer.style.display = 'none';
                }
            });
        });
    </script>

</html>