<link href="{{ asset('css/nav_bar.css') }}" rel="stylesheet">
{{-- The  Responsive Flexbox with animated dropdown menus(html, css) is provided by: https://codepen.io/mokey/pen/boqBoe --}}

<header>
	<div class="header-container">
		<a  href="#" >
			<img class="logo" src="https://maxbernard.design/img/SmackjaxLogo.png" alt="mine logo ess this" >
		</a>

		<nav class="main-menu">
					
			<a class="menu-button" href="#">Welcome</a>

			<div class="dropdown-wrapper menu-button">		
				<a class="menu-button" href="#">About me</a>
							
				<div class="drop-menu fade-in effect">
							
					<a class="menu-button" href="#">A man</a>
					<a class="menu-button" href="#">A plan</a>
					<a class="menu-button" href="#">Panama</a>
							
				</div>
			</div>


			<div class="dropdown-wrapper menu-button">		
				<a class="menu-button" href="#" >Portfolio</a>
							
				<div class="drop-menu scissor effect">
							
					<a class="menu-button" href="#">This</a>
					<a class="menu-button" href="#">Is</a>
					<a class="menu-button" href="#">An</a>
					<a class="menu-button" href="#">Extremely</a>
					<a class="menu-button" href="#">Long</a>
					<a class="menu-button" href="#">Dropdown</a>
					
				</div>
			</div>


			<div class="dropdown-wrapper menu-button">
							
				<a class="menu-button" href="#" >Contact</a>
							
				<div class="drop-menu">
					<a class="menu-button" href="#">Complaints</a>
					<a class="menu-button" href="#">Praise</a>
					<a class="menu-button" href="#">Threats</a>
				</div>
			</div>
					
		</nav>
	</div>
</header>
