<% require javascript(little-shop/javascript/littleshop.js) %>
<% require css(little-shop/css/littleshop.css) %>
<div class="container">
    <div class="row">
        <h1>$Title</h1>
    </div>
    <div class="row">
        <div class="col-6 slider-gallery">
        <% if $Images.exists %>
            <% loop $Images %>
               <img src="$URL" class="gallery" alt="$Title"  width="600px">
            <% end_loop %>
        <% end_if %>
        <button class="btn-slider-left" id="button-left" >&#10094;</button>
        <button class="btn-slider-right" id="button-right" >&#10095;</button>
        </div>
        <div class="col-6">
            <h2>$Price.BruttoTotal.Nice</h2>
            <span>$Price.Nice ($Price.TaxRate VAT)</span>
            <ul>
                <li><span>Category:</span> <% loop $Categories %> $Title <% if not $last %> , <% end_if %> <% end_loop %></li>
            </ul>
        </div>

    </div>
    <div class="row">
        $Content
    </div>

</div>