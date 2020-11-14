@extends('layouts.app')

<title>{{_('FAQ | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

<link href="{{ asset('css/faq.css') }}" rel="stylesheet">

@section('content')

<div class="container">

<div class="content">
    <h2>Frequently Asked Questions</h2>
      
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>OUR BOOKS & MATERIALS</h4>
    
    <div>
      <input type="checkbox" id="question1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question1" class="question">
       Will your books and materials withstand repeated use—are they satisfaction guaranteed?
      </label>
      <div class="answers">
        <p>Our hardcover books are library bound with exposed reinforced endsheets, which means extra lasting power, use after use. They are side sewn or section sewn, and all covers are laminated with glossy film. The books are vibrant, durable, and unconditionally guaranteed. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question2" class="question">
    Do you have “green” products?
      </label>
      <div class="answers">
        <p>Many of Cavendish Square’s products are produced with recycled pulp content, allowing our company to pursue its green goals while adding additional value for your eco-conscious purchases. </p>
        
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question3" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question3" class="question">
    Do you provide book processing?
      </label>
      <div class="answers">
        <p>Cavendish Square gladly provides library processing services. Please call 1-877-980-4450 or email Customer Service to learn more about processing and available and customizable options for your bookshelf needs. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question4" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question4" class="question">
    Do you keep my library processing specifications on file?
      </label>
      <div class="answers">
        <p>Yes, Cavendish Square keeps all customer processing specifications on file. You won't need to fill out library processing forms each time you order, we’ll do it for you. You can download a processing form here. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question5" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question5" class="question">
    What is the charge for processing?
      </label>
      <div class="answers">
        <p>We offer free processing on all orders over $350.  On orders less than $350 the cost of barcodes and marc records is $25.00 per order. </p>
        
      </div>
    </div>

    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>Factors Affecting Fragrance</h4>
    
    <div>
      <input type="checkbox" id="question11" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question11" class="question">
       What are factors affecting fragrance?
      </label>
      <div class="answers">
        <p>Factors affecting fragrance are the factors Longevity, Suitability and Sustainability
          which are displayed on the fragrances. These factors are calculated using personal data provided by user.   
        </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question12" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question12" class="question">
    What is Longevity?
      </label>
      <div class="answers">
        <p>Longevity tells how long the fragrance lasts, it is based on oil concentration of fragrances.</p>
    
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question13" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question13" class="question">
    What is Suitability?
      </label>
      <div class="answers">
        <p>Suitability is the degree to which a fragrance is suitable in the season.</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question14" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question14" class="question">
    What is Sustainability?
      </label>
      <div class="answers">
        <p>Sustainability is the degree to which the fragrance is affected by heat.</p>
        <p>Heat volatilizes essences faster.</p>
        <p>This is given separately for indoor wearers..</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question15" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question15" class="question">
    What happens when an item is Out of Stock? Does that mean it will be backordered?
      </label>
      <div class="answers">
        <p>Cavendish Square does its very best to keep everything in stock. If a product is temporarily out of stock, it will be backordered automatically and shipped immediately upon availability.</p>
          
         <p> At the time of placing your order (either via phone, fax, or online), please specify how you would wish to process backorders if they occur. </p>
          <p>Selections include:<br />
        <ul>
      <li>Billing at the time of order processing or billing when the backordered item(s) ship</li>
    <li>Canceling an order if backorder status occurs, or creating a termination date when an order should be canceled if items still remain on backorder status on that date</li>
    </ul></p>
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question16" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question16" class="question">
    What is your return policy?
      </label>
      <div class="answers">
        <p>Our products are satisfaction guaranteed. If you are not completely satisfied with your purchase, please contact Customer Service within 30 days of delivery and we will gladly replace your products or credit your account.<br />
    We will accept returns on any material that is found to be unsatisfactory including improperly processed books, however, properly process books cannot be returned. Products must be returned within 60 days of purchase and must be accompanied by a copy of the invoice. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>TAX &amp; SHIPPING</h4>
    
    <div>
      <input type="checkbox" id="question17" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question17" class="question">
    Do you charge sales tax?
      </label>
      <div class="answers">
        <p>We only apply taxes for states where applicable. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question18" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question18" class="question">
    What is the cost for shipping & handling?
      </label>
      <div class="answers">
        <p>Shipping is FREE on all orders over $350.  </p>
        <p>On orders less than $350, shipping is 9% of your invoice total.  </p>
        <p>Additional shipping charges will be applied to all orders that are outside of the United States. </p>
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>RIGHTS &amp; USAGE</h4>
    
    <div>
      <input type="checkbox" id="question19" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question19" class="question">
    How do I inquire about reproduction, translation, electronic publishing, or subsidiary rights?
      </label>
      <div class="answers">
        <p>Permissible usage varies per product. Many of our books are available for translation, subsidiary rights licensing, and usage other than original purposes.</p>
        <p>
          
          You can verify usage rights through Customer Service at 1-877-980-4450 or by submitting your query through our Customer Service form.</p>
        <p>
          
          When contacting us, please have the book title/product name and ISBN that you’re inquiring about, along with a description of how you would like to use/reproduce the materials.</p>
        <p>
          
          Via standard mail, please apply for permissions to:<br />
          Cavendish Square Publishing<br />
          Attn: Permissions Department<br />
          243 5th Avenue, Suite 136<br />
          New York, NY 10016  
        </p>
      </div>
    </div>
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>DOMESTIC &amp; INTERNATIONAL SALES</h4>
    
    <div>
      <input type="checkbox" id="question20" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question20" class="question">
    How can I find my local sales representative?
      </label>
      <div class="answers">
        <p>Our Representatives—who are experts in making sure that your acquisition needs are met—can be located by calling Customer Service at 1-877-980-4450. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question21" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question21" class="question">
    How do I purchase books if I live outside of the United States?
      </label>
      <div class="answers">
        <p>Customer Service can help you directly with international purchases. Additional shipping charges will be added for international delivery. Please call Customer Service at 1-877-980-4450. </p>
        
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question22" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question22" class="question">
    Do you have distributors outside of the United States?
      </label>
      <div class="answers">
        
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question23" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question23" class="question">
    How can I obtain a copy of your catalogs and brochures?
      </label>
      <div class="answers">
        <p>We produce several catalogs and brochures, covering our full line across all divisions. To download any brochures and catalogs in PDF form, or to request delivery of any of our current materials, please click here. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>CUSTOMER SERVICE</h4>
    
    <div>
      <input type="checkbox" id="question24" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question24" class="question">
    What are your customer services?
      </label>
      <div class="answers">
        <p>Our Customer Service Representatives are outstanding individuals who understand the importance of knowing you. Cavendish Square customer services are varied and flexible, depending upon your specific needs. If you need to view a sample or find out more about our books, collections, or other products in order to make an informed purchase, we’re ready to serve you.</p>
        <p>
          
          Our Customer Service Representatives are available from 9 AM to 5 PM EST at 1-877-980-4450. <br />
          
          Cavendish Square<br />
          243 5th Avenue, Suite 136<br />
          New York, NY 10016<br />
          Customer Service <br />
          Toll-free: 1-877-980-4450<br />
          Toll-free fax: 1-877-980-4454<br />
          Customer Service Form    </p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question25" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question25" class="question">
    May I submit a question for FAQ?
      </label>
      <div class="answers">
        We would like your Cavendish Square experience to be as user-friendly as possible, please feel free to submit a FAQ for inclusion in this section.
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>USING THIS WEBSITE</h4>
    
    <div>
      <input type="checkbox" id="question26" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question26" class="question">
    What are the benefits of registering for an online user account?
      </label>
      <div class="answers">
        <p>We know that your time is very valuable. As a registered user, the time you spend browsing our site and learning about our products can be saved in your Wish List, and you can create multiple Wish Lists for future visits. You can also save carts for impending purchases. You can customize the information that you’d like to receive from Cavendish Square regarding your areas of interest. </p>
        <p>
          Another advantage of being an online user is that you become eligible for exclusive discounts and generous offers from Cavendish Square.</p>
        <p>
          Register Me Today!
           </p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question27" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question27" class="question">
    What if I lose my username/password or I cannot log into my account?
      </label>
      <div class="answers">
        <p>If you have entered the correct username/password and you’re still unable to log in, please call Customer Service at 1-877-980-4450. We will also remind you of your username and password in case you forget. Otherwise, you can reset your password through our reset portal. </p>
        
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question28" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question28" class="question">
    Who do I contact with feedback regarding this site?
      </label>
      <div class="answers">
        <p>All comments are welcome. Please submit your feedback, suggestions, or comments here.  To read our privacy policy, please click here. </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    
    </div>
</div>

@endsection