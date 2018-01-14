
<% if $Pagination.MoreThanOnePage %>
    <ul class="pagination">
    <% if $Pagination.NotFirstPage %>
        <li class="page-item"><a class="page-link prev" href="$Pagination.PrevLink">Prev</a></li>
    <% end_if %>
    <% loop $Pagination.Pages %>
        <% if $CurrentBool %>
            
            <li class="page-item active"><a class="page-link" href="#">$PageNum</a></li>
        <% else %>
            <% if $Link %>
                <li class="page-item"><a class="page-link"  href="$Link">$PageNum</a></li>
            <% else %>
                ...
            <% end_if %>
        <% end_if %>
        <% end_loop %>
    <% if $Pagination.NotLastPage %>
        <li class="page-item"><a class="page-link next" href="$Pagination.NextLink">Next</a></li>
    <% end_if %>
    </ul>
<% end_if %>