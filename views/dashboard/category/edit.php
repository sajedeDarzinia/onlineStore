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
    <form action="/dashboard/category/edit" method="POST">
        <input type="hidden" name="id" value="<?=$userData[0]['id']?>">
        <div class="form-floating mb-3 col-5">
            <input type="text" name="title" value="<?=$userData[0]['title']?>" class="form-control mb-2" id="title" placeholder="name@example.com">
            <label for="FullName">Full name</label>
            <span class="invalidFeedback text-danger">
                <?php 
                if(isset($errors)): ?>
                    <?=$errors['title'][0]?>
                <?php endif; ?>
            </span>
        </div>
        <span>
            <button class=" btn btn-lg btn-primary col-1" type="submit">edit</button>
            <a class=" btn btn-lg btn-danger" href="/dashboard/category">back</a>
        </span>
    </form>
</body>
</html>