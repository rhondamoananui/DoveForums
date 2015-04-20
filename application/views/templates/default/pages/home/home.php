{breadcrumbs}

<div class="panel panel-default">

    <div class="panel-heading">

        <h3 class="panel-title">Recent Discussions</h3>

    </div>

    <div class="panel-body">

        <div class="media">

            <ul class="media-list">

                <?php if($has_discussions === 1) { ?>

                {discussions}

                <li class="media">

                    <div class="media-body">

                        <h5 class="media-heading"><strong>{name}</strong></h5>

                        <p class="small">{view_count} Views&nbsp;&nbsp;&nbsp;&nbsp;{comment_count} Comments&nbsp;&nbsp;&nbsp;&nbsp;Most recent by {last_comment_username}&nbsp;&nbsp;&nbsp;&nbsp;{last_comment_date}&nbsp;&nbsp;&nbsp;&nbsp;{category_name}</p>

                    </div>

                </li>

                {/discussions}

                <?php } else { ?>

                <li class="media">

                    <div class="media-body">

                        <h4 class="media-heading"><strong>No Discussions</strong></h4>

                    </div>

                </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</div>