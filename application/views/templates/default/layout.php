{doctype}

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{title}</title>

    {meta}{meta}{/meta}
    {css}{link}{/css}
    {js}{script}{/js}
</head>

<body>
{navigation}

<div class="container">

    <div class="row">

        <div class="col-md-3">

            {sidebar}

        </div>

        <div class="col-md-9">

            <?= $this->messageci->display(); ?>

            {content}

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            {footer}

        </div>

    </div>

</div>

</body>

</html>