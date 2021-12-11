<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="content">
        <div class="row">
            <?php foreach ($products as $key => $product):?>
                <div class="col-4" style="margin: 30px 0px;">
                    <div class="card" style="height: 400px;">
                        <img class="card-img-top" style="height: 200px;object-fit:cover;" src="<?=$product->pic;?>" alt="Card image cap">
                        <div class="card-body">
                            <div class="card-title">
                                <label for="Name"><?=$product->title?></label>
                                <strong class=""><?=$product->price?></strong>
                            </div>
                            <div class="card-text mb-4" style="height: 80px; overflow:hidden;">
                                <?=$product->description?>
                            </div>
                            <div style="margin: -25px 0px;display: flex;justify-content:space-between;">
                                <a href="/add-to-cart?product_id=<?=$product->id?>" class="btn btn-primary">add to cart </a>
                                <a href="/more?id=<?=$product->id?>" class="btn btn-danger"> more </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
</html>
