  <title>jQuery UI Effects - Toggle Demo</title>
  {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
  {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
  {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/vader/jquery-ui.css"> --}}
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
  <style>
  .toggler {
    width: 500px;
    height: 200px;
  }
  #effect-open-close {
    position: relative;
    width: 240px;
    height: 170px;
    padding: 0.4em;
  }
  #effect-open-close h3 {
    margin: 0;
    padding: 0.4em;
    text-align: center;
  }
  </style>
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script>
  $( function() {
    // run the currently selected effect
    function runEffect() {
      // Run the effect
      $( "#effect-open-close" ).toggle( 'fold', {}, 1000 );
    };
 
    // Set effect from select menu value
    $( "#toggle-button" ).on( "click", function() {
      runEffect();
    });
  } );
  </script>
 
<div class="toggler">
  <div id="effect-open-close" class="ui-widget-content ui-corner-all">
    <h3 class="ui-widget-header ui-corner-all">Toggle</h3>
    <p>
      Etiam libero neque, luctus a, eleifend nec, semper at, lorem. Sed pede. Nulla lorem metus, adipiscing ut, luctus sed, hendrerit vitae, mi.
    </p>
  </div>
</div>

<a href="#" id="toggle-button" role="button" >Run Effect</a>