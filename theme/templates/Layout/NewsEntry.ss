<div class="dynamic-content container " id="main-content">
	<div id="post" class="blog padding-wrapper">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<% if $Image %>
				<figure>
					<img src="$Image.URL" alt=""/>
				</figure>
				<% end_if %>
				<header>
					<h1>$Title</h1>
					<div class="data-post">
						
					</div>
				</header>
				<section class="text-post">
					$Content
				</section>
			</div>
			<div class="col-md-offset-1 col-md-3"></div>
			<% include Footer %>
		</div>
	</div>
</div>