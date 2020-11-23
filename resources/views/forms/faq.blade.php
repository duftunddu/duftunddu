@extends('layouts.app')

<title>{{_('FAQ | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

<link href="{{ asset('css/faq.css') }}" rel="stylesheet">

@section('content')

<div class="container">

<div class="content">
    <h2>Frequently Asked Questions</h2>
      
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>Functionality</h4>
    
    <div>
      <input type="checkbox" id="question_a1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_a1" class="question">
    I can't find a function. / Some functionality is missing.
      </label>
      <div class="answers">
        <p>Some of the functions are still under testing, they will be show up shortly.</p>
        
      </div>
    </div>
    {{-- <!-- _____________________________________________________ --> 
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
    </div> --}}

    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4 name="factors" id="factors">Factors Affecting Fragrance</h4>
    
    <div>
      <input type="checkbox" id="question_b1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_b1" class="question">
    What are factors affecting fragrance wearability?
      </label>
      <div class="answers">
        <p>The factors affecting fragrance wearability are the factors Longevity, Suitability and Sustainability
          which are displayed with the fragrances. They provide personal insight to the user as they are calculated using personal data provided by the user.   
        </p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_b2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_b2" class="question">
    What is Longevity?
      </label>
      <div class="answers">
        <p>Longevity tells how long the fragrance lasts, it is based on oil concentration of fragrances.</p>
    
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question_b3" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_b3" class="question">
    What is Suitability?
      </label>
      <div class="answers">
        <p>Suitability is the degree to which a fragrance is suitable in the season.</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question_b4" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_b4" class="question">
    What is Sustainability?
      </label>
      <div class="answers">
        <p>Sustainability is the degree to which the fragrance is affected by heat, as heat is known to volatilize essences faster.</p>
        <p>This is given separately for outdoor wearers.</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>Brand Ambassador</h4>
    
    <div>
      <input type="checkbox" id="question_c1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_c1" class="question">
    How much does Brand Ambassadorhip cost?

      </label>
      <div class="answers">
        <p>Brand Ambassadorhip is completely free. However, only three people can sign up for it from each Brand.</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_c2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_c2" class="question">
    What is Brand Ambassadorship Renewal?
      </label>
      <div class="answers">
        <p>Brand Ambassadorhip expires after 3 months, after which we applications are re-evaluated.</p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_c3" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_c3" class="question">
    What if a Brand wants to remove an Ambassador from their Brand?
      </label>
      <div class="answers">
        <p>The other two ambassadors can vote to eliminate the third Ambassador, and their privileges will be revoked.</p>
      </div>
    </div>
     <!-- _____________________________________________________ -->  
     <div>
      <input type="checkbox" id="question_c4" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_c4" class="question">
    How long does the verification take?
      </label>
      <div class="answers">
        <p>The average verification time is 2 hours.</p>
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    
  
    <!-- __________________________ SECTIONS ___________________________ --> 
  
    <h4 name="feature_requests" id="feature_requests">Feature Requests</h4>
    
    <div>
      <input type="checkbox" id="question_d1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_d1" class="question">
    How are the Feature Requests evaluated?
      </label>
      <div class="answers">
        <p>Our evaluation criteria is complex but in the end it boils down to how implementable the idea is.</p>
        <p>PS. The scope/size of the idea is not an issue.</p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_d2" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_d2" class="question">
    How long does the evaluation process take?
      </label>
      <div class="answers">
        <p>It can take from a week to a month in the evalutaion of all the requests.</p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_d3" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_d3" class="question">
    My feature request was rejected without any reason.
      </label>
      <div class="answers">
        <p>There are numerous requests. We can not provide reasons for all of them.</p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    {{-- <div > --}}
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    <h4 name="genie" id="genie">Genie</h4>
    
    <div>
      <input type="checkbox" id="question_e1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_e1" class="question">
    What is Genie?
      </label>
      <div class="answers">
        <p>Genie is our AI Recommendation System, which is under development.</p>
        
      </div>
    </div>
    <div>
      <input type="checkbox" id="question_e2" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_e2" class="question">
    When will the Genie be available?
      </label>
      <div class="answers">
        <p>It will be available shortly. Estimated time is one month. You can help us in development by adding fragrances on user dashboard.</p>
        
      </div>
    </div>
  
    <!-- _____________________________________________________ --> 
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>Customer Services</h4>
    
    <div>
      <input type="checkbox" id="question_f1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_f1" class="question">
    What are your customer services?
      </label>
      <div class="answers">
        <p>Our Customer Service Representatives are outstanding individuals who understand the importance of knowing you. You can send your queries at <a href="mailto:customer-support@duftunddu.com">customer support</a>.</p>

      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_f2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_f2" class="question">
    May I submit a question for FAQ?
      </label>
      <div class="answers">
        We would like your Duft Und Du experience to be as user-friendly as possible, please feel free to submit a FAQ on <a href="mailto:customer-support@duftunddu.com">customer support</a> for inclusion in this section.
      </div>
    </div>
    <!-- _____________________________________________________ -->  
    
    
    <!-- __________________________ SECTIONS ___________________________ --> 
    
    <h4>Using This Website</h4>
    
    <div>
      <input type="checkbox" id="question_g1" name="q"  class="questions">
      <div class="plus">+</div>
      <label for="question_g1" class="question">
    What are the benefits of registering for an online user account?
      </label>
      <div class="answers">
        <p>You get personal insights on all fragrances!</p>
        <p>You can also get personal fragrance recommendations (Coming Soon).</p>
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    <div>
      <input type="checkbox" id="question_g2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_g2" class="question">
    What if I lose my username/password or I cannot log into my account?
      </label>
      <div class="answers">
        <p>If you have entered the correct username/password and you’re still unable to log in, please contact Customer Support on <a href="mailto:customer-support@duftunddu.com">customer support</a>. Otherwise, you can reset your password through our reset portal.</p>
        
      </div>
    </div>
     <!-- _____________________________________________________ -->  
    <div>
      <input type="checkbox" id="question_g3" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_g3" class="question">
    Who do I contact with feedback regarding this site?
      </label>
      <div class="answers">
        <p>All comments are welcome. Please submit your feedback <a href="feedback">here</a>, your suggestions and comments on <a href="mailto:customer-support@duftunddu.com">customer support</a>, and reports <a href="report">here</a>.</p>
        <p>To read our privacy policy, please click <a href="privacy_policy">here</a>.</p>
        
      </div>
    </div>
    <div>
      <input type="checkbox" id="question_g4" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question_g4" class="question">
    My account was terminated. Why?
      </label>
      <div class="answers">
        <p>The system must have detected some suspicious activity, you can contact <a href="mailto:customer-support@duftunddu.com">customer support</a> to resolve the issue.</p>
        
      </div>
    </div>
    <!-- _____________________________________________________ --> 
    
    </div>
</div>

@endsection