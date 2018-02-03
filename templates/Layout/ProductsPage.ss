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
                        <li><a href="$Link">$Name</a></li>
                        <% if $Children.exists %>
                            <ul>
                            <% loop $Children %>
                                <li><a href="$Link">$Name</a></li>
                            <% end_loop %>
                            </ul>
                        <% end_if %>
                    <% end_loop %>
                    </ul>
                <% end_if %>
            </div>
            <div class="kinds">
                <% if $ListKinds.exists %>
                    <ul>
                    <% loop $ListKinds %>
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
            <div class="tags">
                <% if $ListTags.exists %>
                    <% loop $ListTags %>
                        <a href="$Link">$Title</a>
                    <% end_loop %>
                <% end_if %>
            </div>

        </div>
        <div class="col-8">
            <% if $PaginatedList.exists %>
                <% loop $PaginatedList %>
                    <div class="panel panel-default">
                        <div class="panel-heading">$Title</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-6">
                                    <img src="$Thumbnail.URL" alt="$Thumbnail.Title" width="300px" >
                                </div>
                                <div class="col-6">
                                    <p>$Summary</p><br>
                                    <a href="$Link">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <% end_loop %>
            <% end_if %>
            <div class="pagination">
                <% include Pagination Pagination=$PaginatedList %>
            </div>   

        </div>
         

    </div>

</div>