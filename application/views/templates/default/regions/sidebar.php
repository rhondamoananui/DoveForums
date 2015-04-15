<!-- Check the user is logged in -->
<?php if($this->ion_auth->logged_in() == TRUE) { ?>

    <p class="text-center">{new_discussion_button}</p>

<?php } ?>

<ul class="list-group">

    <li class="list-group-item list-group-item-info">Categories</li>

    {categories}

    <li class="list-group-item">{name} <span class="badge">{discussion_count}</span></li>

    {/categories}

</ul>
