<div class="container">
    <div class="row">
        <h1>$Title</h1>
    </div>
    <div class="row">
        $Content
    </div>
    <div class="row">
        <div class="col-4">
            <div class="categories">
                <% if $ListCategories.exists %>
                    <ul>
                    <% loop $ListCategories %>
                        <li>$Name</li>
                        <% if $Children.exists %>
                            <ul>
                            <% loop $Children %>
                                <li>$Name</li>
                            <% end_loop %>
                            </ul>
                        <% end_if %>
                    <% end_loop %>
                    </ul>
                <% end_if %>
            </div>

        </div>
        <div class="col-8">

        </div>

    </div>

</div>