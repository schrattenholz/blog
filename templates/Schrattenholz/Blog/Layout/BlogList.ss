    <!-- Page Title (Shop)-->
    <div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
		 <% include BreadCrumbs Design="-light" %>
         
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">$Title.XML</h1>
        </div>
      </div>
    </div>


    <div class="container pb-5 mb-2 mb-md-4">
      <div class="pt-5 mt-md-2">
	  <% if $SortedBlogList %>
        <!-- Entries grid-->
        <div class="cz-masonry-grid" data-columns="3">
          
			<% loop $SortedBlogList %>
<!-- Entry-->
          <article class="grid-item">
            <div class="card">
			<% if not $Top.NotClickable %>
			<a class="blog-entry-thumb" href="$Link">
			<% end_if %>
				<img class="card-img-top" src="
				<% if $DefaultImage %>
					$DefaultImage.Fill(400,266).URL

				<% else %>
					$BaseHref/public/resources/vendor/schrattenholz/blog/theme/images/default.jpg
				<% end_if %>" alt="Post">
			<% if not $Top.NotClickable %>
				</a>
			<% end_if %>
				<div class="card-body">
					<h2 class="h6 blog-entry-title">
					<% if not $Top.NotClickable %>
						<a href="$Link">
					<% end_if %>
							$MenuTitle.XML
					<% if not $Top.NotClickable %>
						</a>
					<% end_if %>
					</h2>
                <% if $Top.ShowWholeContent %>
				$Content
				<% else %>
					<% if $TeaserText %>
					$TeaserText
					<% else_if $CuttedText(100) %>
					$CuttedText(100)
					<% else %>
					<% end_if %>
				<% end_if %>
			
				
				<!--<a class="btn-tag mr-2 mb-2" href="#">Shopping</a><a class="btn-tag mr-2 mb-2" href="#">Fashion</a>-->
              </div>
			   <% if not $Top.HideLabel %>
              <div class="card-footer d-flex align-items-center font-size-xs">
				<!--<a class="blog-entry-meta-link" href="#">
					<div class="blog-entry-author-ava">
						<img src="img/blog/meta/02.jpg" alt="Cynthia Gomez">
					</div>Cynthia Gomez
				</a>
				-->
               
				<div class="ml-auto text-nowrap">
					<a class="blog-entry-meta-link text-nowrap" href="$Link">$DateSummary</a>
					<!--
					<span class="blog-entry-meta-divider mx-2"></span>
					
					<a class="blog-entry-meta-link text-nowrap" href="$Link#comments">
						<i class="czi-message"></i>19
					</a>
					-->
				</div>
				
              </div>
			  <% end_if %>
            </div>
          </article>
		  
		  
		  
		  <% end_loop %>
        </div>
		<% end_if %>
		<% if $SortedBlogList.MoreThanOnePage %>
        <hr class="pb-4">
        <!-- Pagination-->
        <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
		<% if $SortedBlogList.NotFirstPage %>
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="$SortedBlogList.PrevLink"><i class="czi-arrow-left mr-2"></i>Letzte Seite</a></li>
          </ul>
		  <% end_if %>
          <ul class="pagination">
		 
            <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
			<% loop $SortedBlogList.Pages %>	
				<% if $CurrentBool %>			
				<li class="page-item active d-none d-sm-block" aria-current="page">
				<span class="page-link">$PageNum<span class="sr-only">(current)</span></span>
				</li>
				<% else %>
					<% if $Link %>
						<li class="page-item d-none d-sm-block"><a class="page-link" href="$Link">$PageNum</a></li>
					<% else %>
					...
					<% end_if %>
				<% end_if %>
			<% end_loop %>
			 
          </ul>
		  <% if $SortedBlogList.NotLastPage %>
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="$SortedBlogList.NextLink" aria-label="N&auml;chste">N&auml;chste Seite<i class="czi-arrow-right ml-2"></i></a></li>
          </ul>
		  <% end_if %>
        </nav>
		<% end_if %>
      </div>
    </div>

